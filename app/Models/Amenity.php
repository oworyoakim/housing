<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Amenity extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'amenities';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $orderable = [
        'id',
        'name',
        'description',
        'user.name',
    ];

    protected $filterable = [
        'id',
        'name',
        'description',
        'user.name',
    ];

    protected $guarded = [];

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

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function business()
    {
        return $this->belongsTo(Business::class, 'business_id');
    }
}
