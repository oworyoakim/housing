<?php

namespace App\Http\Livewire;

use Livewire\Component;

class HeroSingle extends Component
{
    public $heroImage = '/assets/img/bg/hero-bg-2.jpg';

    public function render()
    {
        return view('livewire.hero-single');
    }
}
