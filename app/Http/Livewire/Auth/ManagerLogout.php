<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ManagerLogout extends Component
{
    public function logout(){
        Auth::logout();
        return redirect()->route('home');
    }

    public function render()
    {
        return view('livewire.auth.manager-logout');
    }
}
