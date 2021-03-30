<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'categories';

    protected $guarded = [];

    const COMMON_CATEGORIES = ['Gold','Bronze','Silver', 'Platinum', 'Ordinary'];

    public function rooms(){
        return $this->hasMany(Room::class, 'category_id');
    }

    public function business()
    {
        return $this->belongsTo(Business::class, 'business_id');
    }
}
