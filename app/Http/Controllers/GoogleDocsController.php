<?php
namespace App\Http\Controllers;
use App\Services\GoogleDriveService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

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
        $user->is_google_connected = true;
        $user->save();

        return redirect()->route('dashboard');
    }

    public function fetchDocs(Request $request) {
    
        $user = auth()->user();
    
        // Make sure the user is connected to Google before proceeding.
        if (!$user->is_google_connected) {
            return response()->json([
                'success' => false,
                'message' => 'User is not connected to Google'
            ], 403); // Return a 403 Forbidden response
        }
    
        // Retrieve user's Google token from the database
        $token = [
            'access_token' => $user->google_access_token,
            'refresh_token' => $user->google_refresh_token,
            'expires_in' => $user->token_expiry ? $user->token_expiry->diffInSeconds(Carbon::now()) : null
        ];
        
        $googleClient = new \Google_Client();
        $googleClient->setAccessToken(json_encode($token)); // Make sure the token is in the correct format
    
        // If the token has expired and a refresh token is available, use it to get a new access token
        if ($googleClient->isAccessTokenExpired()) {
            if ($googleClient->getRefreshToken()) {
                $newToken = $googleClient->fetchAccessTokenWithRefreshToken($googleClient->getRefreshToken());
    
                // Update the access token in the database
                $user->google_access_token = $newToken['access_token'];
                $user->token_expiry = Carbon::now()->addSeconds($newToken['expires_in']);
                $user->save();
    
                $googleClient->setAccessToken(json_encode($newToken));
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Google access token has expired and no refresh token is available.'
                ], 401); // Return a 401 Unauthorized response
            }
        }
    
        $driveService = new \Google_Service_Drive($googleClient);
        $parameters = ['q' => "mimeType='application/vnd.google-apps.document'"];
        $files = $driveService->files->listFiles($parameters)->getFiles();
        
        return response()->json([
            'success' => true,
            'files' => $files
        ]);
    }
    


   
}
