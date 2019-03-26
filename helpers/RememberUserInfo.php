<?php

namespace app\helpers;

use Yii;

class RememberUserInfo
{
    public static function rememberAll($response = null)
    {
        if ($response === null) {
            return ;
        }
        static::rememberLevel($response);
        static::rememberXlogin($response);
    }

    private static function rememberLevel($response)
    {
        $session = Yii::$app->session;
        if (!$session->isActive) {
            $session->open();
        }
        $session->set('level', $response['cursus_users'][0]['level']);
    }

    private static function rememberXlogin($response)
    {
        echo '<pre>';
        foreach ($response as $k => $v) {
            echo $k . PHP_EOL;
        }
        echo '</pre>'; die();
    }
}
