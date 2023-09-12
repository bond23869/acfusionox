<?php

namespace App\Actions\Fortify;

use Laravel\Socialite\Facades\Socialite;

class RedirectToGoogle
{
    public function __invoke()
    {
        return Socialite::driver('google')->redirect();
    }
}
