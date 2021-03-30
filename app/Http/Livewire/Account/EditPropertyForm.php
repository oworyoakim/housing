<?php

namespace App\Http\Livewire\Account;

use App\Models\Property;
use Livewire\Component;

class EditPropertyForm extends Component
{
    public $property = null;

    public function mount($id)
    {
        $this->property = Property::find($id);
    }

    public function updateProperty(){

        return redirect()->route('properties');
    }

    public function render()
    {
        return view('livewire.account.edit-property-form')
            ->extends('manager.layout')
            ->section('content');
    }
}
