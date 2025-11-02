<?php

namespace App\Helper;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait UploadImageTrait{

    public function uploadImage(Request $request, $imageFolderName, $object = null , $image = "image"){
        if (!$request->hasFile($image)) {
            return $object->image ?? null;
        }

        $file = $request->file($image);
        $path = $file->store($imageFolderName, 'public');
        return $path;
    }

    public function deleteImage($object , $image = 'image'){
        if (isset($object->$image))
            Storage::disk('public')->delete($object->$image);

    }
}
