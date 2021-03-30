<?php
namespace App\Http\Requests;

use App\Models\Bed;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class StoreBedRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bed_create');
    }

    public function rules()
    {
        return [
            'bed_type_id'    => [
                'integer',
                'exists:bed_types,id',
                'required',
            ],
            'room_id'        => [
                'integer',
                'exists:rooms,id',
                'required',
            ],
            'number_of_beds' => [
                'integer',
                'min:1',
                'max:2147483647',
                'required',
            ],
        ];
    }
}
