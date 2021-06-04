<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class RoomBed extends Pivot
{
    use HasFactory;

    public $table = 'room_beds';

    protected $guarded = [];

    protected $touches = ['room'];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function bedType()
    {
        return $this->belongsTo(BedType::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
