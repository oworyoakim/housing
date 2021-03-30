<?php

namespace App\Http\Livewire\Account;

use Livewire\Component;

class EmailVerification extends Component
{
    public function resendVerificationEmail()
    {
        if (auth()->user()->hasVerifiedEmail()) {
            return redirect()->route('home');
        }

        auth()->user()->sendEmailVerificationNotification();

        session()->flash("success", "Email verification link has been sent to your registered email address!");

        return redirect()->route('home');
    }
    public function render()
    {
        return view('livewire.account.email-verification');
    }
}
