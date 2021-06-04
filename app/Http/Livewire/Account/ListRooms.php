<?php

namespace App\Http\Livewire\Account;

use App\Models\Property;
use App\Models\Room;
use App\Traits\InteractsWithUser;
use Livewire\Component;
use Livewire\WithPagination;

class ListRooms extends Component
{
    use WithPagination, InteractsWithUser;

    public $property_id = null;
    public $status = null;
    public $properties = null;
    public $perPage = 10;
    protected $listeners = [
        'roomOrServiceSaved' => 'buildQuery',
    ];
    private $user = null;
    private $builder = null;

    public function mount()
    {
        if(!$this->builder){
            $this->builder = Room::query();
        }
        $this->user = $this->getLoggedInUser();

        $this->properties = Property::forBusiness($this->user->business->id)->get(['id', 'name']);
    }

    public function closeModal()
    {
        $this->isEditing = false;
        $this->room = null;
    }

    public function buildQuery(){
        if(!$this->user){
            $this->user = $this->getLoggedInUser();
        }
        if(!$this->builder){
            $this->builder = Room::query();
        }
        if ($this->property_id)
        {
            $this->builder->where('property_id', $this->property_id);
        }else{
            $propertyIds = $this->user->business->properties()->pluck('id')->all();
            $this->builder->whereIn('property_id', $propertyIds);
        }
        if ($this->status)
        {
            $this->builder->where('status', $this->status);
        }
    }

    public function render()
    {
        $this->buildQuery();
        $rooms = $this->builder->paginate($this->perPage);
        return view('livewire.account.list-rooms', compact('rooms'))
            ->extends('manager.layout')
            ->section('content');
    }
}
