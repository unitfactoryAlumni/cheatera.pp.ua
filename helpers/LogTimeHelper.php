<?php
/**
 * Created by PhpStorm.
 * User: apakhomo
 * Date: 3/9/19
 * Time: 9:53 PM
 */

namespace app\helpers;


class LogTimeHelper
{
    public function countTime($countTime, $summa = null)
    {
        if (!isset($summa)) {
            strtok($countTime, '.');
            $exp = explode(':', $countTime);
            $result = intval($exp[0]);
            $result = $result . '.' . strtok((($exp[1]/60) * 100), '.');

            return ($result);
        }
        strtok($countTime, '.');
        $summa = floatval("$summa");
        $exp = explode(':', $countTime);
        $result = intval($exp[0]);
        $result = $result . '.' . strtok((($exp[1]/60) * 100), '.');
        $forReturn = round(floatval($result) + floatval($summa), 2);
        return "$forReturn";
    }

    public function fix24(&$data)
    {
        $fix = 0;
        foreach ($data as &$key) {

            if ($fix > 0) {
                $key = $fix;
                $fix = 0;
            }
            if ($key > 24.0) {
                $fix = $key - 24.00;
                $key = 24.00;
            }
        }
    }
}