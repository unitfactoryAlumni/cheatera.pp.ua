<?php

namespace app\helpers\RememberUserInfo;

use Yii;

class RememberUserInfo
{

    public static function rememberAllToDB($response)
    {
        if ($response === null) {
            return ;
        }

        Yii::$app->session->set('level', $response['cursus_users'][0]['level']);

        new RememberCurses($response);
        new RememberSkills($response);
        new RememberProjects($response);
        new RememberAchievements($response);
        new RememberUser($response);
    }

}
