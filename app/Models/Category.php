<?php

namespace App\Models;

use App\Traits\BelongsToBusiness;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes, BelongsToBusiness, HasFactory;

    protected $table = 'categories';

    protected $guarded = [];

    protected $visible = ['id','name','description'];

    const COMMON_CATEGORIES = ['Gold','Bronze','Silver', 'Platinum', 'Ordinary'];

    public function rooms(){
        return $this->hasMany(Room::class, 'category_id');
    }
}
