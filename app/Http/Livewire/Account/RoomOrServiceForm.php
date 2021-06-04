<?php

namespace App\Http\Livewire\Account;

use App\Models\Amenity;
use App\Models\Category;
use App\Models\Image;
use App\Models\Property;
use App\Models\Room;
use Livewire\Component;
use Livewire\WithFileUploads;

class RoomOrServiceForm extends Component
{
    use WithFileUploads;
    public $room = null;
    public $photo = null;

    public $categories = null;
    public $amenities = [];
    private $user = null;

    public $ratePeriods = [
        Room::RATE_PERIOD_NIGHT => 'Per Night',
        Room::RATE_PERIOD_DAY => 'Per Day (24 hours)',
        Room::RATE_PERIOD_MONTH => 'Per Month',
    ];

    protected $rules = [
        'room.name' => 'required',
        'room.rate' => 'required|numeric|min:1',
        'room.rate_period' => 'required|in:' . Room::RATE_PERIOD_NIGHT . ',' . Room::RATE_PERIOD_DAY . ',' . Room::RATE_PERIOD_MONTH,
        'room.property_id' => 'required|numeric',
        'room.category_id' => 'nullable|numeric',
        'amenities.*' => 'nullable|numeric|exists:amenities,id',
        'photo' => 'nullable|image|mimes:jpg,jpeg,bmp,png|max:2048' // 2Mb Max,
    ];


    public function mount($room_id = null){
        $this->room = Room::query()->findOrNew($room_id);
        $this->user = auth()->user();
        $this->amenities = $this->room->amenities()->pluck('id')->all();
        $this->categories = Category::forBusiness($this->user->business->id ?? null)->get(['id', 'name']);
    }

    public function updated()
    {
        $this->user = auth()->user();
    }

    public function updateRoomOrService()
    {
        $this->validate();
        $this->user = auth()->user();

        $this->room->user_id = $this->user->id;
        $this->room->save();

        $this->room->refresh();

        $this->room->amenities()->syncWithPivotValues($this->amenities, [
            'user_id' => $this->user->id,
        ]);

        if (!empty($this->photo))
        {
            $directory = "images/properties/{$this->room->property_id}/rooms";
            $path = $this->photo->store($directory, 'public'); // in public disk storage
            $fileName = $this->photo->hashName();
            $this->room->images()->save(new Image([
                'user_id' => $this->user->id,
                'name' => $fileName,
                'path' => "/storage/{$path}",
                'thumbnail_name' => $fileName,
                'featured' => true,
            ]));
        }
        // session()->flash('success', "Your room/service info was saved successfully!");
        $this->emitUp('closeModal');
        $this->emit('roomOrServiceSaved', "Your room/service info was saved successfully!");
    }

    public function render()
    {
        $amenitiesOptions = Amenity::forBusiness($this->user->business->id ?? null)->get(['id', 'name']);
        $properties = Property::forBusiness($this->user->business->id)->get(['id', 'name']);
        return view('livewire.account.room-or-service-form', compact('amenitiesOptions','properties'));
    }
}
