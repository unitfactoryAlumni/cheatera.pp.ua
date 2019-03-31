<?php

namespace app\helpers\RememberUserInfo;

abstract class RememberHelper
{

    abstract protected function init();
    abstract protected function remember();
    abstract protected function norminate();


    protected $response;

    protected $responseSubSet;
    protected $model;


    public function __construct(&$response)
    {
        $this->response =& $response;
        $this->init();

        $this->norminate();
        $this->remember();
    }


    protected function setLogin(&$varToSetLogin)
    {
        $varToSetLogin = $this->response['login'];
    }


    protected static function isArraysIdentical($a1, $a2, $arrayKeysToCompare)
    {
        foreach ($arrayKeysToCompare as $keyForBoth) {
            if ($a1[$keyForBoth] != $a2[$keyForBoth]) {
                return false;
            }
        }
        return true;
    }

    protected static function setTrueFalse(&$varToSetTrueFalse)
    {
        $varToSetTrueFalse = $varToSetTrueFalse ? 'True' : 'False';
    }

    protected static function setNULLtoZero(&$arrToSetZeros)
    {
        foreach ($arrToSetZeros as &$val) {
            $val = $val ?? 0;
        }
    }

    protected static function dateToSqlFormat(&$date)
    {
        $date = date('Y-m-d H:i:s', strtotime( $date ));
    }

    protected static function swapKeysInArr(&$arrToChangeKeys, $keys)
    {
        foreach ($keys as $keyToReplace => $keyToPut) {
            if ($arrToChangeKeys[$keyToPut] === null && $arrToChangeKeys[$keyToReplace] != null) {
                $arrToChangeKeys[$keyToPut] = $arrToChangeKeys[$keyToReplace];
                unset($arrToChangeKeys[$keyToReplace]);
            }
        }
    }

    protected static function mergeChildArrByKey(&$arr, $key)
    {
        foreach ($arr[$key] as $k => $v) {
            $arr[$k] = $v;
        }
        unset($arr[$key]);
    }


    protected static function saveChangesToDB($baseActiveRecordModel, $arrToPutIntoDb, $activeRecords)
    {
        if (empty($activeRecords)) {
            $baseActiveRecordModel->attributes = $arrToPutIntoDb;
            $baseActiveRecordModel->insert(false);
        }

        $identicalFound = false;
        $len = sizeof($activeRecords) - 1;

        foreach ($activeRecords as $index => &$AR) {
            if (static::isArraysIdentical($arrToPutIntoDb, $AR, $AR::attributes())) {
                $identicalFound = true;
                continue ;
            }

            if ($identicalFound || $index != $len) {
                $AR->delete();
            } else {
                $AR->attributes = $arrToPutIntoDb;
                $AR->update(false);
            }
        }
    }

}
