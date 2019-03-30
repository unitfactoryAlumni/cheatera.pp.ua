<?php

namespace app\helpers\RememberUserInfo;

use app\models\Skills;

class RememberSkills extends RememberHelper
{

    protected function init()
    {
        $this->responseSubSet =& $this->response['projects_users'];
        $this->model = new Skills();
    }

    protected function norminate()
    {
        $this->responseSubSet =& $this->response['cursus_users'];

        foreach ($this->responseSubSet as &$cursus) {
            foreach ($cursus['skills'] as &$skill) {
                $this->setXlogin($skill);
                $skill['cursus_id'] = $cursus['cursus_id'];
                self::swapKeysInArr($skill, [ 'id' => 'skills_id', 'name' => 'skills_name', 'level' => 'skills_level' ]);
            }
        }
    }

    protected function remember()
    {
        foreach ($this->responseSubSet as &$cursus) {
            foreach ($cursus['skills'] as &$skill) {
                self::saveChangesToDB($this->model, $skill, $this->model->find()
                    ->Where([ 'skills_id' => $skill['skills_id'] ])
                    ->andWhere([ 'xlogin' => $skill['xlogin'] ])
                ->all());
            }
        }
    }

}
