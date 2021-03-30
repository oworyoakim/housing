<?php

namespace App\Http\Livewire\Account;

use Livewire\Component;

class ManagerProfile extends Component
{
    public function render()
    {
        return view('livewire.account.manager-profile')
            ->extends('manager.layout')
            ->section('content');
    }
}
