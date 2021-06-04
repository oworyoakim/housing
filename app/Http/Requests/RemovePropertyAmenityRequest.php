<?php
namespace App\Http\Requests;

use App\Models\RoomBed;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class RemovePropertyAmenityRequest extends FormRequest
{
    public function authorize()
    {
        // return Gate::allows('property_amenity_remove');
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
            'propertyId'        => [
                'integer',
                'exists:properties,id',
                'required',
            ],
        ];
    }
}
