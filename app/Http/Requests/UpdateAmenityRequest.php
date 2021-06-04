<?php
namespace App\Http\Requests;

use App\Models\Amenity;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class UpdateAmenityRequest extends FormRequest
{
    public function authorize()
    {
        //return Gate::allows('amenity_edit');
        return true;
    }

    public function rules()
    {
        return [
            'name'        => ['string', 'required',],
            'description' => ['string', 'nullable',],
        ];
    }
}
