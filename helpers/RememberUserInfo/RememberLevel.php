<?php

namespace app\helpers\RememberUserInfo;

use Yii;

class RememberLevel extends RememberHelper
{

    protected function norminateTheResponse() { }

    public function rememberToDB()
    {
        Yii::$app->session->set('level', $this->response['cursus_users'][0]['level']);
    }

}
