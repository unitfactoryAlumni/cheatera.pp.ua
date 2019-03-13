<?php

namespace app\controllers;

use app\helpers\Auth42;
use app\models\Log;
use app\models\User;

use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\HttpException;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends CommonController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
            ],
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Page after 42 auth.
     *
     * @return string
     * @throws HttpException
     * @throws \yii\base\ExitException
     */
    public function actionWelcome()
    {
        $request = Yii::$app->request->get();
        if (!isset($request['code'])) {
            Yii::$app->response->redirect(Url::to(['/']), 301);
            Yii::$app->end();
        }

        $user = new User;
        $api = new Auth42;
        $log = new Log;
        $token = $api->fetchClientAccessToken($request['code'], $request['state']);
        $token = $token->getToken();
        $answer = $api->fetchMe(["Authorization: Bearer $token"]);
        $userX = $user->findByUsername($answer['login']);

        if (!isset($userX)) {
            $userX = new User;
            $userX->newUser($answer);
        }

        $log->xlogin = $answer['login'];
        $log->agent = Yii::$app->request->headers["user-agent"];
        $log->ip = Yii::$app->request->userIP;
        $log->auth_date = new \yii\db\Expression('NOW()');
        $log->save();
        Yii::$app->user->login($userX);
        $userX->generateAuthKey();
        Yii::$app->session->set('username', $answer['login']);

        return $this->goBack();
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $title = Yii::t('app', 'Cheatera from UNIT Factory');
        $description = Yii::t('app', 'Cheatera - private social network for students from UNIT Factory');
        $this->setMeta($title, $description);
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        /**
         *  Yii::$app->response->redirect('/auth?authclient=auth42', 301)->send();
         */

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
