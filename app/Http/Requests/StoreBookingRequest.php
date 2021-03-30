<?php
namespace App\Http\Requests;

use App\Models\Booking;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Gate;

class StoreBookingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('booking_create');
    }

    public function rules()
    {
        return [
            'amount'        => [
                'numeric',
                'required',
            ],
            'tax'           => [
                'numeric',
                'nullable',
            ],
            'discount'      => [
                'numeric',
                'nullable',
            ],
            'email_address' => [
                'nullable',
            ],
            'phone'         => [
                'string',
                'required',
            ],
            'status'        => [
                'required',
                'in:' . implode(',', Arr::pluck(Booking::STATUS_SELECT, 'value')),
            ],
        ];
    }
}
