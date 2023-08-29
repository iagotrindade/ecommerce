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
        $images = Image::orderBy("created_at", "desc")->get();
        $permissionsController = PermissionController::class;

        return view('gallery', [
            'authUser' => $authUser,
            'images' => $images,
            'permissions' => $permissionsController
        ]);
    }

    public function new(Request $request) {
        if($request->hasFile('image') && $request->image->isValid()) {
            $imgName = $request->image->store('gallery');

            Image::create([
                "name" => $imgName
            ]);
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

        return redirect('gallery');
    }
}
