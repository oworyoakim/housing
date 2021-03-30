<?php

namespace App\Http\Livewire\Account;

use App\Models\Property;
use Livewire\Component;

class CreatePropertyForm extends Component
{
    public $name = null;
    public $description = null;
    public $country = "Uganda";
    public $city = "Kampala";
    public $street = null;
    public $zip = null;

    public $countries = ['Uganda'];
    public $cities = ['Kampala', 'Mukono', 'Wakiso', 'Jinja', 'Mbarara', 'Mbale', 'Arua'];

    protected $rules = [
        'name' => 'required',
        'country' => 'required',
        'city' => 'required',
        'street' => 'required',
    ];

    public function resetForm(){
        $this->name = null;
        $this->description = null;
        $this->country = "Uganda";
        $this->city = "Kampala";
        $this->street = null;
        $this->zip = null;
    }

    public function createProperty(){
        $this->validate();
        $user = auth()->user();
        Property::create([
            'business_id' => $user->business->id,
            'user_id' => $user->id,
            'name' => $this->name,
            'description' => $this->description ?? null,
            'street' => $this->street,
            'city' => $this->city,
            'country' => $this->country,
            'zip' => $this->zip ?? null
        ]);
        session()->flash('success', "Your property was added successfully!");
        $this->resetForm();
        return redirect()->route('properties');
    }

    public function render()
    {
        return view('livewire.account.create-property-form')
            ->extends('manager.layout')
            ->section('content');
    }
}
