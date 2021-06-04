<?php

namespace App\Http\Livewire\Account;

use App\Models\Property;
use Livewire\Component;
use Livewire\WithPagination;

class ListProperties extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $perPage = 10;
    public $page = 1;

    public function publish(Property $property){
        $property->status = Property::STATUS_VERIFIED;
        $property->save();
        $property->refresh();
        session()->flash('success', "Property published!");
    }

    public function unpublish(Property $property){
        $property->status = Property::STATUS_PENDING;
        $property->save();
        $property->refresh();
        session()->flash('success', "Property unpublished!");
    }

    public function render()
    {
        $user = auth()->user();
        $properties = Property::forBusiness($user->business->id)->paginate($this->perPage);
        return view('livewire.account.list-properties', compact('properties'))
            ->extends('manager.layout')
            ->section('content');
    }
}
