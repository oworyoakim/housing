<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class BedType extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'bed_types';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $orderable = [
        'id',
        'name',
        'capacity',
        'user.name',
    ];

    protected $filterable = [
        'id',
        'name',
        'capacity',
        'user.name',
    ];

    protected $guarded = [];

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
