<?php
namespace App\Http\Requests;

use App\Models\RoomBed;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class RemoveBedRequest extends FormRequest
{
    public function authorize()
    {
        // return Gate::allows('bed_remove');
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
        ];
    }
}
