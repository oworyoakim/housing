<?php


namespace App\Traits;


use App\Models\Business;
use Illuminate\Database\Eloquent\Builder;

trait BelongsToBusiness
{
    public function business()
    {
        return $this->belongsTo(Business::class, 'business_id');
    }

    public function scopeForBusiness(Builder $query, $business_id)
    {
        return $query->where('business_id', $business_id);
    }
}
