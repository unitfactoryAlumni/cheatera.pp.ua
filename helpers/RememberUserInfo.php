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
        $xlogins = $xlogins->findOne(['xid' => $this->response['id']]);
        $xlogins->attributes = $this->response;
        $xlogins->save(false);
    }

    private function rememberCursusUsersAndSkills()
    {
        $cursusUsers = new CursusUsers();
        $skills = new Skills();
        $cursus_users = $this->response['cursus_users'];

        $skills->attributes = $skills->findOne(['xlogin' => $this->response['login']]); // ? Is this check considers enough?

        $cursus_users[0]['grade'] = 'lol';
        foreach ($cursus_users as $v) {
            // foreach ($v['skills'] as $k => $v) {
            //     
            // }
            $cursusUsers = $cursusUsers->findOne(['cursus_users_id' => $v['id']]);
            $v['begin_at'] = date('Y-m-d H:i:s', strtotime($v['begin_at'])); // ! normilizing time format for mySQL
            $cursusUsers->attributes = $v;
            $cursusUsers->save(false);
        }
    }
}
