<?php
/**
 * Created by PhpStorm.
 * User: omentes
 * Date: 1/22/19
 * Time: 10:57 PM
 */

namespace app\helpers;


use app\models\Skills;

class SkillsHelper
{
    public static function getSkills($login, $cursesID)
    {
        return Skills::find()
            ->select(['skills.*'])
            ->where(['xlogin' => $login, 'cursus_id' => $cursesID])
            ->orderBy('skills_level DESC')
            ->all();
    }
}