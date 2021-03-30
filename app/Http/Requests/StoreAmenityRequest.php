<?php
namespace App\Http\Requests;

use App\Models\Amenity;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class StoreAmenityRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('amenity_create');
    }

    public function rules()
    {
        return [
            'name'        => [
                'string',
                'required',
            ],
            'description' => [
                'string',
                'nullable',
            ],
            'user_id'     => [
                'integer',
                'exists:users,id',
                'required',
            ],
        ];
    }
}
