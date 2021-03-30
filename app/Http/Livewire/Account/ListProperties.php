<?php

namespace App\Http\Livewire\Account;

use App\Models\Property;
use Livewire\Component;
use Livewire\WithPagination;

class ListProperties extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $perPage = 2;
    public $page = 1;

    public function render()
    {
        $user = auth()->user();
        $properties = Property::where('business_id', $user->business->id)->paginate($this->perPage);
        return view('livewire.account.list-properties', compact('properties'))
            ->extends('manager.layout')
            ->section('content');
    }
}
