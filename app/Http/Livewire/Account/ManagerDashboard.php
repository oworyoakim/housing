<?php

namespace App\Http\Livewire\Account;

use App\Models\Booking;
use App\Models\Property;
use Livewire\Component;

class ManagerDashboard extends Component
{
    public $verifiedPropertiesCount = null;
    public $pendingPropertiesCount = null;
    public $blockedPropertiesCount = null;
    public $reservationsAmount = null;
    public $reservationsCount = null;
    public $canceledReservationsCount = null;
    public $canceledReservationsAmount = null;
    public $modalOpen = false;

    protected $listeners = [
        'modalClosed' => 'closeModal',
    ];

    public function openModal()
    {
        $this->modalOpen = true;
    }

    public function closeModal()
    {
        $this->modalOpen = false;
    }

    public function mount()
    {
        $user = auth()->user();
        $properties = Property::forBusiness($user->business->id)->get();
        $this->verifiedPropertiesCount = $properties->where('status', Property::STATUS_VERIFIED)->count();
        $this->pendingPropertiesCount = $properties->where('status', Property::STATUS_PENDING)->count();
        $this->blockedPropertiesCount = $properties->where('status', Property::STATUS_BLOCKED)->count();
        $reservations = Booking::forBusiness($user->business->id)->get();
        $this->reservationsCount = $reservations->where('status', Booking::STATUS_COMPLETED)->count();
        $this->canceledReservationsCount = $reservations->where('status', Booking::STATUS_CANCELED)->count();
        $this->reservationsAmount = $reservations->where('status', Booking::STATUS_COMPLETED)->sum('amount');
        $this->canceledReservationsAmount = $reservations->where('status', Booking::STATUS_CANCELED)->sum('amount');
    }

    public function render()
    {
        return view('livewire.account.manager-dashboard')
            ->extends('manager.layout')
            ->section('content');
    }
}
