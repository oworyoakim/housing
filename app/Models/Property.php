<?php

namespace App\Models;

use App\Traits\HasImages;
use App\Traits\BelongsToBusiness;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use SoftDeletes, HasFactory, BelongsToBusiness, HasImages;

    protected $table = 'properties';
    protected $guarded = [];
    protected $casts = [
        'published' => 'boolean',
    ];

    const STATUS_PENDING = 'pending';
    const STATUS_VERIFIED = 'verified';
    const STATUS_BLOCKED = 'blocked';


    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function scopeVerified(Builder $builder)
    {
        return $builder->where('published', true);
    }

    public function amenities()
    {
        return $this->belongsToMany(Amenity::class, 'property_amenities')
                    ->withPivot(['user_id'])
                    ->withTimestamps();
    }

    public function getListingCurrencyAttribute()
    {
        return $this->business->listingCurrency ?? 'USD';
    }

    public function getListingCurrencySymbolAttribute()
    {
        return $this->business->listingCurrencySymbol ?? '$';
    }

    public function getAmenitiesForDisplayAttribute()
    {
        return $this->amenities()->get()->map(function ($amenity) {
            return $amenity->name;
        })->implode(', ');
    }

    public function getInfo(){
        $property = new \stdClass();
        $property->id = $this->id;
        $property->name = $this->name;
        $property->description = $this->description;
        $property->country = $this->country;
        $property->city = $this->city;
        $property->street = $this->street;
        $property->zip = $this->zip;
        $property->businessId = $this->business_id;
        $property->userId = $this->user_id;
        $property->published = $this->published;
        $property->amenitiesForDisplay = $this->amenitiesForDisplay;
        $property->amenities = $this->amenities()->pluck('id')->all();
        $property->listingCurrency = $this->listingCurrency;
        $property->listingCurrencySymbol = $this->listingCurrencySymbol;
        $property->numberOfRooms = $this->rooms()->count();
        $property->featuredImage = $this->featuredImage;
        return $property;
    }

    public function getInfoForManager(){
        $property = $this->getInfo();
        $property->amenities = $this->amenities()->get(['id','name','description']);
        $property->images = $this->images()->unfeatured()->get();
        /*
        $property->rooms = $this->rooms()->get()->map(function (Room $room){
            return $room->getRoomInfo();
        });
        */
        $property->rooms = $this->rooms()->get(['id','name']);
        return $property;
    }

    public function getRoomsOrServicesForManager(){
        return $this->rooms()->get()->map(function (Room $room){
            return $room->getRoomInfo();
        });
    }
}
