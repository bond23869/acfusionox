<?php
namespace App\Http\Controllers;
use App\Services\GoogleDriveService;

class GoogleDocsController extends Controller
{
    protected $googleDriveService;

    public function __construct(GoogleDriveService $googleDriveService)
    {
        $this->googleDriveService = $googleDriveService;
    }

    public function redirectToGoogle()
    {
        $url = $this->googleDriveService->getUrl();
        return redirect()->away($url);
    }

    public function handleGoogleCallback(Request $request)
    {
        $token = $this->googleDriveService->fetchToken($request->get('code'));
        
        $user = auth()->user();
        $user->google_access_token = $token['access_token'];
        $user->google_refresh_token = $token['refresh_token'] ?? null;
        $user->token_expiry = Carbon::now()->addSeconds($token['expires_in']);
        $user->googleConnected = true;
        $user->save();

        return redirect()->route('dashboard');
    }

    public function fetchGoogleDocs()
    {
        $user = auth()->user();
        
        $this->googleDriveService->setAccessToken($user->google_access_token);
        $this->googleDriveService->refreshTokenIfExpired();
        
        $docs = $this->googleDriveService->fetchGoogleDocs();

        return response()->json(['docs' => $docs]);
    }


   
}
