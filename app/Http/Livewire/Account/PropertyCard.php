<?php

namespace App\Http\Livewire\Account;

use App\Models\Property;
use Livewire\Component;

class PropertyCard extends Component
{
    /**
     * @var Property|null
     */
    public $property = null;

    public function publish(){
        $this->property->status = Property::STATUS_VERIFIED;
        $this->property->save();
        $this->property->refresh();
        session()->flash('success', "Property published!");
    }

    public function unpublish(){
        $this->property->status = Property::STATUS_PENDING;
        $this->property->save();
        $this->property->refresh();
        session()->flash('success', "Property unpublished!");
    }

    public function render()
    {
        return view('livewire.account.property-card');
    }
}
