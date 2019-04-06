<?php

namespace app\helpers\RememberUserInfo;

abstract class RememberHelper
{

    abstract protected function init();
    abstract protected function remember();
    abstract protected function norminate();


    protected $response;
    protected $xlogin;

    protected $responseSubSet;
    protected $model;

    protected $bulkInsertArray = [];
    protected $bulkUpdateArray = [];
    protected $bulkDeleteArray = [];


    public function __construct(&$response)
    {
        $this->response =& $response;
        $this->xlogin = $response['login'];
        $this->init();

        $this->norminate();
        $this->remember();
        $this->updateDB();
    }


    protected function setLogin(&$varToSetLogin)
    {
        $varToSetLogin = $this->xlogin;
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
        if ($date) {
            $date = date('Y-m-d H:i:s', strtotime( $date ));
        }
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


    protected static function findARbyId($arrToPutIntoDb, $activeRecords, $idstr)
    {
        foreach ($activeRecords as $key => $AR) {
            if ($AR[$idstr] == $arrToPutIntoDb[$idstr]) {
                return $key;
            }
        }

        return false;
    }

    protected static function saveBulkArr(&$bulkArr, $arrToPutIntoDb, $AR)
    {
        $bulkArr[] = ['arr' => $arrToPutIntoDb, 'AR' => $AR];
    }

    protected function updateDB($activeRecords)
    {
        foreach ($activeRecords as $AR) {
            static::saveBulkArr($this->bulkDeleteArray, null, $AR);
        }
        Yii::$app->db->createCommand()
            ->batchDelete(
                    $tableName, $columnNameArray, $bulkInsertArray
                )
            ->execute();
    }

    protected function saveChangesToDB($arrToPutIntoDb, &$activeRecords, $idstr = 'id')
    {
        $ARkey = static::findARbyId($arrToPutIntoDb, $activeRecords, $idstr);

        if ($ARkey === false) {
            static::saveBulkArr($this->bulkInsertArray, $arrToPutIntoDb, $activeRecords[$ARkey]);
        } else {
            static::saveBulkArr($this->bulkUpdateArray, $arrToPutIntoDb, $activeRecords[$ARkey]);
        }
        unset($activeRecords[$ARkey]);

        // $identicalFound = false;
        // $len = count($activeRecords) - 1;

        // foreach ($activeRecords as $index => &$AR) {
        //     if (static::isArraysIdentical($arrToPutIntoDb, $AR, $AR::attributes())) {
        //         $identicalFound = true;
        //         continue ;
        //     }

        //     if ($identicalFound || $index != $len) {
        //         $AR->delete();
        //     } else {
        //         $AR->attributes = $arrToPutIntoDb;
        //         $AR->update(false);
        //     }
        // }
    }

}
