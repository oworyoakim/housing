<?php
namespace App\Http\Requests;

use App\Models\RoomAmenity;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class StoreRoomAmenityRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('room_amenity_create');
    }

    public function rules()
    {
        return [
            'room_id'    => [
                'integer',
                'exists:rooms,id',
                'required',
            ],
            'amenity_id' => [
                'integer',
                'exists:amenities,id',
                'required',
            ],
            'user_id'    => [
                'integer',
                'exists:users,id',
                'required',
            ],
        ];
    }
}
