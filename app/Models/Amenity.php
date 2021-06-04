<?php

namespace App\Models;

use App\Traits\BelongsToBusiness;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Amenity extends Model
{
    use SoftDeletes, BelongsToBusiness, HasFactory;

    public $table = 'amenities';

    protected $guarded = [];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    const COMMON_AMENITIES = [
        'Hot tub',
        'Bath tub',
        'Shower',
        'Swimming pool',
        'Gym',
        'Free Wi-Fi',
        'Cable Tv',
        'Pool table',
        'Toilet',
        'Sink',
        'Sauna / Spa',
        'Massage',
        'Steam bath',
        'Bar',
        'Restaurant',
        'Free Parking',
        'Air Conditioning',
        'Kitchen',
        'Refrigerator',
        'Microwave Oven',
        'Garden',
        'Heater',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rooms(){
        return $this->belongsToMany(Room::class, 'room_amenities')
                    ->withPivot(['user_id'])
                    ->withTimestamps();
    }

    public function properties(){
        return $this->belongsToMany(Property::class, 'property_amenities')
                    ->withPivot(['user_id'])
                    ->withTimestamps();
    }
}
