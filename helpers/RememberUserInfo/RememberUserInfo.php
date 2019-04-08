<?php

namespace app\helpers\RememberUserInfo;

use Yii;

/**
 * Fills `cursus_users`, `skills`, `projects_users`, `achievements` and `xlogin` tables of cheatera's database
 * .json given from 42 RESTfull API -- $response
 */
class RememberUserInfo
{

    /**
     * rememberAllToDB
     *
     * @param  array $response - .json given from 42 RESTfull API converted to php array
     *
     * @return void
     */
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
