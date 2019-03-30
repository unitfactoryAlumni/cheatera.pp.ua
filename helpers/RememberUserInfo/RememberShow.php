<?php

namespace app\helpers\RememberUserInfo;

use app\models\Show;

class RememberShow extends RememberHelper
{

    protected function norminateTheResponse()
    {
        self::swapKeysInArr($this->response, [ 'id' => 'xid' ]);
    }

    public function rememberToDB()
    {
        $show = new Show();

        self::saveChangesToDB($show, $this->response, $show->find()
            ->Where([ 'xid' => $this->response['xid'] ])
            ->orWhere([ 'login' => $this->response['login'] ])
        ->all());
    }

}
