<?php

namespace App\Http\Livewire\Account;

use App\Models\Amenity;
use Livewire\Component;

class CreateAmenityForm extends Component
{
    public $name = null;
    public $description = null;

    protected $rules = [
        'name' => 'required',
        'description' => 'nullable',
    ];

    public function resetForm(){
        $this->name = null;
        $this->description = null;
    }

    public function createAmenity(){
        $this->validate();
        $user = auth()->user();
        Amenity::create([
            'name' => $this->name,
            'description' => $this->description,
            'business_id' => $user->business->id,
            'user_id' => $user->id,
        ]);
        session()->flash('success', "Your amenity was added successfully!");
        $this->resetForm();
        return redirect()->route('amenities');
    }

    public function render()
    {
        return view('livewire.account.create-amenity-form')
            ->extends('manager.layout')
            ->section('content');
    }
}
