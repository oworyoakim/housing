<?php

namespace App\Http\Livewire\Account;

use Livewire\Component;
use Livewire\WithFileUploads;

class ShowRoom extends Component
{
    use WithFileUploads;

    public $room = null;

    public function mount($property_id, $room_id)
    {
        dd($property_id, $room_id);
    }

    public function render()
    {
        return view('livewire.account.show-room');
    }
}
