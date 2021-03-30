<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ContactForm extends Component
{
    public $name = '';
    public $email = '';
    public $message = '';

    public function saveMessage()
    {
        $this->resetFormFields();
    }

    private function resetFormFields()
    {
        $this->name = '';
        $this->email = '';
        $this->message = '';
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
