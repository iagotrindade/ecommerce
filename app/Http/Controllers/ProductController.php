<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\ProductAddons;
use App\Models\Image;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function new(Request $request) {
        $request->validate([
            'categories_id' => 'required',
            'name' => 'required|min:3',
            'description' => 'required|min:5',
            'price' => 'required',
        ]);

        if($request->hasFile('image') && $request->image->isValid() ) {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,gif|max:2048'
            ]);

            $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];

            if (in_array($request->image->getMimeType(), $allowedMimeTypes)) {
                $imageSend = $request->image->store('products');

                $imageSend = Image::create([
                    "name" => $imageSend
                ]);

                $imageSend = $imageSend->id;
            }
        }

        else {
            $imageSend = Image::find(1);
        }

        $data = $request->only([
            'categories_id',
            'name',
            'description',
            'price',
            'discount',
        ]);

        $data['status'] = ($request->status == 'on') ? 'Ativado' : 'Desativado';
        $data['discount_status'] = ($request->discount_status == 'on') ? 'Ativado' : 'Desativado';

        $data['image_id'] = $imageSend->id;

        $newProduct = Product::create($data);

        if(!empty($request->complementData)) {
            $request->validate([
                'complementData' => 'required',
            ]);

            $complements = json_decode($request->complementData, true);

            foreach($complements as $complement) {
                $complement['product_id'] = $newProduct->id;

                ProductAddons::create($complement);
            }
        }

        return redirect(route('carte'));
    }

    public function edit(Request $request) {
        $product = Product::find($request->product_id);

        $request->validate([
            'product_id' => 'required',
            'categories_id' => 'required',
            'name' => 'required|min:3',
            'description' => 'required|min:5',
            'price' => 'required',
        ]);

        $oldImage = Image::find($product->image->id);

        if($request->hasFile('image') && $request->image->isValid() ) {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,gif|max:2048'
            ]);

            $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];

            if (in_array($request->image->getMimeType(), $allowedMimeTypes)) {
                $imageSend = $request->image->store('products');

                $imageSend = Image::create([
                    "name" => $imageSend
                ]);

                $imageSend = $imageSend->id;

                if($oldImage->name !== 'avatars/adm/default_avatar.png') {
                    $product->update([
                        'image' => 1
                    ]);

                    $oldImage->delete();

                    if(Storage::exists($oldImage->name)) {
                        Storage::delete($oldImage->name);
                    }
                }
            }
        }

        else {
            $imageSend = $oldImage->id;
        }

        $data = $request->only([
            'categories_id',
            'name',
            'description',
            'price',
            'discount',
        ]);

        $data['status'] = ($request->status == 'on') ? 'Ativado' : 'Desativado';
        $data['discount_status'] = ($request->discount_status == 'on') ? 'Ativado' : 'Desativado';

        $data['image_id'] = $imageSend;

        $product->update($data);

        if(!empty($request->editComplementData)) {
            $request->validate([
                'editComplementData' => 'required',
            ]);
            $complements = json_decode($request->editComplementData, true);

            ProductAddons::where('product_id', $product->id)->delete();

            foreach($complements as $complement) {

                if(!empty($complement)) {
                    ProductAddons::create([
                        'name' => $complement['editName'],
                        'price' => number_format(floatval(str_replace(",", ".", $complement['editPrice'])), 2, '.', ''),
                        'product_id' => $product->id
                    ]);
                }
            }
        }
        return redirect(route('carte'));
    }

    public function delete(Request $request) {
        $product = Product::find($request->id);

        if(!empty($product)) {
            ProductAddons::where('product_id', $product->id)->delete();

            $productImage = Image::where('name', $product->image->name)->get();

            if($productImage->isNotEmpty()) {

                $image = Image::find($productImage[0]->id);

                if(Storage::exists($image->name) && $image->name != 'avatars/adm/default_avatar.png') {

                    Storage::delete($image->name);

                    $image->delete();
                }
            }

            $product->delete();

            return redirect('carte')->withErrors([
                'ok' => 'O produto foi excluído com sucesso!'
            ]);
        }

        else {
            return redirect('carte')->withErrors([
                'id' => 'Não foi possível localizar o produto!'
            ]);
        }
    }
}
