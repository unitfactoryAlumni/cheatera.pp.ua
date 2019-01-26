<?php
/**
 * Created by PhpStorm.
 * User: omentes
 * Date: 1/23/19
 * Time: 6:20 PM
 */

namespace app\helpers;


use app\models\ProjectsAll;

class ProjectsHelper
{
    public function getProjectsByLogin($login, $cursusID)
    {
        $models = new ProjectsAll();
        $let = $models::find()
            ->where(['projects_users.xlogin' => 'apakhomo', 'projects_users.cursus_ids' => 1]);
        return $let;
    }
}
