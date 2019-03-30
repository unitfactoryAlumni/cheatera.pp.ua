<?php

namespace app\helpers\RememberUserInfo;

use app\models\Achievements;

class RememberAchievements extends RememberHelper
{

    protected function norminateTheResponse()
    {
        foreach ($this->response['achievements'] as &$achievement) {
            $achievement['xlogin'] = $this->response['login'];
            self::swapKeysInArr($achievement, [ 'id' => 'aid' ]);
        }
    }

    public function rememberToDB()
    {
        $achievements = new Achievements();

        foreach ($this->response['achievements'] as &$achievement) {
            self::saveChangesToDB($achievements, $achievement, $achievements->find()
                ->Where([ 'aid' => $achievement['aid'] ])
                ->andWhere([ 'xlogin' => $achievement['xlogin'] ])
            ->all());
        }
    }

}
