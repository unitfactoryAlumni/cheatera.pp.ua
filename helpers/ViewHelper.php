<?php
/**
 * Created by PhpStorm.
 * User: omentes
 * Date: 1/22/19
 * Time: 10:25 PM
 */

namespace app\helpers;


class ViewHelper
{
    /**
     * Study progress in percent
     *
     * @param $level
     * @return float|int
     */
    public static function getProgress($level)
    {
        return $level < 21 ? $level/(21/100): 100 ;
    }

    /**
     * Project progress in percent
     *
     * @param $mark
     * @return float|int
     */
    public static function getProgressProject($mark)
    {
        return $mark > 49 ? $mark/(125/100) : 100;
    }

    /**
     * Get class by level
     *
     * @param $level
     * @return string
     */
    public static function getLevelColorClass($level)
    {
        if ($level >= 16)
            return "danger";
        if ($level >= 14)
            return "warning";
        if ($level >= 7)
            return "info";
        return "success";
    }
}