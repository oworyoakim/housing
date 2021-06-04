<?php

namespace App\Http\Livewire\Account;

use App\Models\Amenity;
use App\Models\City;
use App\Models\Country;
use App\Models\Image;
use App\Models\Property;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditPropertyForm extends Component
{
    use WithFileUploads;
    /**
     * @var Property|null
     */
    public $property = null;

    public $photo = null;

    public $amenities = [];

    public $countries = [];

    public $cities = [];

    public $amenitiesOptions = [];


    protected $rules = [
        'property.name' => 'required',
        'property.country' => 'required',
        'property.city' => 'required',
        'property.street' => 'required',
        'amenities.*' => 'nullable|numeric|exists:amenities,id',
        'photo' => 'nullable|image|mimes:jpg,jpeg,bmp,png|max:2048' // 2Mb Max,
    ];

    public function mount($property_id)
    {
        $this->property = Property::find($property_id);
        if(empty($this->property)){
            session()->flash('error', "Property {$property_id} not found!");
            redirect()->route('properties');
        }
        $user = auth()->user();
        $this->amenities = $this->property->amenities()->pluck('id')->all();
        $this->amenitiesOptions = Amenity::forBusiness($user->business->id)->get(['id','name']);
        $this->countries = Country::all(['id','name','code']);
        $this->cities = City::all(['id','name']);
    }

    public function updateProperty(){
        $this->validate();
        $user = auth()->user();
        $this->property->save();
        $this->property->amenities()->syncWithPivotValues($this->amenities, [
            'user_id' => $user->id,
        ]);
        if(!empty($this->photo)){
            $directory = "images/properties/{$this->property->id}";
            $path = $this->photo->store($directory, 'public'); // in public disk storage
            $fileName = $this->photo->hashName();
            $this->property->images()->featured()->update([
                'featured' => false
            ]);
            $this->property->images()->save(new Image([
                'user_id' => auth()->user()->id,
                'name' => $fileName,
                'path' => "/storage/{$path}",
                'thumbnail_name' => $fileName,
                'featured' => true,
            ]));
        }
        session()->flash('success', "Your property was added successfully!");
        return redirect()->route('properties');
    }

    public function render()
    {
        return view('livewire.account.edit-property-form')
            ->extends('manager.layout')
            ->section('content');
    }
}
