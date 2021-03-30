<?php

namespace App\Http\Livewire\Account;

use App\Models\BedType;
use Livewire\Component;

class ListBedTypes extends Component
{
    public function render()
    {
        $user = auth()->user();
        $bedTypes = BedType::where('business_id', $user->business->id)->get();
        return view('livewire.account.list-bed-types', compact('bedTypes'))
            ->extends('manager.layout')
            ->section('content');
    }
}
