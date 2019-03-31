<?php

namespace app\helpers\RememberUserInfo;

use app\models\Curses;

class RememberCurses extends RememberHelper
{

    protected function init()
    {
        $this->responseSubSet =& $this->response['projects_users'];
        $this->model = new Curses();
    }

    protected function norminate()
    {
        $this->responseSubSet =& $this->response['cursus_users'];

        foreach ($this->responseSubSet as &$curs) {
            self::dateToSqlFormat($curs['begin_at']);
            self::swapKeysInArr($curs, [ 'id' => 'xid' ]);
            self::mergeChildArrByKey($curs, 'cursus');
            unset($curs['id']);
            unset($curs['user']);
            self::setTrueFalse($curs['has_coalition']);
            self::dateToSqlFormat($curs['created_at']);
        }
    }

    protected function remember()
    {
        foreach ($this->responseSubSet as &$curs) {
            self::saveChangesToDB($this->model, $curs, $this->model->find()
                ->Where([ 'xlogin' => $curs['xlogin'] ])
                ->andWhere([ 'cursus_id' => $curs['cursus_id'] ])
            ->all());
        }
    }

}
