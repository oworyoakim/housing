<?php

namespace App\Http\Livewire\Account;

use Livewire\Component;

class ShowReservations extends Component
{
    public function render()
    {
        return view('livewire.account.show-reservations')
            ->extends('manager.layout')
            ->section('content');
    }
}
