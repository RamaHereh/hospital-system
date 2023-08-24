<?php

namespace App\Traits;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait ImageTrait{

    public function storeImageDoctor($filename, $doctorname, $foldername , $disk, $imageable_id, $imageable_type) {
        
            $name = \Str::slug($doctorname);
            $photoname = $name. '.' . $filename->getClientOriginalExtension();

            $Image = new Image();
            $Image->filename = $photoname;
            $Image->imageable_id = $imageable_id;
            $Image->imageable_type = $imageable_type;
            $Image->save();
            return $filename->storeAs($foldername, $photoname, $disk);

    }

    public function deleteImage($disk,$path,$id){

        Storage::disk($disk)->delete($path);
        image::where('imageable_id',$id)->delete();

    }

    public function storeImageRayAndLab($filename , $foldername , $disk, $imageable_id, $imageable_type) {

        $Image = new Image();
        $Image->filename = $filename->getClientOriginalName();
        $Image->imageable_id = $imageable_id;
        $Image->imageable_type = $imageable_type;
        $Image->save();
        return $filename->storeAs($foldername, $filename->getClientOriginalName(), $disk);
    }

}
