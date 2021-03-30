<?php

namespace App\Models;

use App\Traits\HasThumbnails;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Property extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, HasThumbnails, HasFactory;

    protected $table = 'properties';
    protected $guarded = [];

    const STATUS_PENDING = 'pending';
    const STATUS_VERIFIED = 'verified';
    const STATUS_BLOCKED = 'blocked';

    public function registerMediaConversions(Media $media = null): void
    {
        $thumbnailWidth  = 50;
        $thumbnailHeight = 50;

        $thumbnailPreviewWidth  = 120;
        $thumbnailPreviewHeight = 120;

        $this->addMediaConversion('thumbnail')
             ->width($thumbnailWidth)
             ->height($thumbnailHeight)
             ->fit('crop', $thumbnailWidth, $thumbnailHeight);
        $this->addMediaConversion('preview_thumbnail')
             ->width($thumbnailPreviewWidth)
             ->height($thumbnailPreviewHeight)
             ->fit('crop', $thumbnailPreviewWidth, $thumbnailPreviewHeight);
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function scopeVerified(Builder $builder){
        return $builder->where('status', self::STATUS_VERIFIED);
    }

    public function amenities(){

    }
}
