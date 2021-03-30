<?php

namespace App\Http\Livewire\Account;

use App\Models\Category;
use Livewire\Component;

class EditCategoryForm extends Component
{
    public $category = null;

    protected $rules = [
        'category.name' => 'required',
    ];

    public function updateRoomCategory(){
        $this->validate();
        $this->category->save();
        session()->flash('success', "Your room category was updated successfully!");
        redirect()->route('room-categories');
    }

    public function mount($id){
        $user = auth()->user();
        $this->category = Category::where('business_id', $user->business->id)->find($id);
        if(!$this->category){
            session()->flash('error', "Room category not found!");
            redirect()->route('room-categories');
        }
    }
    public function render()
    {
        return view('livewire.account.edit-category-form')
            ->extends('manager.layout')
            ->section('content');
    }
}
