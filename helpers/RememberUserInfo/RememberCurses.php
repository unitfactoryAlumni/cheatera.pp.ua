<?php

namespace app\helpers\RememberUserInfo;

use app\models\Curses;

class RememberCurses extends RememberHelper
{

    protected function norminateTheResponse()
    {
        foreach ($this->response['cursus_users'] as &$curs) {
            self::dateToSqlFormat($curs['begin_at']);
            self::swapKeysInArr($curs, [ 'id' => 'xid' ]);
            self::mergeChildArrByKey($curs, 'cursus');
            unset($curs['id']);
            unset($curs['user']);
            $curs['has_coalition'] = $curs['has_coalition'] ? 'True' : 'False';
            self::dateToSqlFormat($curs['created_at']);
        }
    }

    public function rememberToDB()
    {
        $curses = new Curses();

        foreach ($this->response['cursus_users'] as &$curs) {
            self::saveChangesToDB($curses, $curs, $curses->find()
                ->Where([ 'xlogin' => $curs['xlogin'] ])
                ->andWhere([ 'cursus_id' => $curs['cursus_id'] ])
            ->all());
        }
    }

}
