<?php

namespace App\Helpers;
use App\Followers;
use Auth;
use Google_Client;

 class GoogleApiValidate
{
    public static function authValidation($id_token)
      {
        $client = new Google_Client(['client_id' => env("GOOGLE_CLIENT_ID")]);  // Specify the CLIENT_ID of the app that accesses the backend
        $payload = $client->verifyIdToken($request->id_token);
        
        if ($payload) {
           $userid = $payload['sub'];
           return $userid;
        }else{
            return 'validate failed';
        }
    }
}   