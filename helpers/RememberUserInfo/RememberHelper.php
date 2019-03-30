<?php

namespace app\helpers\RememberUserInfo;

abstract class RememberHelper
{

    abstract public function rememberToDB();
    abstract protected function norminateTheResponse();


    protected $response;


    public function __construct(&$response)
    {
        $this->response =& $response;
        static::norminateTheResponse();
        static::rememberToDB();
    }


    protected static function isArraysIdentical($a1, $a2, $arrayKeysToCompare)
    {
        foreach ($arrayKeysToCompare as $keyFor_both) {
            if ($a1[$keyFor_both] != $a2[$keyFor_both]) {
                return false;
            }
        }
        return true;
    }

    protected static function dateToSqlFormat(&$date)
    {
        $date = date('Y-m-d H:i:s', strtotime( $date ));
    }

    protected static function swapKeysInArr(&$arrToChangeKeys, $keys)
    {
        foreach ($keys as $keyToReplace => $keyToPut) {
            $arrToChangeKeys[$keyToPut] = $arrToChangeKeys[$keyToReplace];
            unset($arrToChangeKeys[$keyToReplace]);
        }
    }

    protected static function mergeChildArrByKey(&$arr, $key)
    {
        foreach ($arr[$key] as $key => $val) {
            $arr[$key] = $val;
        }
        unset($arr[$key]);
    }


    protected static function saveChangesToDB($baseActiveRecordModel, $arrToPutIntoDb, $activeRecords)
    {
        if ( empty($activeRecords) ) {
            $baseActiveRecordModel->attributes = $arrToPutIntoDb;
            $baseActiveRecordModel->insert(false);
        }

        $identicalNotFound = true;
        $len = sizeof($activeRecords) - 1;

        foreach ($activeRecords as $index => $AR) {
            if ( static::isArraysIdentical($arrToPutIntoDb, $AR, $AR::attributes()) ) {
                $identicalNotFound = false;
                continue ;
            }

            if ( $identicalNotFound && $index == $len ) {
                $AR->attributes = $arrToPutIntoDb;
                $AR->update(false);
            } else {
                $AR->delete();
            }
        }
    }

}
