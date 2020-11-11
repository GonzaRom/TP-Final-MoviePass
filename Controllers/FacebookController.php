<?php

namespace Controllers;

use Facebook\Facebook as Facebook;
use Facebook\Exceptions\FacebookResponseException as FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException as FacebookSDKException;
use Controllers\UserController as UserController;

class FacebookController
{
    private $userController;

    public function __construct()
    {
        $this->userController = new UserController();
    }

    public function loginFacebook()
    {
        $fbObject = new Facebook([
            'app_id' => FAPP_ID,
            'app_secret' => FAPP_SECRET,
            'default_graph_version' => 'v3.2',
        ]);
        $handler = $fbObject->getRedirectLoginHelper();

        try {
            $accessToken = $handler->getAccessToken();
        } catch (FacebookResponseException $e) {
            echo "Exception:  " . $e->getMessage();
            exit;
        } catch (FacebookSDKException $e) {
            echo "SDK:  " . $e->getMessage();
            exit;
        }

        if (!isset($accessToken)) {
            if ($handler->getError()) {
                header('401 Unauthorized');
            } else {
                header('400 Bad Request');
            }
            exit;
        }

        $oAuth2Client = $fbObject->getOAuth2Client();

        $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
        $response = $fbObject->get("/me?fields=id,email,first_name,last_name,picture.type(large)", $accessToken);
        $userData = $response->getGraphUser()->asArray();
        $userData["password"] = $accessToken->getValue();

        $this->userController->loginFacebook($userData);
    }
}
