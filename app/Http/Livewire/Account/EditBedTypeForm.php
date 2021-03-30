<?php

namespace App\Http\Livewire\Account;

use App\Models\BedType;
use Livewire\Component;

class EditBedTypeForm extends Component
{

    public $bedType = null;

    protected $rules = [
        'bedType.name' => 'required',
        'bedType.capacity' => 'required|numeric|min:1',
    ];

    public function updateBedType(){
        $this->validate();
        $this->bedType->save();
        session()->flash('success', "Your bed type was updated successfully!");
        redirect()->route('bed-types');
    }

    public function mount($id)
    {
        $user = auth()->user();
        $this->bedType = BedType::where('business_id', $user->business->id)->find($id);
        if(empty($this->bedType)){
            session()->flash('error', "Bed type {$id} not found!");
            redirect()->route('bed-types');
        }
    }

    public function render()
    {
        return view('livewire.account.edit-bed-type-form')
            ->extends('manager.layout')
            ->section('content');
    }
}
