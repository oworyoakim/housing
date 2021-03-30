<?php
namespace App\Http\Requests;

use App\Models\Room;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class StoreRoomRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('room_create');
    }

    public function rules()
    {
        return [
            'name'            => [
                'string',
                'required',
            ],
            'user_id'         => [
                'integer',
                'exists:users,id',
                'required',
            ],
            'description'     => [
                'string',
                'nullable',
            ],
            'thumbnails'      => [
                'array',
                'nullable',
            ],
            'thumbnails.*.id' => [
                'integer',
                'exists:media,id',
            ],
            'published'       => [
                'boolean',
            ],
        ];
    }
}
