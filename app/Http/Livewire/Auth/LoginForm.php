<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoginForm extends Component
{
    public $email = '';
    public $password = '';
    public $remember_me = false;
    /**
     * @var User|null
     */
    private $user = null;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    private function resetFormFields()
    {
        $this->email = '';
        $this->password = '';
        $this->remember_me = false;
    }

    private function canLogin(){
        return !empty($this->user) &&
            $this->user->account_type != User::ACCOUNT_TYPE_ADMIN;
    }

    private function emailRequiresVerification(){
        return !empty($this->user) && $this->user->account_type == User::ACCOUNT_TYPE_MANAGER && !$this->user->hasVerifiedEmail();
    }

    public function login()
    {
        $validatedData = $this->validate($this->rules);
        $this->user = User::firstWhere(['email' => $this->email]);

        if ($this->canLogin() && Auth::attempt($validatedData, $this->remember_me))
        {
            // check for email verification
            $this->user = auth()->user();
            if($this->emailRequiresVerification()){
                session()->flash('error', "You must verify your email address to access some services!");
               //return redirect()->route('verification.resend');
            }
            session()->flash('success', "You are Logged in!");
            return redirect()->intended(route('home'));
        } else
        {
            session()->flash('error', 'Invalid credentials!');
        }
    }

    public function render()
    {
        return view('livewire.auth.login-form')
            ->extends('auth.layout')
            ->section('content');
    }
}
