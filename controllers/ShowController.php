<?php
/**
 * Created by PhpStorm.
 * User: omentes
 * Date: 12/28/18
 * Time: 11:17 AM
 */

namespace app\controllers;


use app\models\Show;

class ShowController extends CommonController
{
    /*
     * Need translate this sucks to yii2 methods
     *
     *    $course = '42';
     *    if ($_GET['course'] == 'pool') {
     *      $course = 'Piscine C';
     *    }
     *    $bas = 0;
     *    $bastardswitch = "";//"and xlogins.kick=\"1\"";
     *    if ($_GET['course'] == 'pool') {
     *      $sql = $conn->query("SELECT `year`,`month`,`id` FROM `pools` ORDER BY `id` DESC LIMIT 0, 1");
     *      $data_array = array();
     *      $row = mysqli_fetch_assoc($sql);
     *      $data_array['year'] = $row['year'];
     *      $data_array['month'] = $row['month'];
     *      $bas = 1;
     *      $bastardswitch = "and xlogins.pool_year=\"" . $data_array['year'] . "\" and xlogins.pool_month=\"" . $data_array['month'] . "\"";
     *    }
     *    // SELECT xlogins.correction_point, xlogins.displayname, xlogins.correction_point, xlogins.image_url, xlogins.login, xlogins.phone, xlogins.pool_month, xlogins.pool_year, xlogins.wallet, xlogins.howach, xlogins.hours, xlogins.location, xlogins.lastloc, cursus_users.level FROM xlogins INNER JOIN cursus_users ON xlogins.xid = cursus_users.xid WHERE cursus_users.name="42" and xlogins.pool_month="july" and xlogins.pool_year="2018" ORDER BY cursus_users.level DESC, xlogins.login ASC
     *    // SELECT `xlogin`, COUNT(xlogin) FROM `friends` GROUP BY `xlogin` HAVING COUNT(*)>0 ORDER BY `COUNT(xlogin)` DESC
     *    $sql = "
     *    SELECT
     *      xlogins.correction_point,
     *      xlogins.displayname,
     *      xlogins.correction_point,
     *      xlogins.image_url,
     *      xlogins.login,
     *      xlogins.phone,
     *      xlogins.pool_month,
     *      xlogins.pool_year,
     *      xlogins.wallet,
     *      xlogins.howach,
     *      xlogins.hours,
     *      xlogins.location,
     *      xlogins.lastloc,
     *      cursus_users.level
     *    FROM
     *      xlogins
     *    INNER JOIN cursus_users ON xlogins.xid = cursus_users.xid
     *    WHERE xlogins.visible=\"1\" and cursus_users.name=\"" . $course . "\" " . $bastardswitch ."
     *    ORDER BY cursus_users.level DESC, xlogins.login ASC;";
     *    $result = $conn->query($sql);
     *
     */

    public function actionStudents()
    {
        $students = Show::find()->where(['needupd' => 1])->all();
        $this->setMeta('Students', 'students stat page');
        return $this->render('index', compact('students'));
    }

    public function actionPools()
    {
        return $this->render('index');
    }

}