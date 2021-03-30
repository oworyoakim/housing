<?php

namespace App\Http\Livewire\Account;

use App\Models\Property;
use Livewire\Component;

class ShowProperty extends Component
{
    public $property = null;

    public function mount($id)
    {
        $this->property = Property::find($id);
    }

    public function render()
    {
        return view('livewire.account.show-property')
            ->extends('manager.layout')
            ->section('content');
    }
}
