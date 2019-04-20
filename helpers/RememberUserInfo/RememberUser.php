<?php

namespace app\helpers\RememberUserInfo;

class RememberUser extends RememberHelper
{

    /**
     * {@inheritdoc}
     */
    protected function init()
    {
        $this->responseSubset = $this->response;
        $this->model = 'app\models\Show';
        $this->idcol = 'xid';
    }

    /**
     * {@inheritdoc}
     */
    protected function norminate()
    {
        $this->responseSubset['lastloc'] = date('Y-m-d H:i:s');
        $this->responseSubset['howach'] = count($this->responseSubset['achievements']);
        $this->responseSubset['visible'] = $this->responseSubset['visible'] ?? 1;
        $this->responseSubset['needupd'] = 0;
        $this->responseSubset['kick'] = 0;

        $this->responseSubset['hours'] = 0; // ! Need help
        $this->responseSubset['lasthours'] = 0; // ! Need help

        self::swapKeysInArr($this->responseSubset, [ 'id' => 'xid', 'staff?' => 'staff' ]);
        self::setTrueFalse($this->responseSubset['staff']);
    }

    /**
     * {@inheritdoc}
     */
    protected function remember()
    {
        $this->ARcollection = $this->model::find()
            ->where([ 'login' => $this->responseSubset['login'] ])
        ->all();

        $this->saveChangesToDB($this->responseSubset);
    }

}
