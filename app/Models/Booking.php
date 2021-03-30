<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Booking extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'bookings';

    protected $appends = [
        'status_label',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $orderable = [
        'id',
        'amount',
        'tax',
        'discount',
        'email_address',
        'phone',
        'status',
    ];

    protected $filterable = [
        'id',
        'amount',
        'tax',
        'discount',
        'email_address',
        'phone',
        'status',
    ];

    protected $guarded = [];

    const STATUS_PENDING = 'pending';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELED = 'canceled';

    const STATUS_SELECT = [
        [
            'label' => 'Completed',
            'value' => self::STATUS_COMPLETED,
        ],
        [
            'label' => 'Pending',
            'value' => self::STATUS_PENDING,
        ],
        [
            'label' => 'Canceled',
            'value' => self::STATUS_CANCELED,
        ],
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getStatusLabelAttribute()
    {
        return collect(static::STATUS_SELECT)->firstWhere('value', $this->status)['label'] ?? '';
    }
}
