<?php

namespace app\helpers\RememberUserInfo;

use app\models\Show;

class RememberUser extends RememberHelper
{

    protected function init()
    {
        $this->responseSubSet =& $this->response;
        $this->model = new Show();
    }

    protected function norminate()
    {
        $this->responseSubSet['kick'] = 0; // ??? WTF
        $this->responseSubSet['lastloc'] = date('Y-m-d H:i:s'); // ??? WTF
        self::swapKeysInArr($this->responseSubSet, [ 'id' => 'xid' ]);
    }

    protected function remember()
    {
        self::saveChangesToDB($this->model, $this->responseSubSet, $this->model->find()
            ->Where([ 'xid' => $this->responseSubSet['xid'] ])
            ->orWhere([ 'login' => $this->responseSubSet['login'] ])
        ->all());
    }

}
