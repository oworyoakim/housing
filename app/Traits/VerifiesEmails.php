<?php


namespace App\Traits;

use App\Models\User;
use Exception;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Auth\Access\AuthorizationException;

trait VerifiesEmails
{
    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param Request $request
     *
     * @return Response|RedirectResponse
     * @throws AuthorizationException
     */
    public function verifyEmailAddress(Request $request)
    {
        $user = $request->user();
        if ( $request->get('id') != $user->getKey()) {
            throw new AuthorizationException;
        }

        if ($user->hasVerifiedEmail()) {
            session()->flash("success", "Your email is already verified!");
            return redirect()->route('home');
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }
        session()->flash('success', "Email address verification successful!");
        return redirect()->route('home');
    }
}
