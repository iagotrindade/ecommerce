<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Product;

class ImageController extends Controller
{
    public function new(Request $request) {
        if($request->hasFile('image') && $request->image->isValid()) {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,gif|max:2048'
            ]);

            $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];

            if (in_array($request->image->getMimeType(), $allowedMimeTypes)) {
                $imgName = $request->image->store('products');

                $img = Image::create([
                    "name" => $imgName
                ]);

                $product = Product::find($request->productId)->update(['image_id' => $img->id]);
            }
        }
    }
}
