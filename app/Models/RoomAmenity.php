<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class RoomAmenity extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'room_amenities';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $orderable = [
        'id',
        'room.name',
        'amenity.name',
        'user.name',
    ];

    protected $filterable = [
        'id',
        'room.name',
        'amenity.name',
        'user.name',
    ];

    protected $fillable = [
        'room_id',
        'amenity_id',
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function amenity()
    {
        return $this->belongsTo(Amenity::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
