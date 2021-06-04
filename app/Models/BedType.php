<?php
namespace App\Models;

use App\Traits\BelongsToBusiness;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BedType extends Model
{
    use SoftDeletes, BelongsToBusiness, HasFactory;

    public $table = 'bed_types';

    protected $guarded = [];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    const COMMON_BED_TYPES = [
        ['name' => 'Twin Bed', 'capacity' => 1,],
        ['name' => 'Double Bed', 'capacity' => 2,],
        ['name' => 'Queen Bed', 'capacity' => 2,],
        ['name' => 'King Bed', 'capacity' => 2,],
        ['name' => 'Bunk Bed', 'capacity' => 2,],
        ['name' => 'Sofa Bed', 'capacity' => 1,],
        ['name' => 'Murphy Bed', 'capacity' => 1,],
        ['name' => 'Air Mattress', 'capacity' => 1,],
        ['name' => 'Futon Mattress', 'capacity' => 1,],
    ];

    public function rooms()
    {
        return $this->belongsToMany(BedType::class,'room_beds')
                    ->using(RoomBed::class)
                    ->withPivot(['user_id', 'number_of_beds'])
                    ->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
