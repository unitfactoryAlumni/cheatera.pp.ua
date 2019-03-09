<?php

namespace app\controllers;

use Yii;
use app\models\CorrectionLog;
use app\controllers\CorrectionsSearch;

/**
 * CorrectionLogController implements the CRUD actions for CorrectionLog model.
 */
class CorrectionsController extends CommonController
{
    /**
     * Lists all CorrectionLog models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CorrectionsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
