<?php

namespace app\controllers;

use Yii;
use app\models\Minus42;
use app\controllers\Minus42Search;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Minus42Controller implements the CRUD actions for Minus42 model.
 */
class Minus42Controller extends CommonController
{
    /**
     * Lists all Students Minus42 models.
     * @return mixed
     */
    public function actionStudents()
    {
        $title = Yii::t('app', 'Cheating students members at UNIT Factory');
        $description = Yii::t('app','Full information about cheating from student members at UNIT Factory');
        $this->setMeta($title, $description);
        $searchModel = new Minus42StudentsSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('indexStudents', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'subPage' => 'students',
            'breadcrumbs' => [
                'name' => Yii::t('app', 'Students'),
                'url' => 'show/students'
            ],
        ]);
    }

    /**
     * Lists all Pools Minus42 models.
     * @return mixed
     */
    public function actionPools()
    {
        $title = Yii::t('app', 'Cheating pools members at UNIT Factory');
        $description = Yii::t('app','Full information about cheating from pool members at UNIT Factory');
        $this->setMeta($title, $description);
        $searchModel = new Minus42Search(4);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'subPage' => 'pools',
            'breadcrumbs' => [
                'name' => Yii::t('app', 'Pools'),
                'url' => 'show/pools'
            ],
        ]);
    }
}
