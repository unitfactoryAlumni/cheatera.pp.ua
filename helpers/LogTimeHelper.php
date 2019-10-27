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
            $result = $result . '.' . strtok((($exp[1] / 60) * 100), '.');

            return ($result);
        }
        strtok($countTime, '.');
        $summa = floatval("$summa");
        $exp = explode(':', $countTime);
        $result = intval($exp[0]);
        $result = $result . '.' . strtok((($exp[1] / 60) * 100), '.');
        $forReturn = round(floatval($result) + floatval($summa), 2);

        return "$forReturn";
    }

    public static function fix24(&$data)
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

    /**
     * getChartJSInfo
     *
     * @param Locations[] $models
     * @param array       $get - GET request
     *
     * @return array [$labels, $data, $amount] - info for ChartJS::widget
     */
    public static function getChartJSInfo($models, $get = [])
    {
        $labels = [];
        $data = [];
        $arr = [];
        $tempDate = null;
        $count = count($models);
        $amount = 0;
        $tempDate = '';

        if (isset($get['LocationsSearch']['dateEnd'])) {
            $tempDate = $get['LocationsSearch']['dateEnd'];
        } else {
            $tempDate = date('Y-m-d', time());
        }

        $first = '';
        foreach ($models as $model) {
            $first = $model->date;
            break;
        }

        while ($tempDate != $first) {
            $tempDate = date('Y-m-d', strtotime($tempDate . "-1 days"));
            $arr[$tempDate] = '00.00';
            break;
        }

        foreach ($models as $model) {
            if ($count > 0) {
                if ($tempDate != $model->date) {
                    while ($count > 0 && $tempDate != $model->date) {
                        $tempDate = date('Y-m-d', strtotime($tempDate . "-1 days"));
                        $arr[$tempDate] = '00.00';
                    }
                } else {
                    $tempDate = date('Y-m-d', strtotime($model->date));
                    $count--;
                }
            }
            if (isset($arr[$model->date]) && $count > 0) {
                $arr[$model->date] = self::countTime($model->how, $arr[$model->date]);
            } else {
                $arr[$model->date] = self::countTime($model->how);
            }
            $tempDate = date('Y-m-d', strtotime($model->date));
        }

        foreach ($arr as $key => $value) {
            $labels = array_merge([$key], $labels);
            $data = array_merge([$value], $data);
            $amount += $value;
        }

        self::fix24($data);

        return [$amount, $labels, $data];
    }
}
