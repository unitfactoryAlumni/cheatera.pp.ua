<?php

namespace app\helpers;

use Yii;
use yii\authclient\InvalidResponseException;
use yii\authclient\OAuth2;
use yii\helpers\Url;
use yii\web\HttpException;

class Auth42 extends OAuth2
{
    public $authUrl = 'https://api.intra.42.fr/oauth/authorize';

    public $tokenUrl = 'https://api.intra.42.fr/oauth/token';

    public $apiBaseUrl = 'https://api.intra.42.fr/v2/';

    /**
     * Initializes authenticated user attributes.
     * 
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

    public function setDefaultCoockies($response = null)
    {
        if ($response === null)
            return ;

        $cookies = Yii::$app->response->cookies;

        if (isset($response['cursus_users'][0]['level']) && !$cookies->has('level')) {
            $cookies->add(new \yii\web\Cookie([
                'name' => 'level',
                'value' => $response['cursus_users'][0]['level'],
                'expire' => time() + 86400 * 365,
            ]));
        }
    }

    /**
     * @param $token
     * @param array $params
     * 
     * @return mixed
     * 
     * @throws \yii\authclient\InvalidResponseException
     */
    public function fetchClientAuthCode($token = null, $params = [])
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

        $this->setDefaultCoockies($response);

        $profileLink = '/pools/';
        if (isset($response['cursus_users'])) {
            if (count($response['cursus_users']) > 1
            && isset($response['login'])) {
                $profileLink = Url::to('/students/' . $response['login']);
            } else if (isset($response['login'])) {
                $profileLink .= $response['login'];
            }
        } else {
            $profileLink = '';
        }
        Yii::$app->session['profile'] = $profileLink;
        return $response;
    }

    /**
     * @param $authCode
     * @param $state
     * @param array $params
     *
     * @return \yii\authclient\OAuthToken
     * 
     * @throws HttpException
     */
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
        try {
            $response = $this->sendRequest($request);
        } catch (InvalidResponseException $e) {
            throw new \yii\web\ForbiddenHttpException(Yii::t('app', '42API error! Please, try again'));
        }

        $token = $this->createToken(['params' => $response]);
        $this->setAccessToken($token);

        return $token;
    }
}
