<?php

namespace App\Services;

use Google_Client;
use Google_Service_Drive;

class GoogleDriveService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Google_Client();
        $this->client->setClientId(env('GOOGLE_CLIENT_ID'));
        $this->client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $this->client->setRedirectUri(route('google.callback')); // Assuming you've named the callback route 'google.callback'
        $this->client->addScope(Google_Service_Drive::DRIVE_READONLY);
    }

    public function getUrl()
    {
        return $this->client->createAuthUrl();
    }

    public function fetchToken($code)
    {
        return $this->client->fetchAccessTokenWithAuthCode($code);
    }

    public function setAccessToken($token)
    {
        $this->client->setAccessToken($token);
    }

    public function fetchGoogleDocs()
    {
        $driveService = new Google_Service_Drive($this->client);
        
        $optParams = [
            'pageSize' => 10,
            'fields' => 'files(id, name)',
            'q' => "mimeType='application/vnd.google-apps.document'"
        ];
        
        $results = $driveService->files->listFiles($optParams);

        return $results->getFiles();
    }

    public function refreshTokenIfExpired()
    {
        if ($this->client->isAccessTokenExpired()) {
            if ($this->client->getRefreshToken()) {
                $this->client->fetchAccessTokenWithRefreshToken($this->client->getRefreshToken());
            } else {
                throw new \Exception("Access token is expired and no refresh token is available.");
            }
        }
    }

}
