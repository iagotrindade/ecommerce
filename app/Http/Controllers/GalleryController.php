<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index() {
        $authUser = AuthController::getAuthUser();
        $permissionsController = PermissionController::class;

        return view('gallery', [
            'authUser' => $authUser,
            'permissions' => $permissionsController
        ]);
    }

    public function new(Request $request) {
        if($request->hasFile('image') && $request->image->isValid()) {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,gif|max:2048'
            ]);

            $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];

            if (in_array($request->image->getMimeType(), $allowedMimeTypes)) {
                $imgName = $request->image->store('gallery');

                Image::create([
                    "name" => $imgName
                ]);
            }

            else {
                return redirect(route('gallery'))->withErrors(['tipo' => 'O tipo de arquivo não é suportado!']);
            }
        }

        return redirect('gallery');
    }

    public function delete(Request $request) {
        $data = $request->all();

        if(!empty($data['delete-images-id'])) {
            foreach ($data['delete-images-id'] as $item) {
                $profile = User::select()->where('image_id', $item)->get();

                if(!empty($profile[0])) {
                    $profile[0]->update([
                        'image_id' => 1
                    ]);

                    $profile[0]->save();
                }

                $image = Image::find($item);

                if(Storage::exists($image->name) && $image->name !== 'avatars/adm/default_avatar.png') {
                    Storage::delete($image->name);

                    $image->delete();
                }
            }
        }

        else {
            return redirect(route('gallery'))->withErrors(['vazio' => 'É preciso selecionar ao menos uma imagem!']);
        }

        return redirect('gallery');
    }
}
