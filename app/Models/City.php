<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $table = 'cities';

    protected $guarded = [];

    const UGANDAN_CITIES = ['Kampala', 'Mukono', 'Wakiso', 'Jinja', 'Mbarara', 'Mbale', 'Arua'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
