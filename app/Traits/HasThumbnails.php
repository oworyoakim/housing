<?php


namespace App\Traits;


trait HasThumbnails
{
    public function getThumbnailsAttribute()
    {
        return $this->getMedia('room_thumbnails')->map(function ($item) {
            $media                      = $item->toArray();
            $media['url']               = $item->getUrl();
            $media['thumbnail']         = $item->getUrl('thumbnail');
            $media['preview_thumbnail'] = $item->getUrl('preview_thumbnail');

            return $media;
        });
    }
}
