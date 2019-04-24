<?php

namespace app\helpers\RememberUserInfo;

use Yii;

/**
 * Fills `cursus_users`, `skills`, `projects_users`, `achievements` and `xlogin` tables of cheatera's database 
 * by response from OAuth2, 42API, when user login
 */
class RememberUserInfo
{

    /**
     * rememberAllToDB
     * @param array $response - .json given from 42 RESTfull API converted to php array
     */
    public function __construct($response)
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
