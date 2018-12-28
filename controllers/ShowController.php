<?php
/**
 * Created by PhpStorm.
 * User: omentes
 * Date: 12/28/18
 * Time: 11:17 AM
 */

namespace app\controllers;


class ShowController extends AccessController
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}