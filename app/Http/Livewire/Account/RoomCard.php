<?php

namespace App\Http\Livewire\Account;

use App\Models\Room;
use Livewire\Component;

class RoomCard extends Component
{
    public $room = null;

    public function mounted(Room $room)
    {
        $this->room = $room;
    }

    public function render()
    {
        return view('livewire.account.room-card');
    }
}
