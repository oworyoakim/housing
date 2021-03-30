<?php

namespace App\Http\Livewire\Account;

use App\Models\Category;
use Livewire\Component;

class CreateCategoryForm extends Component
{
    public $name = null;

    protected $rules = [
        'name' => 'required'
    ];

    public function createRoomCategory(){
        $this->validate();
        $user = auth()->user();
        Category::create([
            'name' => $this->name,
            'business_id' => $user->business->id,
            'user_id' => $user->id,
        ]);
        session()->flash("success", "Room category added successfully!");
        return redirect()->route('room-categories');
    }

    public function render()
    {
        return view('livewire.account.create-category-form')
            ->extends('manager.layout')
            ->section('content');
    }
}
