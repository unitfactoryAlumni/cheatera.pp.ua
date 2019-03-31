<?php

namespace app\helpers\RememberUserInfo;

use app\models\Achievements;

class RememberAchievements extends RememberHelper
{

    protected function init()
    {
        $this->responseSubSet =& $this->response['achievements'];
    }

    protected function norminate()
    {
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
            $this->model = new Achievements();
            self::saveChangesToDB($this->model, $achievement, $this->model->find()
                ->Where([ 'aid' => $achievement['aid'] ])
                ->andWhere([ 'xlogin' => $achievement['xlogin'] ])
            ->all());
        }
    }

}
