<?php

namespace App\Http\Livewire\Account;

use App\Models\Amenity;
use App\Models\Category;
use App\Models\Image;
use App\Models\Property;
use App\Models\Room;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateRoomServiceForm extends Component
{
    use WithFileUploads;
    public $property = null;
    public $category_id = null;
    public $name = null;
    public $description = null;
    public $rate = null;
    public $rate_period = null;
    public $photo = null;
    public $categories = null;
    public $amenities = [];
    public $ratePeriods = [
        Room::RATE_PERIOD_NIGHT => 'Per Night',
        Room::RATE_PERIOD_DAY => 'Per Day (24 hours)',
        Room::RATE_PERIOD_MONTH => 'Per Month',
    ];

    protected $rules = [
        'name' => 'required',
        'rate' => 'required|numeric|min:1',
        'rate_period' => 'required|in:'.Room::RATE_PERIOD_NIGHT . ','. Room::RATE_PERIOD_DAY . ','.Room::RATE_PERIOD_MONTH,
        'category_id' => 'nullable|numeric',
        'amenities.*' => 'nullable|numeric|exists:amenities,id',
        'photo' => 'nullable|image|mimes:jpg,jpeg,bmp,png|max:2048' // 2Mb Max,
    ];

    public function mount($property_id)
    {
        $this->property = Property::find($property_id);
        if(empty($this->property)){
            session()->flash('error', "Property not found!");
            redirect()->route('properties');
        }
        $this->categories = Category::where('business_id', auth()->user()->business->id)->get(['id', 'name']);
    }

    public function createRoomOrService(){
        $this->validate();
        $user = auth()->user();
        $room = $this->property->rooms()->create([
            'name' => $this->name,
            'description' => $this->description,
            'rate' => $this->rate,
            'rate_period' => $this->rate_period,
            'category_id' => $this->category_id,
            'user_id' => $user->id,
        ]);
        $room->amenities()->syncWithPivotValues($this->amenities, [
            'user_id' => $user->id,
        ]);
        if(!empty($this->photo)){
            $directory = "images/properties/{$this->property->id}/rooms";
            $path = $this->photo->store($directory, 'public'); // in public disk storage
            $fileName = $this->photo->hashName();
            $room->images()->save(new Image([
                'user_id' => auth()->user()->id,
                'name' => $fileName,
                'path' => "/storage/{$path}",
                'thumbnail_name' => $fileName,
                'featured' => true,
            ]));
        }
        session()->flash('success', 'Room/Service created successfully!');
        return redirect()->route('view-property', ['id' => $this->property->id]);
    }

    public function render()
    {
        $user = auth()->user();
        $amenitiesOptions = Amenity::forBusiness($user->business->id)->get(['id','name']);
        return view('livewire.account.create-room-service-form', compact('amenitiesOptions'))
            ->extends('manager.layout')
            ->section('content');
    }
}
