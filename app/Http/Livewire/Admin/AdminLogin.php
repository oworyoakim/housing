<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AdminLogin extends Component
{
    public $username = '';
    public $email = '';
    public $password = '';

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    private function resetInputFields(){
        $this->username = '';
        $this->email = '';
        $this->password = '';
    }
    public function login()
    {
        $validatedData = $this->validate($this->rules);

        if(Auth::attempt($validatedData)){
            session()->flash('success', "You are Logged in!");
            // $this->emitSelf('userLoggedIn');
            return redirect()->route('admin.dashboard');
        }else{
            session()->flash('error', 'Invalid credentials!');
        }
    }
    public function render()
    {
        return view('livewire.admin.admin-login');
    }
}
