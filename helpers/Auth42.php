<?php
/**
 * Created by PhpStorm.
 * User: omentes
 * Date: 12/27/18
 * Time: 12:45 AM
 */

namespace app\helpers;

use yii\authclient\OAuth2;

class Auth42 extends OAuth2
{
    public $authUrl = 'https://api.intra.42.fr/oauth/authorize';

    public $tokenUrl = 'https://api.intra.42.fr/oauth/token';

    public $apiBaseUrl = 'https://api.intra.42.fr/v2/';

    /**
     * Initializes authenticated user attributes.
     * @return array auth user attributes.
     */
    protected function initUserAttributes()
    {
        return $this->api('userinfo', 'GET');
    }

    public function buildAuthUrl(array $params = [])
    {
        $defaultParams = [
            'client_id' => $this->clientId,
            'response_type' => 'code',
            'redirect_uri' => env('42_API_RU', ''),
        ];
        if (!empty($this->scope)) {
            $defaultParams['scope'] = $this->scope;
        }

        if ($this->validateAuthState) {
            $authState = $this->generateAuthState();
            $this->setState('authState', $authState);
            $defaultParams['state'] = $authState;
        }

        return $this->composeUrl($this->authUrl, array_merge($defaultParams, $params));
    }

    public function fetchClientAuthCode(OAuthToken $token = null, $params = [])
    {
        if ($token === null) {
            $token = $this->getAccessToken();
        }

        $params = array_merge([
            'access_token' => $token->getToken(),
            'redirect_uri' => env('42_API_RU', ''),
        ], $params);

        $request = $this->createRequest()
            ->setMethod('POST')
            ->setUrl($this->clientAuthCodeUrl)
            ->setData($params);

        $this->applyClientCredentialsToRequest($request);

        $response = $this->sendRequest($request);

        return $response['code'];
    }



    public function fetchMe($params)
    {
        $request = $this->createRequest()
            ->setMethod('GET')
            ->setUrl('https://api.intra.42.fr/v2/me')
            ->setHeaders($params);
        $response = $this->sendRequest($request);

        return $response;
    }

    public function fetchClientAccessToken($authCode, $state, array $params = [])
    {
        $params = array_merge([
            'code' => $authCode,
            'redirect_uri' => env('42_API_RU', ''),
            'client_id' => env('42_API_CI', ''),
            'client_secret' => env('42_API_CS', ''),
            'grant_type' => 'authorization_code',
            'state' => $state,
        ], $params);

        $request = $this->createRequest()
            ->setMethod('POST')
            ->setUrl($this->tokenUrl)
            ->setData($params);
        $response = $this->sendRequest($request);

        $token = $this->createToken(['params' => $response]);
        $this->setAccessToken($token);

        return $token;
    }
}