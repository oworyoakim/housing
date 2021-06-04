<?php
namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class StoreBedRequest extends FormRequest
{
    public function authorize()
    {
        //return Gate::allows('bed_create');
        return true;
    }

    public function rules()
    {
        return [
            'bedTypeId'    => [
                'integer',
                'exists:bed_types,id',
                'required',
            ],
            'roomId'        => [
                'integer',
                'exists:rooms,id',
                'required',
            ],
            'numberOfBeds' => [
                'integer',
                'min:1',
                'max:2147483647',
                'required',
            ],
        ];
    }
}
