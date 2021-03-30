<?php
namespace App\Http\Requests;

use App\Models\BedType;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBedTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bed_type_edit');
    }

    public function rules()
    {
        return [
            'name'     => [
                'string',
                'required',
            ],
            'capacity' => [
                'integer',
                'min:0',
                'max:2147483647',
                'required',
            ],
            'user_id'  => [
                'integer',
                'exists:users,id',
                'required',
            ],
        ];
    }
}
