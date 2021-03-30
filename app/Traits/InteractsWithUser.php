<?php


namespace App\Traits;


trait InteractsWithUser
{
    private function getLoggedInUser(){
        return auth()->user();
    }
}
