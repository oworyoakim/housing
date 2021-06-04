<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class StoreBedTypeRequest extends FormRequest
{
    public function authorize()
    {
        //return Gate::allows('bed_type_create');
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
