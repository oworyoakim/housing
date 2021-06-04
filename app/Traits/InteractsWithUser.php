<?php


namespace App\Traits;


use App\Models\User;

trait InteractsWithUser
{
    /**
     * @return User|null
     */
    protected function getLoggedInUser(){
        return User::find(auth()->user()->id ?? null);
    }
}
