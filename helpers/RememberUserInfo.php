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
        $this->rememberCurses();
        $this->rememberSkills();
        $this->rememberProjects();
    }



    private static function isArraysIdentical($a1, $a2, $arrayKeysToCompare)
    {
        foreach ($arrayKeysToCompare as $keyFor_both) {
            if ($a1[$keyFor_both] != $a2[$keyFor_both]) {
                return false;
            }
        }
        return true;
    }

    private static function dateToSqlFormat($date)
    {
        return date('Y-m-d H:i:s', strtotime( $date ));
    }

    private static function changeKeysInArr(&$arrToChangeKeys, $keys)
    {
        foreach ($keys as $keyToReplace => $keyToPut) {
            $arrToChangeKeys[$keyToPut] = $arrToChangeKeys[$keyToReplace];
            unset($arrToChangeKeys[$keyToReplace]);
        }
    }

    private function makeDbAction($baseActiveRecordModel, $arrToPutIntoDb, $activeRecords)
    {
        if ( empty($activeRecords) ) {
            $baseActiveRecordModel->attributes = $arrToPutIntoDb;
            $baseActiveRecordModel->insert(false);
        }

        $identicalNotFound = true;
        $len = sizeof($activeRecords) - 1;

        foreach ($activeRecords as $index => $AR) {
            if ( self::isArraysIdentical($arrToPutIntoDb, $AR, $AR::attributes()) ) {
                $identicalNotFound = false;
                continue ;
            }

            if ( $identicalNotFound && $index == $len  ) {
                $AR->attributes = $arrToPutIntoDb;
                $AR->update(false);
            } else {
                $AR->delete();
            }
        }
    }


    private function rememberLevel()
    {
        Yii::$app->session->set('level', $this->response['cursus_users'][0]['level']);
    }

    private function rememberXlogin()
    {
        $xlogin = new Show();
        self::changeKeysInArr($this->response, [ 'id' => 'xid' ]);


        $this->makeDbAction($xlogin, $this->response, $xlogin->find()
            ->Where([ 'xid' => $this->response['xid'] ])
            ->orWhere([ 'login' => $this->response['login'] ])
        ->all());
    }

    private function rememberCurses()
    {
        // $curses = new Curses();

        // foreach ($this->response['cursus_users'] as $curs) {
        //     $curs['begin_at'] = self::dateToSqlFormat($curs['begin_at']);

        //     $this->makeDbAction($curses, $curs, $curses->find()
        //             ->Where([ 'xid' => $this->response['xid'] ])
        //             ->orWhere([ 'login' => $this->response['login'] ])
        //         ->all());
        // }
    }

    private function rememberSkills()
    {
        // $skills = new Skills();

        // foreach ($this->response['cursus_users'] as &$cursus) {
        //     foreach ($cursus['skills'] as &$skill) {
        //         $skill['xlogin'] = $this->response['login'];
        //         self::changeKeysInArr($skill, [ 'id' => 'skills_id', 'name' => 'skills_name', 'level' => 'skills_level' ]);

        //         $this->makeDbAction($skills, $skill, $skills->find()
        //                 ->Where([ 'xid' => $this->response['xid'] ])
        //                 ->orWhere([ 'login' => $this->response['login'] ])
        //             ->all());
        //     }
        // }
    }

    /**
     * rememberProjects
     *
     * !!! Needs refactor for optimization purposes
     */
    private function rememberProjects()
    {
        $pusers = new ProjectsAll();

        foreach ($this->response['projects_users'] as &$project) {
            $project['xlogin'] = $this->response['login'];
            $project['cursus_ids'] = $project['cursus_ids'][0]; // ??? WTF
            $project['marked_at'] = self::dateToSqlFormat($project['marked_at']);
            self::changeKeysInArr($project, [ 'id' => 'puid', 'validated?' => 'validated' ]);
            $project['validated'] = $project['validated'] ? 'True' : 'False';
            // ??? WTF 'validated?' ? True ? False ? true ? false ?
        
            foreach ($project['project'] as $key => $val) {
                $project[$key] = $val;
            }
            unset($project['project']);
            self::changeKeysInArr($project, [ 'id' => 'project_id' ]);


            $this->makeDbAction($pusers, $project, $pusers->find()
                ->Where([ 'puid' => $project['puid'] ])
            ->all());
        }
    }

}
