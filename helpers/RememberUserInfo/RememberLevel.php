<?php

namespace app\helpers\RememberUserInfo;

use Yii;

class RememberLevel extends RememberHelper
{

    protected function init() { }
    protected function norminate() { }

    protected function remember()
    {
        Yii::$app->session->set('level', $this->response['cursus_users'][0]['level']);
    }

}
