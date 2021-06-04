<?php
namespace App\Http\Requests;

use App\Models\RoomBed;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class RemoveRoomAmenityRequest extends FormRequest
{
    public function authorize()
    {
        // return Gate::allows('room_amenity_remove');
        return true;
    }

    public function rules()
    {
        return [
            'amenityId'    => [
                'integer',
                'exists:amenities,id',
                'required',
            ],
            'roomId'        => [
                'integer',
                'exists:rooms,id',
                'required',
            ],
        ];
    }
}
