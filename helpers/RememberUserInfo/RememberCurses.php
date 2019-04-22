<?php

namespace app\helpers\RememberUserInfo;

class RememberCurses extends RememberHelper
{

    /**
     * {@inheritdoc}
     */
    protected function init()
    {
        $this->responseSubset = $this->response['cursus_users'];
        $this->model = 'app\models\Curses';
        $this->idcol = 'cursus_users_id';

        $this->ARcollection = $this->model::find()
            ->where([ 'xlogin' => $this->xlogin ])
        ->all();
    }

    /**
     * {@inheritdoc}
     */
    protected function remember()
    {
        foreach ($this->responseSubset as &$curs) {
            unset($curs['user']);
            unset($curs['cursus']['id']);
            self::mergeChildArrByKey($curs, 'cursus');
            self::dateToSqlFormat($curs['begin_at']);
            self::dateToSqlFormat($curs['created_at']);
            self::dateToSqlFormat($curs['end_at']);
            self::swapKeysInArr($curs, [ 'id' => 'cursus_users_id' ]);
            $curs['xlogin'] = $this->xlogin;
            $curs['xid'] = $this->xid;
            self::setTrueFalse($curs['has_coalition']);
            $curs['grade'] = $curs['grade'] ?? 'None';

            $this->saveChangesToDB($curs);
        }
    }

}
