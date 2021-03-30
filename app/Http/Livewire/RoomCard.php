<?php

namespace App\Http\Livewire;

use Livewire\Component;

class RoomCard extends Component
{
    public $room = null;

    public function render()
    {
        return view('livewire.room-card');
    }
}
