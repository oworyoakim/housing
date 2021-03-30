<?php
namespace App\Http\Requests;

use App\Models\RoomAmenity;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateRoomAmenityRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('room_amenity_edit');
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
