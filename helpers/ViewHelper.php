<?php
/**
 * Created by PhpStorm.
 * User: omentes
 * Date: 1/22/19
 * Time: 10:25 PM
 */

namespace app\helpers;

use DateTime;
use Yii;
use yii\helpers\Url;
use yii\helpers\Html;

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
     * @param $course
     * @return float|int
     */
    public static function getProgressProject($mark, $course)
    {
        return $mark > (($course == 1) ? 49 : 24) ? $mark/(125/100) : 100;
    }

    /**
     * Project progress in color
     *
     * @param $mark
     * @param $course
     * @return float|int
     */
    public static function getProgressProjectColor($mark, $course, $status)
    {
        $min = ($course == 1) ? 49 : 24;
        if ($mark == 0) {
            return $status === 'finished' ? 'danger' : 'warning';
        }
        if ($mark > $min) {
            return 'success';
        }
        return $status === 'finished' ? 'danger' : 'warning';
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

    /**
     * @param $login
     * @param $course
     * @return string
     */
    public static function getLinkWithHover($login, $course)
    {
            return Html::img(
                Url::to(
                    "https://cdn.intra.42.fr/users/$login.jpg"),
                    [
                        'id' => "ah-$login",
                        'style' => 'position: absolute; left: 35px; top: 35px; width: 180px; display: none; z-index: 1111;',
                    ]
            )
            . Html::a(
            Html::img(
                Url::to(
                        '/web/img/profile.jpg'),
                        [
                            'width' => '20px',
                            'id' => 'ah',
                            'name' => $login,
                            'data-placement' => 'top',
                            'data-toggle' => 'tooltip',
                            'title' => Yii::t('app', 'Show profile ') . $login,
                            'data-original-title' => Yii::t('app', 'Show profile ') . $login
                        ]
                ),
            Url::to(
                '/' . Yii::$app->language . "/$course/$login"),
                [
                    'data-pjax' => '0',
                ]
        );
    }

    public static function getHumanTime($datetime, $full = false)
    {
        date_default_timezone_set('GTM+2');
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }
        if (!$full) $string = array_slice($string, 0, 1);
        $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'no data';
    }

}