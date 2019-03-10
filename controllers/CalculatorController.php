<?php

namespace app\controllers;

use Yii;
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
        $title = Yii::t('app', 'Experience calculator');
        $description = Yii::t('app', 'Want to know your level after project evaluation -- use our Experience calculator!');
        $this->setMeta($title, $description);
        
        $model = new Calculator();
        $request = \Yii::$app->request;
        if ($request->isPost) {
           if ($model->load($request->post()) && $model->validate()) {
                $model->getMark();
           }
        }

        return $this->render('index', [
            'model' => $model,
            'breadcrumbs' => [
                'name' => Yii::t('app', 'Caclculator'),
                'url' => 'calculator'
            ],
        ]);
    }
}
