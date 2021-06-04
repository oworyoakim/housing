<?php

namespace App\Http\Livewire\Account;

use App\Models\Amenity;
use Livewire\Component;
use Livewire\WithPagination;

class ListAmenities extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $perPage = 10;
    public $page = 1;

    public function render()
    {
        $user = auth()->user();
        $amenities = Amenity::forBusiness($user->business->id)->paginate($this->perPage);
        return view('livewire.account.list-amenities', compact('amenities'))
            ->extends('manager.layout')
            ->section('content');
    }
}
