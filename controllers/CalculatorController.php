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
     * actionIndex
     *
     * @param   Object  $model  calculator's model
     *
     * @return  String          which sends to the View
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
            $model->resetToDefault();
        }

        return $this->render('index', [
            'model' => $model,
            'breadcrumbs' => [
                'name' => Yii::t('app', 'Calculator'),
                'url' => 'calculator'
            ],
        ]);
    }

    /**
     * getMarkFromPost
     *
     * @param   Object  $model  reference to Calculator's Model instance
     * @param   Array   $post   $post request array
     */
    private function getMarkFromPost( &$model, $post )
    {
        if ($model && $post
        && $model->load($post) && $model->validate() ) {
            foreach ($model->getTier() as $k => $v) {
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
    /**
     * actionFormSubmission
     *
     * @return  Float  to be set into the 'Result' field on the View
     */
    public function actionFormSubmission()
    {
        $model = new Calculator();
        $request = \Yii::$app->request;

        if ($request->isPost) {
            $post = $request->post();
            switch ($post) {
                case array_key_exists('resetToDefault', $post):
                    $model->resetToDefault();
                    break;
                default:
                    $this->getMarkFromPost($model, $post);
            }
        }

        return $this->actionIndex($model);
    }
}
