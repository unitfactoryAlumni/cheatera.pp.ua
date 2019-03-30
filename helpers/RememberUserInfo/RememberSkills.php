<?php

namespace app\helpers\RememberUserInfo;

use app\models\Skills;

class RememberSkills extends RememberHelper
{

    protected function norminateTheResponse()
    {
        foreach ($this->response['cursus_users'] as &$cursus) {
            foreach ($cursus['skills'] as &$skill) {
                $skill['xlogin'] = $this->response['login'];
                $skill['cursus_id'] = $cursus['skills']['cursus_id'];
                self::swapKeysInArr($skill, [ 'id' => 'skills_id', 'name' => 'skills_name', 'level' => 'skills_level' ]);
            }
        }
    }

    public function rememberToDB()
    {
        $skills = new Skills();

        foreach ($this->response['cursus_users'] as &$cursus) {
            foreach ($cursus['skills'] as &$skill) {
                self::saveChangesToDB($skills, $skill, $skills->find()
                    ->Where([ 'skills_id' => $skill['skills_id'] ])
                    ->andWhere([ 'xlogin' => $skill['xlogin'] ])
                ->all());
            }
        }
    }

}
