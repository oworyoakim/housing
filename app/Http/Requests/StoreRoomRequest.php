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
        // return Gate::allows('room_create');
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string',
            'description' => 'nullable|string',
            'rate' => 'required|numeric|min:1',
            'ratePeriod' => 'required|in:'.Room::RATE_PERIOD_NIGHT . ','. Room::RATE_PERIOD_DAY . ','.Room::RATE_PERIOD_MONTH,
            'categoryId' => 'nullable|numeric|exists:categories,id',
            'propertyId' => 'required|numeric|exists:properties,id',
            'amenities.*' => 'nullable|numeric|exists:amenities,id',
            'photo' => 'nullable|image|mimes:jpg,jpeg,bmp,png|max:2048' // 2Mb Max,
        ];
    }
}
