<?php

namespace App\Http\Controllers;
use Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class GoogleOAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function redirectToGoogleDrive()
    {
        return Socialite::driver('google')->scopes(['https://www.googleapis.com/auth/drive.readonly'])->redirect();
    }

    public function handleGoogleDriveCallback()
    {
        $user = Socialite::driver('google')->user();

        // Here, you'd associate the Google token with the user's account in your app.
        // This token is what you'd use to make requests to the Google Drive API on their behalf.
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();


        $user = User::updateOrCreate(
            [
                'email' => $googleUser->getEmail(),
            ],
            [
                'name' => $googleUser->getName(),
                'google_id' => $googleUser->getId(),
            ]
        );

        // Log the user into your application
        Auth::login($user, true);

        // Redirect to the dashboard or desired page
        return redirect()->intended('dashboard');
    }

}
