<?php


namespace App\Traits;


use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image as ImageManager;

trait InteractsWithMedia
{
    protected function resizeImage(string $path, $width, $height, $constraints = [])
    {
        $aspectRatio = !empty($constraints['aspectRatio']);
        $upsize = !empty($constraints['upsize']);
        // Create the image instance
        $image = ImageManager::make(public_path($path));
        // Resize the image
        $image->resize($width, $height, function (Constraint $constraint) use ($aspectRatio, $upsize) {
            if ($aspectRatio)
            {
                $constraint->aspectRatio();
            }
            if ($upsize)
            {
                $constraint->upsize();
            }
        });
        // Save the image
        $image->save(public_path($path));
    }
}
