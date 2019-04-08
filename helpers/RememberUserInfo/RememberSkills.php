<?php

namespace app\helpers\RememberUserInfo;

use app\models\Skills;

class RememberSkills extends RememberHelper
{

    protected function init()
    {
        $this->responseSubset =& $this->response['cursus_users'];
    }

    protected function norminate()
    {
        foreach ($this->responseSubset as &$cursus) {
            foreach ($cursus['skills'] as &$skill) {
                $skill['xlogin'] = $this->xlogin;
                $skill['cursus_id'] = $cursus['cursus_id'];
                self::swapKeysInArr($skill, [ 'id' => 'skills_id', 'name' => 'skills_name', 'level' => 'skills_level' ]);
            }
        }
    }

    protected function remember()
    {
        foreach ($this->responseSubset as &$cursus) {
            foreach ($cursus['skills'] as &$skill) {
                $this->model = new Skills();
                self::saveChangesToDB($this->model, $skill, $this->model->find()
                    ->Where([ 'skills_id' => $skill['skills_id'] ])
                    ->andWhere([ 'xlogin' => $skill['xlogin'] ])
                ->all());
            }
        }
    }

}
