<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Business extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'businesses';
    protected $guarded = [];

    const STATUS_PENDING = 'pending';
    const STATUS_VERIFIED = 'verified';
    const STATUS_BLOCKED = 'blocked';

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function properties()
    {
        return $this->hasMany(Property::class, 'business_id');
    }

    public function bedTypes()
    {
        return $this->hasMany(BedType::class, 'business_id');
    }

    public function categories()
    {
        return $this->hasMany(Category::class, 'business_id');
    }

    public function amenities()
    {
        return $this->hasMany(Amenity::class, 'business_id');
    }

    public function scopeVerified(Builder $query)
    {
        return $query->where('status', self::STATUS_VERIFIED);
    }

    public function scopeBlocked(Builder $query)
    {
        return $query->where('status', self::STATUS_BLOCKED);
    }

    public function scopeUnverified(Builder $query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }
}
