<?php
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use \DateTimeInterface;

class User extends Authenticatable implements MustVerifyEmail
{
    use SoftDeletes, Notifiable, HasFactory;

    public $table = 'users';

    protected $hidden = [
        'remember_token',
        'password',
    ];

    protected $orderable = [
        'id',
        'name',
        'email',
        'account_type',
        'email_verified_at',
    ];

    protected $dates = [
        'email_verified_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $filterable = [
        'id',
        'name',
        'email',
        'email_verified_at',
        'account_type',
        'phone_number',
        'roles.title',
    ];

    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'phone_number',
        'account_type',
        'remember_token',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const ACCOUNT_TYPE_ADMIN = 'admin';
    const ACCOUNT_TYPE_MANAGER = 'manager';
    const ACCOUNT_TYPE_GUEST = 'guest';
    /**
     * The password must be at least 8 characters long.
     * The password must contain at least one uppercase letter alphabets.
     * The password must contain at least one lowercase letter alphabets.
     * The password must contain at least one digit.
     * The password must contain at least one special character.
     */
    const PASSWORD_FORMAT_REGEX = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/"; // e.g Password@123
    const PHONE_NUMBER_REGEX = "/^\+\d{8,20}$/i";  // e.g +256xxxxxxxxx

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getIsAdminAttribute()
    {
        return $this->roles()->where('title', 'Admin')->exists();
    }

    public function getEmailVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('project.datetime_format')) : null;
    }

    public function setEmailVerifiedAtAttribute($value)
    {
        $this->attributes['email_verified_at'] = $value ? Carbon::createFromFormat(config('project.datetime_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = Hash::needsRehash($input) ? Hash::make($input) : $input;
        }
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function business()
    {
        return $this->hasOne(Business::class,'owner_id');
    }
}
