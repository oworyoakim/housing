<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\VerifiesEmails;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    use VerifiesEmails;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('signed')->only('verifyEmailAddress');
        $this->middleware('throttle:6,1')->only('verifyEmailAddress');
    }

    public function profile()
    {
        $user = auth()->user();
        if ($user->account_type == User::ACCOUNT_TYPE_MANAGER){
            return redirect()->route('manager-profile');
        }
        return view('account.profile');
    }

    public function bookings()
    {
        return view('account.bookings');
    }

    public function emailVerification()
    {
        return view('account.email-verification');
    }
}
