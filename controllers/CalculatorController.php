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
    public function actionIndex( $model = null )
    {
        $title = Yii::t('app', 'Experience calculator');
        $description = Yii::t('app', 'Want to know your level after project evaluation -- use our Experience calculator!');
        $this->setMeta($title, $description);

        if ($model === null) {
            $model = new Calculator();
        }
        if (!$model->lvlstart) {
            $model->getCurlevel();
        }

        return $this->render('index', [
            'model' => $model,
            'breadcrumbs' => [
                'name' => Yii::t('app', 'Calculator'),
                'url' => 'calculator'
            ],
        ]);
    }

    public function actionFormSubmission()
    {
        $model = new Calculator();
        $request = \Yii::$app->request;

        if ($request->isPost) {
            if ( $request->post('getCurLevel') ) {
                $model->getCurlevel();
            } else if ( $model->load($request->post()) && $model->validate() ) {

                // Надо ли переносить код ниже в Модель???

                foreach ($model->getTier() as $k => $v) {
                    $post = $request->post();
                    if ( array_key_exists($k, $post) ) {
                        $tier = $model->tier = $k;
                    }
                }
                if ( isset($tier)
                    && !is_nan($tier)
                    && $tier <= 7
                    && $tier >= 0 ) {
                    $model->lvlstart = $model->getMark();
                }
            }
        }

        return $this->actionIndex($model);
    }
}
