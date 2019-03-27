<?php

namespace app\helpers;

use Yii;

use app\models\Show;
use app\models\Curses;
use app\models\Skills;
use app\models\ProjectsAll;

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

    private function isArraysIdentical($arrayKeysToCompare, $a1, $a2)
    {
        foreach ($arrayKeysToCompare as $keyFor_a1 => $keyFor_a2) {
            if ($a1[$keyFor_a1] != $a2[$keyFor_a2]) {
                return false;
            }
        }
        return true;
    }

    private function norminateArrToPut(&$arrToPut, $keys)
    {
        foreach ($keys as $keyToReplace => $keyToPut) {
            $arrToPut[$keyToPut] = $arrToPut[$keyToReplace];
            unset($arrToPut[$keyToReplace]);
        }
    }

    private function makeDbAction($activeRecords, $arrToPutIntoDb)
    {
        if ( empty($activeRecords) ) {
            // ! INSERT
        }

        $len = sizeof($activeRecords);
        foreach ($activeRecords as $index => $AR) {
            if ( $index == $len  ) {
                // ! UPDATE
                $AR->attributes = $arrToPutIntoDb;
                $AR->save(false);
            }
            // ! DELETE
        }
    }

    private function rememberLevel()
    {
        Yii::$app->session->set('level', $this->response['cursus_users'][0]['level']);
    }

    private function rememberXlogin()
    {
        $xlogins = (new Show())->find()->where([ 'xid' => $this->response['id'] ])->all();

        // $this->norminateArrToPut($arrToPutIntoDb, $norminationRules);
        $this->makeDbAction($xlogins, $this->response);
        // $xlogins->attributes = $this->response;
        // $xlogin->save(false);
    }

    private function rememberCursusUsersAndSkills()
    {
        $cursusUsers = new Curses();
        $skills = new Skills();
        $cursus_users = $this->response['cursus_users'];

        // foreach ($cursus_users as $cursus) { // !!! Optimisation needed
        //     foreach 2($cursus['skills'] as $skill) {
        //         // $skills =   $skills->findOne([ 'xlogin' => $this->response['login'], 'skills_id' => $skill['id'] ])
        //         //             ?? $skills;
        //         $adopted_skill['xlogin'] = $this->response['login']; // ??? WTF
        //         $adopted_skill['skills_id'] = $skill['id']; // ??? WTF
        //         $adopted_skill['skills_name'] = $skill['name']; // ??? WTF
        //         $adopted_skill['skills_level'] = $skill['level']; // ??? WTF

        //         $skills->attributes = $adopted_skill;
        //         $skills->save(false);
        //     }
        //     $cursusUsers =  $cursusUsers->findOne(['cursus_users_id' => $cursus['id']])
        //                     ?? $cursusUsers;
        //     $cursus['begin_at'] = date('Y-m-d H:i:s', strtotime($cursus['begin_at'])); // ! normilizing time format for mySQL
        //     $cursusUsers->attributes = $cursus;
        //     $cursusUsers->save(false);
        // }
    }

    private function rememberProjectsUsers()
    {
        $pusers = new ProjectsAll();

        // foreach ($this->response['projects_users'] as $project) { // !!! Optimisation needed
        //     $pusers =   $pusers->findOne(['current_team_id' => $project['current_team_id']])
        //                 ?? $pusers;

        //     $pusers->attributes = $project;
        //     $pusers->save(false);
        // }
    }

    // TODO private function rememberPatroning()
}
