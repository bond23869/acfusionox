<?php

namespace App\Actions\Fortify;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HandleGoogleCallback
{
    public function __invoke()
    {
        $user = Socialite::driver('google')->user();

        $appUser = User::firstOrCreate(['email' => $user->getEmail()], [
            'name' => $user->getName(),
            // other fields like password can be set here
        ]);

        Auth::login($appUser, true);

        return redirect(config('fortify.home'));  // usually /dashboard
    }
}
