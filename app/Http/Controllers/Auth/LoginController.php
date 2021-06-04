<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginFormRequest;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * @var User|null
     */
    private $user = null;
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    private function canLogin()
    {
        return !empty($this->user) &&
            $this->user->account_type != User::ACCOUNT_TYPE_ADMIN;
    }

    private function emailRequiresVerification()
    {
        return !empty($this->user) && $this->user->account_type == User::ACCOUNT_TYPE_MANAGER && !$this->user->hasVerifiedEmail();
    }

    public function login(LoginFormRequest $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');
        $remember_me = $request->get('remember_me');
        $validatedData = [
            'email' => $email,
            'password' => $password,
        ];
        $this->user = User::firstWhere(['email' => $email]);

        if ($this->canLogin() && Auth::attempt($validatedData, $remember_me))
        {
            // check for email verification
            $this->user = auth()->user();
            if ($this->emailRequiresVerification())
            {
                return response()->json("You are Logged in! You must verify your email address to access some services!");
            }
            return response()->json("You are Logged in!");
        }
        return response()->json("Invalid credentials!", Response::HTTP_FORBIDDEN);
    }

    public function logout(){
        Auth::logout();
        return response()->json("You are Logged out!");
    }
}
