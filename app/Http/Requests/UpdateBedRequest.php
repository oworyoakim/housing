<?php
namespace App\Http\Requests;

use App\Models\Bed;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBedRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bed_edit');
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
                'min:0',
                'max:2147483647',
                'required',
            ],
        ];
    }
}
