<?php
namespace App\Http\Requests;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBedTypeRequest extends FormRequest
{
    public function authorize()
    {
        //return Gate::allows('bed_type_edit');
        return true;
    }

    public function rules()
    {
        return [
            'name'     => ['string', 'required',],
            'capacity' => ['integer', 'required', 'min:0', 'max:10'],
        ];
    }
}
