<?php

namespace app\helpers;

use Yii;
use app\models\Xlogins;
use app\models\Skills;
use app\models\CursusUsers;

class RememberUserInfo
{

    public $response = null;

    public function __construct($response = null)
    {
        $this->response = $response;
    }

    public function rememberAll()
    {
        if ($this->response === null) {
            return ;
        }

        $this->rememberLevel();
        $this->rememberXlogin();
        $this->rememberCursusUsersAndSkills();
    }

    private function rememberLevel()
    {
        Yii::$app->session->set('level', $this->response['cursus_users'][0]['level']);
    }

    private function rememberXlogin()
    {
        $xlogins = new Xlogins();
        $xlogins =  $xlogins->findOne(['xid' => $this->response['id']])
                    ?? $xlogins;
        $xlogins->attributes = $this->response;
        $xlogins->save(false);
    }

    private function rememberCursusUsersAndSkills()
    {
        $cursusUsers = new CursusUsers();
        $skills = new Skills();
        $cursus_users = $this->response['cursus_users'];

        foreach ($cursus_users as $cursus) {
            foreach ($cursus['skills'] as $skill) {
                $skills =   $skills->findOne([ 'xlogin' => $this->response['login'], 'skills_id' => $skill['id'] ])
                            ?? $skills;
                $skill['skills_id'] = $skill['id']; // ???WTF
                $skill['skills_name'] = $skill['name']; // ???WTF
                $skill['skills_level'] = $skill['level']; // ???WTF

                $skills->attributes = $skill;
                $skills->save(false);
            }
            $cursusUsers =  $cursusUsers->findOne(['cursus_users_id' => $cursus['id']])
                            ?? $cursusUsers;
            $cursus['begin_at'] = date('Y-m-d H:i:s', strtotime($cursus['begin_at'])); // ! normilizing time format for mySQL
            $cursusUsers->attributes = $cursus;
            $cursusUsers->save(false);
        }
    }
}
