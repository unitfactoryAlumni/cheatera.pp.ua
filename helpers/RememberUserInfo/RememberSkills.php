<?php

namespace app\helpers\RememberUserInfo;

class RememberSkills extends RememberHelper
{

    protected function init()
    {
        $this->responseSubset = $this->response['cursus_users'];
        $this->model = 'app\models\Skills';
        $this->idcol = 'skills_id';
    }

    protected function norminate()
    {
        foreach ($this->responseSubset as &$cursus) {
            foreach ($cursus['skills'] as &$skill) {
                $skill['xlogin'] = $this->xlogin;
                $skill['cursus_id'] = $cursus['cursus_id'];
                self::swapKeysInArr($skill, [ 'id' => 'skills_id', 'name' => 'skills_name', 'level' => 'skills_level' ]);
                $skill['skills_name'] = htmlentities($skill['skills_name']);
            }
        }
    }

    protected function remember()
    {
        $this->ARcollection = $this->model::find()
            ->where([ 'xlogin' => $this->xlogin ])
        ->all();

        foreach ($this->responseSubset as $cursus) {
            foreach ($cursus['skills'] as $skill) {
                self::saveChangesToDB($skill);
            }
        }
    }

}
