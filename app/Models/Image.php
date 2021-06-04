<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $table = 'images';

    protected $guarded = [];

    protected $casts = [
        'featured' => 'boolean',
    ];

    protected $hidden = [
        'user_id',
        'imageable_id',
        'imageable_type',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function imageable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeFeatured(Builder $query){
        return $query->where('featured', true);
    }

    public function scopeUnfeatured(Builder $query){
        return $query->where('featured', false);
    }
}
