<?php

namespace app\helpers\RememberUserInfo;

use Yii;

abstract class RememberHelper
{

    abstract protected function init();
    abstract protected function remember();
    abstract protected function norminate();


    protected $response;
    protected $xlogin;
    protected $xid;
    protected $idcol = 'id';

    protected $responseSubset;
    protected $model;
    protected $ARcollection;

    protected $bulkInsertArray = [];
    protected $bulkUpdateArray = [];


    public function __construct(&$response)
    {
        $this->response =& $response;
        $this->xlogin = $response['login'];
        $this->xid = $response['id'];
        $this->init();

        $this->norminate();
        $this->remember();
        $this->updateDB();
    }


    public static function isArraysIdentical($a1, $a2, $arrayKeysToCompare)
    {
        foreach ($arrayKeysToCompare as $keyForBoth) {
            if ($a1[$keyForBoth] != $a2[$keyForBoth]) {
                return false;
            }
        }
        return true;
    }

    public static function setTrueFalse(&$varToSetTrueFalse)
    {
        $varToSetTrueFalse = $varToSetTrueFalse ? 'True' : 'False';
    }

    public static function setNULLtoZero(&$arrToSetZeros)
    {
        foreach ($arrToSetZeros as &$val) {
            $val = $val ?? 0;
        }
    }

    public static function dateToSqlFormat(&$date)
    {
        if ($date) {
            $date = date('Y-m-d H:i:s', strtotime( $date ));
        }
    }

    public static function swapKeysInArr(&$arrToChangeKeys, $keys)
    {
        foreach ($keys as $keyToReplace => $keyToPut) {
            $arrToChangeKeys[$keyToPut] = $arrToChangeKeys[$keyToReplace];
            unset($arrToChangeKeys[$keyToReplace]);
        }
    }

    public static function mergeChildArrByKey(&$arr, $key)
    {
        foreach ($arr[$key] as $k => $v) {
            $arr[$k] = $v;
        }
        unset($arr[$key]);
    }



    protected function setLogin(&$varToSetLogin)
    {
        $varToSetLogin = $this->xlogin;
    }

    protected function findARbyId($arrToPutIntoDb)
    {
        foreach ($this->ARcollection as $key => $AR) {
            if ($AR[$this->idcol] == $arrToPutIntoDb[$this->idcol]) {
                return $key;
            }
        }

        return false;
    }


    protected function batchInsert()
    {
        if (empty($this->bulkInsertArray)) {
            return false;
        }

        return Yii::$app->db->createCommand()
            ->batchInsert($this->model::tableName(), array_keys($this->bulkInsertArray[0]->attributes), $this->bulkInsertArray)
            ->execute();
    }

    protected function batchUpdate()
    {
        if (empty($this->bulkUpdateArray)) {
            return false;
        }

        foreach ($this->bulkUpdateArray as $AR) {
            $AR->update(false);
        }
    }

    protected function batchDelete()
    {
        if (empty($this->ARcollection)) {
            return false;
        }

        foreach ($this->ARcollection as $AR) {
            $AR->delete();
        }
    }

    protected function updateDB()
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $this->batchInsert();
            $this->batchUpdate();
            $this->batchDelete();
            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
    }

    protected function saveChangesToDB($arrToPutIntoDb)
    {
        $ARkey = $this->findARbyId($arrToPutIntoDb);

        if ($ARkey === false) {
            $ARtoInsert = new $this->model();
            $ARtoInsert->attributes = $arrToPutIntoDb;
            $this->bulkInsertArray[] = $ARtoInsert;
        } else {
            $this->ARcollection[$ARkey]->attributes = $arrToPutIntoDb;
            $this->bulkUpdateArray[] = $this->ARcollection[$ARkey];
            unset($this->ARcollection[$ARkey]);
        }
    }

}
