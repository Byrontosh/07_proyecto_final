<?php

namespace App\Traits;

use App\Models\Image;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HasImage
{


    public function updateImage(UploadedFile $new_image, string $directory = 'images')
    {
        $previous_image = $this->image;
        $previous_image_path = $previous_image->path;
        $previous_image->path = $new_image->store($directory,'public');
        $previous_image->save();
        $this->deletePreviousImage($previous_image_path);
    }



    private function deletePreviousImage(string $previous_image)
    {
        Storage::delete($previous_image);
    }




    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
