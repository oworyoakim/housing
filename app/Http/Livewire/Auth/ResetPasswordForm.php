<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;

class ResetPasswordForm extends Component
{
    public $email = '';

    private function resetFormFields()
    {
        $this->email = '';
    }

    public function resetPassword()
    {

    }

    public function render()
    {
        return view('livewire.auth.reset-password-form')
            ->extends('auth.layout')
            ->section('content');
    }
}
