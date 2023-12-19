<?php

namespace App\Http\Services;

use Google\Service;
use Google\Auth\Oauth2;
use Google\Service\Calendar;


use Google\Client as GoogleClient;

class GoogleService
{

    protected $user;
    protected $client;

    // You should pass the necessary dependencies through the constructor
    public function __construct($user)
    {
        $this->client=$this-> google_client_config();
        $this->user = $user;
    }
    private function google_client_config(){
        $redirectUrl="user.integration authorize_google_calendar";
        $all_scoopes=impload(seprator:'',array(
            \Google_Service_calendar::CALENDAR,
            Oauth2:UserInfo_Profile,
            Oauth2::UserInfo_Email
        ));
        $client=new \Google_Client();
        $client->setApplicationName("Events");
        $client->setScopes($all_scopes);
      $client->setAuthConfig(storage-path(path:'app/googleClent/client_secrat.json'));
      $client->setState('gcalender');
      $client->setRedirectUri(route($redirectUrl));
      $client->setAccessType('offline');
      $client->setApprovalPrompt('force');
      $client->addScope(Google_Service_Calendar::CALENDAR);
      
    }

    private function google_client_config()
{
    $redirectUrl = route('user.integration.authorize_google_calendar'); // Replace with your actual route

    $all_scopes = implode(' ', [
        Google_Service_Calendar::CALENDAR,
         Oauth2::USERINFO_PROFILE,
            Oauth2::USERINFO_EMAIL,
    ]);
    

    $client = new Google_Client();
    $client->setApplicationName("Events");
    $client->setScopes($all_scopes);
    $client->setAuthConfig(storage_path('app/googleClient/client_secret.json')); // Corrected method name and path
    $client->setState('gcalender');
    $client->setRedirectUri($redirectUrl);
    $client->setAccessType('offline');
    $client->setApprovalPrompt('force');
    $client->addScope(Google_Service_Calendar::CALENDAR);
    return $client;
}

public function authUrl()
{
    $client = $this->google_client_config(); 
    $authUrl = $client->createAuthUrl();
    return $authUrl;
}

public function getClient()
{
    // Create a new Google API client
    $client = new Google_Client();

    // Set the application name (you can use your Laravel app name)
    $client->setApplicationName(config('app.name'));

    // Set the required scopes for Google Service (Google Calendar in this case)
    $client->setScopes(Google_Service_Directory::ADMIN_DIRECTORY_RESOURCE_CALENDAR_READONLY);

    // Set the path to the client secret JSON file
    $client->setAuthConfig(storage_path('keys/client_secret.json'));

    // Set the access type to 'offline' for obtaining refresh tokens
    $client->setAccessType('offline');

    // Set the approval prompt to 'force' (optional, depending on your needs)
    // $client->setApprovalPrompt('force');

    // Set the prompt to 'consent' (optional, depending on your needs)
    $client->setPrompt('consent');

    // Set the redirect URI for handling the OAuth callback
    $redirect_uri = url('/google-calendar/auth-callback');
    $client->setRedirectUri($redirect_uri);

    return $client;
}



}