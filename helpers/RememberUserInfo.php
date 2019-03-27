<?php

namespace app\helpers;

use Yii;
use app\models\Xlogins;
use app\models\Skills;
use app\models\CursusUsers;
use app\models\ProjectsUsers;

class RememberUserInfo
{
    /**
     * $response - response accepted by app\helpers\Auth42
     *
     * @var     Array
     */
    public $response = null;

    /**
     * __construct
     *
     * @param   Array  $response
     */
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
        $this->rememberProjectsUsers();
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

        foreach ($cursus_users as $cursus) { // !!! Optimisation needed
            foreach ($cursus['skills'] as $skill) {
                // $skills =   $skills->findOne([ 'xlogin' => $this->response['login'], 'skills_id' => $skill['id'] ])
                //             ?? $skills;
                $adopted_skill['xlogin'] = $this->response['login']; // ??? WTF
                $adopted_skill['skills_id'] = $skill['id']; // ??? WTF
                $adopted_skill['skills_name'] = $skill['name']; // ??? WTF
                $adopted_skill['skills_level'] = $skill['level']; // ??? WTF

                $skills->attributes = $adopted_skill;
                $skills->save(false);
            }
            $cursusUsers =  $cursusUsers->findOne(['cursus_users_id' => $cursus['id']])
                            ?? $cursusUsers;
            $cursus['begin_at'] = date('Y-m-d H:i:s', strtotime($cursus['begin_at'])); // ! normilizing time format for mySQL
            $cursusUsers->attributes = $cursus;
            $cursusUsers->save(false);
        }
    }

    private function rememberProjectsUsers()
    {
        $pusers = new ProjectsUsers();

        foreach ($this->response['projects_users'] as $project) { // !!! Optimisation needed
            $pusers =   $pusers->findOne(['current_team_id' => $project['current_team_id']])
                        ?? $pusers;

            $pusers->attributes = $project;
            $pusers->save(false);
        }
    }

    // TODO private function rememberPatroning()
}
