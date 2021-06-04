<?php


namespace App\Traits;


use App\Models\Image;

trait HasImages
{
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function getFeaturedImageAttribute()
    {
        return $this->images()
                    ->where('featured', true)
                    ->first();
    }
}
