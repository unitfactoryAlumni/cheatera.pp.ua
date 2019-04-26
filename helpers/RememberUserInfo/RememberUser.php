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

        $this->ARcollection = $this->model::find()
            ->where([ 'login' => $this->responseSubset['login'] ])
        ->all();
    }

    /**
     * {@inheritdoc}
     */
    protected function remember()
    {
        $user = $this->ARcollection[$this->findARbyId($this->xid)];

        $this->responseSubset['lastloc'] = date('Y-m-d H:i:s');
        $this->responseSubset['howach'] = count($this->responseSubset['achievements']);

        $this->responseSubset['campus'] = $this->responseSubset['campus'][0]['name'];
        $this->responseSubset['visible'] = ($this->responseSubset['campus'] === 'Kyiv');

        $this->responseSubset['needupd'] = $user->needupd ?? 0; // !!!
        $this->responseSubset['kick'] = $user->kick ?? 0; // !!!
        $this->responseSubset['location'] = $user->location ?? 0; // !!!
        $this->responseSubset['hours'] = $user->hours ?? 0; // !!!
        $this->responseSubset['lasthours'] = $user->lasthours ?? 0; // !!!

        self::swapKeysInArr($this->responseSubset, [ 'id' => 'xid', 'staff?' => 'staff' ]);
        self::setTrueFalse($this->responseSubset['staff']);

        $this->saveChangesToDB($this->responseSubset);
    }

}
