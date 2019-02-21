<?php

namespace app\controllers;

// use app\helpers\Auth42;
// use app\models\User;
// use yii\authclient\ClientInterface as ClientInterfaceAlias;

use Yii;
// use yii\filters\AccessControl;
// use yii\helpers\Url;
// use yii\web\Controller;
// use yii\web\HttpException;
// use yii\web\Response;
// use yii\filters\VerbFilter;

use app\models\Calculator;

/**
 * CalculatorController just shows Calculator model work results.
 */
class CalculatorController extends CommonController
{
    /**
    * Displays calculator itself.
    *
    * @return string
    */
    public function actionIndex()
    {
        $model = new Calculator();

        $model->attributes = \Yii::$app->request->post();

        if ($model->validate()) {
            $this->view->title = 'Experience calculator';
            $model->lvlstart = (int)$model->attributes['lvlstart'];
            $model->tier = (int)$model->attributes['tier'];
        } else {
            $errors = $model->errors;
        }
        return $this->render('index', ['model' => $model]);
    }
}
