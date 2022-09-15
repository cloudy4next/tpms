<?php

namespace App;

use App\Models\Admin;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;

class GoogleService
{
    protected $user;
    protected $user_type;

    protected $client;

    public function __construct($user,$user_type)
    {
        $this->user = $user;
        $this->user_type=$user_type;
        $this->client = $this->google_client_config();
        if ($user && $user->gcalendar_access_tokken) {
            if ($user->gcalendar_access_tokken != "null") {
                $jsondecodeToken = json_decode($user->gcalendar_access_tokken, true);
                $this->client->setAccessToken($jsondecodeToken);
            }
        }

        if ($user && $user->gcalendar_refresh_tokken) {
            if ($user->gcalendar_refresh_tokken != "null") {
                $jsondecodeToken = json_decode($user->gcalendar_access_tokken, true);
                $this->client->setAccessToken($jsondecodeToken);
                if ($this->client->isAccessTokenExpired()) {
                    $this->refresh_access_token();
                }
            }
        }
    }

    public function google_callback()
    {

        $Column = "gcalendar_integration";
        $columnaccess = "gcalendar_access_tokken";
        $refreshColumn = "gcalendar_refresh_tokken";
        try {
            $client = $this->google_client_config();
            if (isset($_GET['code'])) {
                $client->authenticate($_GET['code']);
                $jsondecodeToken = $client->getAccessToken();
                $jsonFormToken = json_encode($jsondecodeToken);
                $this->user->$Column = 1;
                $this->user->$columnaccess = $jsonFormToken;
                $this->user->$refreshColumn = $jsonFormToken;
                $this->user->save();
                if($this->user_type=="admin"){
                    $user = Admin::where('id', Auth::user()->id)->first();
                }
                else{
                    $user = Employee::where('id', Auth::user()->id)->first();
                }
                $user->gcalendar_integration = 1;
                $user->gcalendar_access_tokken = $jsonFormToken;
                $user->gcalendar_refresh_tokken = $jsonFormToken;
                $user->save();

            } else {
                return false;
            }
            return $client;
        } catch (\Exception $exception) {
            return false;
        }
    }

    public function google_client_config()
    {
        if($this->user_type=="admin"){
            $redirectURL = "user.integration.authorize_google_calendar";
        }
        else{
            $redirectURL = "provider.user.integration.authorize_google_calendar";
        }
        $all_scopes = implode(' ', array(\Google_Service_Calendar::CALENDAR));
        $client = new \Google_Client();
        $client->setApplicationName("Events");
        $client->setScopes($all_scopes);
        $client->setAuthConfig(storage_path('app/latest_google_client.json'));
        $client->setState('gcalendar');
        $client->setRedirectUri(route($redirectURL));
        $client->setAccessType('offline');
        $client->setApprovalPrompt("force");
        return $client;
    }

    public function google_client()
    {
        return $this->client;
    }

    public function authUrl()
    {
        $client = $this->client;
        return $auth_url = $client->createAuthUrl();
    }

    public function is_google_token_expired()
    {
        $client = $this->client;
        if ($this->user && $this->user->gcalendar_access_tokken) {
            if($this->user->gcalendar_access_tokken!="null"){
                $jsondecodeToken = json_decode($this->user->gcalendar_access_tokken, true);
                $client->setAccessToken($jsondecodeToken);
                return $client->isAccessTokenExpired();
            }
        }
        return true;
    }

    public function refresh_access_token()
    {
        $access_token = $this->user->gcalendar_refresh_tokken;
        $access_token = json_decode($access_token, true);
        $this->client->setAccessToken($access_token);
        $this->client->fetchAccessTokenWithRefreshToken($this->client->getRefreshToken());
        $access_token = $this->client->getAccessToken();
        $access_token_json = json_encode($access_token);
        $this->user->gcalendar_access_tokken = $access_token_json;
        $this->user->save();
        $this->client->setAccessToken($access_token);
    }

    public function redirectc($url)
    {
        if (!headers_sent()) {
            header('Location: ' . $url);
            exit;
        } else {
            echo '<script type="text/javascript">';
            echo 'window.location.href="' . $url . '";';
            echo '</script>';
            echo '<noscript>';
            echo '<meta http-equiv="refresh" content="0;url=' . $url . '" />';
            echo '</noscript>';
            exit;
        }
    }
}
