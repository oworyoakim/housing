<?php

namespace App\Http\Livewire\Account;

use App\Models\Amenity;
use App\Models\Category;
use App\Models\Image;
use App\Models\Room;
use Livewire\Component;

class EditRoomServiceForm extends Component
{
    public $room = null;
    public $room_id = null;
    public $property_id = null;
    public $photo = null;
    public $categories = null;
    public $amenities = [];

    public $ratePeriods = [
        Room::RATE_PERIOD_NIGHT => 'Per Night',
        Room::RATE_PERIOD_DAY => 'Per Day (24 hours)',
        Room::RATE_PERIOD_MONTH => 'Per Month',
    ];

    protected $rules = [
        'room.name' => 'required',
        'room.rate' => 'required|numeric|min:1',
        'room.rate_period' => 'required|in:' . Room::RATE_PERIOD_NIGHT . ',' . Room::RATE_PERIOD_DAY . ',' . Room::RATE_PERIOD_MONTH,
        'room.category_id' => 'nullable|numeric',
        'amenities.*' => 'nullable|numeric|exists:amenities,id',
        'photo' => 'nullable|image|mimes:jpg,jpeg,bmp,png|max:2048' // 2Mb Max,
    ];

    public function mount($property_id, $room_id)
    {
        $this->property_id = $property_id;
        $this->room_id = $room_id;
        $this->room = Room::where('property_id', $this->property_id)->find($this->room_id);
        if (empty($this->room))
        {
            session()->flash('error', "Room not found!");
            redirect()->route('view-property', ['property_id' => $this->property_id]);
        }
        $this->amenities = $this->room->amenities()->pluck('id')->all();
        $this->categories = Category::where('business_id', auth()->user()->business->id)->get(['id', 'name']);
    }


    public function updateRoomOrService()
    {
        $this->validate();
        $user = auth()->user();
        $this->room->save();
        $this->room->amenities()->syncWithPivotValues($this->amenities, [
            'user_id' => $user->id,
        ]);
        if (!empty($this->photo))
        {
            $directory = "images/properties/{$this->property->id}/rooms";
            $path = $this->photo->store($directory, 'public'); // in public disk storage
            $fileName = $this->photo->hashName();
            $this->room->images()->save(new Image([
                'user_id' => auth()->user()->id,
                'name' => $fileName,
                'path' => "/storage/{$path}",
                'thumbnail_name' => $fileName,
                'featured' => true,
            ]));
        }
        session()->flash('success', "Your room/service info was added successfully!");
        return redirect()->route('view-property', ['property_id' => $this->room->property_id]);
    }

    public function render()
    {
        $user = auth()->user();
        $amenitiesOptions = Amenity::forBusiness($user->business->id)->get(['id', 'name']);
        return view('livewire.account.edit-room-service-form', compact('amenitiesOptions'))
            ->extends('manager.layout')
            ->section('content');
    }
}
