<?php

namespace app\helpers\RememberUserInfo;

use Yii;

/**
 * Abstract class created to help save data to cheatera's database from .json given from 42 RESTfull API
 */
abstract class RememberHelper
{
    protected $response;

    protected $xlogin;

    protected $xid;

    protected $idcol = 'id';

    protected $responseSubset;

    protected $model;

    protected $ARcollection;

    protected $bulkInsertArray = [];

    protected $bulkUpdateArray = [];

    /**
     * init
     * @return void
     */
    abstract protected function init();

    /**
     * remember
     * @return void
     */
    abstract protected function remember();

    /**
     * __construct - method will done all work children of the class created for
     *
     * @param array $response - .json given from 42 RESTfull API converted to php array
     *
     * @see app\helpers\RememberUserInfo\RememberUserInfo
     */
    public function __construct(&$response)
    {
        $this->response =& $response;
        $this->xlogin = $response['login'];
        $this->xid = $response['id'];

        $this->init();
        $this->remember();
        $this->updateDB();
    }

    /**
     * isArraysIdentical
     *
     * @param array $a1
     * @param array $a2
     * @param array $arrayKeysToCompare
     */
    public static function isArraysIdentical($a1, $a2, $arrayKeysToCompare)
    {
        foreach ($arrayKeysToCompare as $keyForBoth) {
            if ($a1[$keyForBoth] != $a2[$keyForBoth]) {
                return false;
            }
        }

        return true;
    }

    /**
     * setTrueFalse
     *
     * @param bool reference $varToSetTrueFalse
     */
    public static function setTrueFalse(&$varToSetTrueFalse)
    {
        $varToSetTrueFalse = $varToSetTrueFalse ? 'True' : 'False';
    }

    /**
     * setNULLtoZero
     *
     * @param array reference $arrToSetZeros
     */
    public static function setNULLtoZero(&$arrToSetZeros)
    {
        foreach ($arrToSetZeros as &$val) {
            $val = $val ?? 0;
        }
    }

    /**
     * dateToSqlFormat
     *
     * @param string $date
     */
    public static function dateToSqlFormat(&$date)
    {
        if ($date) {
            $date = date('Y-m-d H:i:s', strtotime($date));
        }
    }

    /**
     * swapKeysInArr
     *
     * @param array reference $arrToChangeKeys
     * @param array $keys
     */
    public static function swapKeysInArr(&$arrToChangeKeys, $keys)
    {
        foreach ($keys as $keyToReplace => $keyToPut) {
            $arrToChangeKeys[$keyToPut] = $arrToChangeKeys[$keyToReplace];
            unset($arrToChangeKeys[$keyToReplace]);
        }
    }

    /**
     * mergeChildArrByKey
     *
     * @param array $arr
     * @param mixed $key - $arr's valid key
     */
    public static function mergeChildArrByKey(&$arr, $key)
    {
        foreach ($arr[$key] as $k => $v) {
            $arr[$k] = $v;
        }
        unset($arr[$key]);
    }

    /**
     * findARbyId
     *
     * @param array $id
     *
     * @return mixed|bool
     */
    protected function findARbyId($id)
    {
        foreach ($this->ARcollection as $key => $AR) {
            if ($AR[$this->idcol] == $id) {
                return $key;
            }
        }

        return false;
    }

    /**
     * batchInsert
     * @return bool|void
     */
    protected function batchInsert()
    {
        if (empty($this->bulkInsertArray)) {
            return false;
        }

        return Yii::$app->db->createCommand()
            ->batchInsert($this->model::tableName(), array_keys($this->bulkInsertArray[0]->attributes), $this->bulkInsertArray)
            ->execute();
    }

    /**
     * batchUpdate
     * @return bool|void
     */
    protected function batchUpdate()
    {
        if (empty($this->bulkUpdateArray)) {
            return false;
        }

        foreach ($this->bulkUpdateArray as $AR) {
            $AR->update(false);
        }
    }

    /**
     * batchDelete
     * @return bool|void
     */
    protected function batchDelete()
    {
        if (empty($this->ARcollection)) {
            return false;
        }

        foreach ($this->ARcollection as $AR) {
            $AR->delete();
        }
    }

    /**
     * updateDB
     */
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
        }
    }

    /**
     * saveChangesToDB
     *
     * @param array $arrToPutIntoDb
     */
    protected function saveChangesToDB($arrToPutIntoDb)
    {
        $ARkey = $this->findARbyId($arrToPutIntoDb[$this->idcol]);

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
