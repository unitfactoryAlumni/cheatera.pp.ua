<?php

namespace app\helpers\RememberUserInfo;

use app\models\Curses;

class RememberCurses extends RememberHelper
{

    protected function init()
    {
        $this->responseSubSet =& $this->response['cursus_users'];
    }

    protected function norminate()
    {
        foreach ($this->responseSubSet as &$curs) {
            $this->setLogin($curs['xlogin']);
            unset($curs['user']);
            unset($curs['cursus']['id']);
            self::mergeChildArrByKey($curs, 'cursus');
            self::dateToSqlFormat($curs['begin_at']);
            self::dateToSqlFormat($curs['created_at']);
            self::dateToSqlFormat($curs['end_at']);
            self::swapKeysInArr($curs, [ 'id' => 'xid' ]);
            self::setTrueFalse($curs['has_coalition']);
            $curs['grade'] = $curs['grade'] ?? 'None';
        }
    }

    protected function remember()
    {
        foreach ($this->responseSubSet as &$curs) {
            $this->model = new Curses();
            self::saveChangesToDB($this->model, $curs, $this->model->find()
                ->Where([ 'xlogin' => $curs['xlogin'] ])
                ->andWhere([ 'cursus_id' => $curs['cursus_id'] ])
            ->all());
        }
    }

}
