<?php

namespace App\Http\Livewire\Account;

use App\Models\BedType;
use Livewire\Component;

class CreateBedTypeForm extends Component
{
    public $name = null;
    public $capacity = 1;

    protected $rules = [
        'name' => 'required',
        'capacity' => 'required|numeric|min:1',
    ];

    public function resetForm(){
        $this->name = null;
        $this->capacity = 1;
    }

    public function createBedType(){
        $this->validate();
        $user = auth()->user();
        BedType::create([
            'name' => $this->name,
            'capacity' => $this->capacity,
            'business_id' => $user->business->id,
            'user_id' => $user->id,
        ]);
        $this->resetForm();
        session()->flash('success', "Your bed type was added successfully!");
        return redirect()->route('bed-types');
    }
    public function render()
    {
        return view('livewire.account.create-bed-type-form')
            ->extends('manager.layout')
            ->section('content');
    }
}
