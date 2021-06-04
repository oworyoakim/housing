<?php

namespace App\Models;

use App\Traits\HasImages;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;

class Room extends Model
{
    use SoftDeletes, HasFactory, HasImages;

    public $table = 'rooms';

    protected $casts = [
        'published' => 'boolean',
    ];

    protected $guarded = [];

    protected $touches = ['property'];

    const RATE_PERIOD_NIGHT = 'night';
    const RATE_PERIOD_DAY = 'day';
    const RATE_PERIOD_WEEK = 'week';
    const RATE_PERIOD_MONTH = 'month';


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

    public function amenities()
    {
        return $this->belongsToMany(Amenity::class, 'room_amenities')
                    ->withPivot(['user_id'])
                    ->withTimestamps();
    }

    public function beds()
    {
        return $this->belongsToMany(BedType::class, 'room_beds')
                    ->using(RoomBed::class)
                    ->withPivot(['user_id', 'number_of_beds'])
                    ->withTimestamps();
    }

    public function getListingCurrencyAttribute()
    {
        return $this->property->listing_currency ?? 'USD';
    }

    public function getListingCurrencySymbolAttribute()
    {
        return $this->property->listing_currency_symbol ?? '$';
    }

    public function getAmenitiesForDisplayAttribute()
    {
        return $this->amenities()->get()->map(function ($amenity) {
            return $amenity->name;
        })->implode(', ');
    }

    public function getNumberOfBedsAttribute()
    {
        return $this->getRoomBeds()->reduce(function ($num, $bed) {
            return $num + $bed->numberOfBeds;
        }, 0);
    }

    public function getTotalCapacityAttribute()
    {
        return $this->getRoomBeds()->reduce(function ($capacity, $bed) {
            return $capacity + $bed->totalCapacity;
        }, 0);
    }

    public function scopePublished(Builder $query)
    {
        return $query->where('published', true);
    }

    public function getRoomBeds()
    {
        return $this->beds()->withPivot(['number_of_beds as numberOfBeds'])
                    ->get()
                    ->map(function (BedType $bedType) {
                        $bed = new \stdClass();
                        $bed->id = $bedType->id;
                        $bed->name = $bedType->name;
                        $bed->capacity = $bedType->capacity;
                        $bed->numberOfBeds = $bedType->numberOfBeds;
                        $bed->totalCapacity = ($bed->numberOfBeds * $bed->capacity);
                        return $bed;
                    });
    }

    public function getRoomInfo()
    {
        $room = new \stdClass();
        $room->id = $this->id;
        $room->name = $this->name;
        $room->description = $this->description;
        $room->status = $this->status;
        $room->published = $this->published;
        $room->frequency = $this->frequency;
        $room->bathrooms = $this->bathrooms;
        $room->rate = $this->rate;
        $room->ratePeriod = $this->ratePeriod;
        $room->tax = $this->tax;
        $room->propertyId = $this->property_id;
        $room->categoryId = $this->category_id;
        $room->category = $this->category;
        $room->featuredImage = $this->featuredImage;
        $room->amenitiesForDisplay = $this->amenitiesForDisplay;
        $room->amenities = $this->amenities()->pluck('id')->all();
        $room->listingCurrency = $this->listingCurrency;
        $room->listingCurrencySymbol = $this->listingCurrencySymbol;
        $room->numberOfBeds = $this->numberOfBeds;
        $room->totalCapacity = $this->totalCapacity;
        return $room;
    }

    public function getRoomInfoForManager()
    {
        $room = $this->getRoomInfo();
        $room->images = $this->images()->unfeatured()->get();
        $room->amenities = $this->amenities()->get(['id', 'name', 'description']);
        $room->beds = $this->getRoomBeds();
        return $room;
    }
}
