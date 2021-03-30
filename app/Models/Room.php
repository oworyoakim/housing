<?php

namespace App\Models;

use App\Traits\HasThumbnails;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use \DateTimeInterface;

class Room extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, HasThumbnails, HasFactory;

    public $table = 'rooms';

    protected $appends = [
        'thumbnails',
    ];

    protected $casts = [
        'published' => 'boolean',
    ];

    protected $filterable = [
        'id',
        'name',
        'user.name',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $orderable = [
        'id',
        'name',
        'user.name',
        'published',
    ];

    protected $guarded = [];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
