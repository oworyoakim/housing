<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Bed extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'beds';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $orderable = [
        'id',
        'bed_type.name',
        'room.name',
        'number_of_beds',
    ];

    protected $filterable = [
        'id',
        'bed_type.name',
        'room.name',
        'number_of_beds',
    ];

    protected $fillable = [
        'bed_type_id',
        'room_id',
        'number_of_beds',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function bedType()
    {
        return $this->belongsTo(BedType::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
