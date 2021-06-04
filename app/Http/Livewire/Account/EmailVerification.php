<?php

namespace App\Http\Livewire\Account;

use Livewire\Component;

class EmailVerification extends Component
{
    public function mount()
    {
        $user = auth()->user();
        if ($user->hasVerifiedEmail()) {
            session()->flash("success", "Your email is already verified!");
            return redirect()->route('home');
        }
    }

    public function resendVerificationEmail()
    {
        $user = auth()->user();
        if ($user->hasVerifiedEmail()) {
            session()->flash("success", "Your email is already verified!");
            return redirect()->route('home');
        }

        $user->sendEmailVerificationNotification();

        session()->flash("success", "Email verification link has been sent to your registered email address!");

        return redirect()->route('home');
    }

    public function render()
    {
        return view('livewire.account.email-verification')
            ->extends('auth.layout')
            ->section('content');
    }
}
