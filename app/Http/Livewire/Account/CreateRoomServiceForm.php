<?php

namespace App\Http\Livewire\Account;

use App\Models\Category;
use App\Models\Property;
use Livewire\Component;

class CreateRoomServiceForm extends Component
{
    public $property = null;
    public $category_id = null;
    public $name = null;
    public $description = null;
    public $price = null;
    public $categories = null;

    protected $rules = [
        'name' => 'required',
        'price' => 'required|numeric|min:1',
        'category_id' => 'nullable|numeric',
    ];

    public function createRoomOrService(){
        $this->validate();
        $this->property->rooms()->create([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'category_id' => $this->category_id,
            'user_id' => auth()->user()->id,
        ]);
        session()->flash('success', 'Room/Service created successfully!');
        return redirect()->route('view-property', ['id' => $this->property->id]);
    }

    public function mount($id)
    {
        $this->property = Property::find($id);
        if(empty($this->property)){
            session()->flash('error', "Property not found!");
            redirect()->route('properties');
        }
        $this->categories = Category::where('business_id', auth()->user()->business->id)->get(['id', 'name']);
    }

    public function render()
    {
        return view('livewire.account.create-room-service-form')
            ->extends('manager.layout')
            ->section('content');
    }
}
