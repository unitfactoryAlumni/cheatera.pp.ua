<?php

namespace app\helpers;

use Yii;
use app\models\Xlogins;

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
        $xlogins = new Xlogins();
        $xlogins->attributes = $xlogins->findOne(['xid' => $response['id']]);
        $xlogins->attributes = $response;
        $xlogins->save(false);
    }
}
