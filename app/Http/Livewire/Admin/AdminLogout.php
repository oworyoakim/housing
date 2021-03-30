<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AdminLogout extends Component
{
    public function logout(){
        Auth::logout();
        return redirect()->route('admin.login');
    }

    public function render()
    {
        return view('livewire.admin.admin-logout');
    }
}
