<?php

namespace App\Http\Livewire\Account;

use App\Models\Category;
use Livewire\Component;

class ListRoomCategories extends Component
{
    public function render()
    {
        $user = auth()->user();
        $categories = Category::forBusiness($user->business->id)->get();
        return view('livewire.account.list-room-categories', compact('categories'))
            ->extends('manager.layout')
            ->section('content');
    }
}
