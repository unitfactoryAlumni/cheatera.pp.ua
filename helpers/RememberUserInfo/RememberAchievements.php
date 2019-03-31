<?php

namespace app\helpers\RememberUserInfo;

use app\models\Achievements;

class RememberAchievements extends RememberHelper
{

    protected function init()
    {
        $this->responseSubSet =& $this->response['projects_users'];
        $this->model = new Achievements();
    }

    protected function norminate()
    {
        $this->responseSubSet =& $this->response['achievements'];

        foreach ($this->responseSubSet as &$achievement) {
            $this->setLogin($achievement['xlogin']);
            self::setTrueFalse($achievement['visible']);
            $achievement['nbr_of_success'] = $achievement['nbr_of_success'] ?? 'None';
            self::swapKeysInArr($achievement, [ 'id' => 'aid' ]);
        }
    }

    protected function remember()
    {
        foreach ($this->responseSubSet as &$achievement) {
            self::saveChangesToDB($this->model, $achievement, $this->model->find()
                ->Where([ 'aid' => $achievement['aid'] ])
                ->andWhere([ 'xlogin' => $achievement['xlogin'] ])
            ->all());
        }
    }

}
