<?php

namespace app\helpers\RememberUserInfo;

use app\models\Achievements;

class RememberAchievements extends RememberHelper
{

    protected function init()
    {
        $this->responseSubset =& $this->response['achievements'];
    }

    protected function norminate()
    {
        foreach ($this->responseSubset as &$achievement) {
            $achievement['xlogin'] = $this->xlogin;
            self::setTrueFalse($achievement['visible']);
            $achievement['nbr_of_success'] = $achievement['nbr_of_success'] ?? 'None';
            self::swapKeysInArr($achievement, [ 'id' => 'aid' ]);
        }
    }

    protected function remember()
    {
        foreach ($this->responseSubset as &$achievement) {
            $this->model = new Achievements();
            self::saveChangesToDB($this->model, $achievement, $this->model->find()
                ->Where([ 'aid' => $achievement['aid'] ])
                ->andWhere([ 'xlogin' => $achievement['xlogin'] ])
            ->all());
        }
    }

}
