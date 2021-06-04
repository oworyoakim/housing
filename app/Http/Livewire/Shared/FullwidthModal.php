<?php

namespace App\Http\Livewire\Shared;

use Livewire\Component;

class FullwidthModal extends Component
{
    public $title;
    public $isOpen = false;
    public $content = null;
    public $data = null;

    protected $listeners = [
        'openModal' => 'openModal',
        'closeModal' => 'closeModal',
    ];

    public function mount($title)
    {
        $this->title = $title;
    }

    public function openModal($content, $data)
    {
        $this->content = $content;
        $this->data = $data;
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->content = null;
        $this->data = null;
        $this->isOpen = false;
    }


    public function render()
    {
        return view('livewire.shared.fullwidth-modal');
    }
}
