<?php

namespace App\Http\Livewire\Account;

use App\Models\Amenity;
use App\Models\City;
use App\Models\Country;
use App\Models\Image;
use App\Models\Property;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreatePropertyForm extends Component
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

    protected $rules = [
        'property.name' => 'required',
        'property.country' => 'required',
        'property.city' => 'required',
        'property.street' => 'required',
        'amenities.*' => 'nullable|numeric|exists:amenities,id',
        'photo' => 'nullable|image|mimes:jpg,jpeg,bmp,png|max:2048' // 2Mb Max,
    ];

    public function mount()
    {
        $this->property = new Property(['country' => 'Uganda', 'city' => 'Kampala']);
        $this->countries = Country::all(['id','name','code']);
        $this->cities = City::all(['id','name']);
    }

    public function createProperty(){
        $this->validate();
        $user = auth()->user();
//        $property = Property::query()->create([
//            'business_id' => $user->business->id,
//            'user_id' => $user->id,
//            'name' => $this->name,
//            'description' => $this->description ?? null,
//            'street' => $this->street,
//            'city' => $this->city,
//            'country' => $this->country,
//            'zip' => $this->zip ?? null
//        ]);
        $this->property->business_id = $user->business->id;
        $this->property->user_id = $user->id;
        $this->property->save();
        $this->property->refresh();
        $this->property->amenities()->syncWithPivotValues($this->amenities, [
            'user_id' => $user->id,
        ]);
        if(!empty($this->photo)){
            $directory = "images/properties/{$this->property->id}";
            $path = $this->photo->store($directory, 'public'); // in public disk storage
            $fileName = $this->photo->hashName();
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
        $user = auth()->user();
        $amenitiesOptions = Amenity::forBusiness($user->business->id)->get(['id','name']);
        return view('livewire.account.create-property-form', compact('amenitiesOptions'))
            ->extends('manager.layout')
            ->section('content');
    }
}
