<?php

namespace App\Http\Livewire\Account;

use App\Models\Amenity;
use Livewire\Component;

class EditAmenityForm extends Component
{
    public $amenity = null;

    protected $rules = [
        'amenity.name' => 'required',
        'amenity.description' => 'nullable',
    ];

    public function updateAmenity(){
        $this->validate();
        $this->amenity->save();
        session()->flash('success', "Your amenity was updated successfully!");
        redirect()->route('amenities');
    }

    public function mount($id)
    {
        $this->amenity = Amenity::find($id);
        if(empty($this->amenity)){
            session()->flash('error', "Amenity {$id} not found!");
            redirect()->route('amenities');
        }
    }

    public function render()
    {
        return view('livewire.account.edit-amenity-form')
            ->extends('manager.layout')
            ->section('content');
    }
}
