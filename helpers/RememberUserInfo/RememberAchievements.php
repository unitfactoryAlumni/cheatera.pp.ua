<?php

namespace app\helpers\RememberUserInfo;

class RememberAchievements extends RememberHelper
{

    /**
     * {@inheritdoc}
     */
    protected function init()
    {
        $this->responseSubset = $this->response['achievements'];
        $this->model = 'app\models\Achievements';
        $this->idcol = 'aid';
    }

    /**
     * {@inheritdoc}
     */
    protected function norminate()
    {
        foreach ($this->responseSubset as &$achievement) {
            $achievement['xlogin'] = $this->xlogin;
            self::setTrueFalse($achievement['visible']);
            $achievement['nbr_of_success'] = $achievement['nbr_of_success'] ?? 'None';
            self::swapKeysInArr($achievement, [ 'id' => 'aid' ]);
            $achievement['description'] = htmlentities($achievement['description']);
            $achievement['visible'] = $achievement['visible'] ?? 'True';
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function remember()
    {
        $this->ARcollection = $this->model::find()
            ->where(['xlogin' => $this->xlogin])
        ->all();

        foreach ($this->responseSubset as $achievement) {
            self::saveChangesToDB($achievement);
        }
    }

}
