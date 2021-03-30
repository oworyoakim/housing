<?php
namespace App\Http\Requests;

use App\Models\Booking;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;

class UpdateBookingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('booking_edit');
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
