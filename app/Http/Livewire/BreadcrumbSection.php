<?php

namespace App\Http\Livewire;

use Livewire\Component;

class BreadcrumbSection extends Component
{
    public $currentPage = '';
    public $bgImage = '/assets/img/bg/breadcrumb-01.jpg';
    public function render()
    {
        return view('livewire.breadcrumb-section');
    }
}
