<?php

namespace app\controllers;

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
        $this->view->title = 'Experience calculator';
        $model = new Calculator();

        $request = \Yii::$app->request;
        if ($request->isPost) {
           if ($model->load($request->post()) && $model->validate()) {
                $model->getMark();
           }
        }
        return $this->render('index', ['model' => $model]);
    }
}
