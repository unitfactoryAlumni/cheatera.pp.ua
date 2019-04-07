<?php

namespace app\helpers\RememberUserInfo;

use app\models\Show;

class RememberUser extends RememberHelper
{

    protected function init()
    {
        $this->responseSubSet =& $this->response;
        $this->model = new Show();
        $this->idcol = 'xid';
    }

    protected function norminate()
    {
        $this->responseSubSet['lastloc'] = date('Y-m-d H:i:s');
        $this->responseSubSet['howach'] = count($this->responseSubSet['achievements']);
        $this->responseSubSet['visible'] = $this->responseSubSet['visible'] ?? 1;
        $this->responseSubSet['needupd'] = 0;
        $this->responseSubSet['kick'] = 0;

        $this->responseSubSet['hours'] = 0; // ! Need help
        $this->responseSubSet['lasthours'] = 0; // ! Need help

        self::swapKeysInArr($this->responseSubSet, [ 'id' => 'xid', 'staff?' => 'staff' ]);
        self::setTrueFalse($this->responseSubSet['staff']);
    }

    protected function remember()
    {
        $this->ARcollection = $this->model::find()
            ->where([ 'xid' => $this->responseSubSet['xid'] ])
        ->all();

        $this->saveChangesToDB($this->responseSubSet);
    }

}
