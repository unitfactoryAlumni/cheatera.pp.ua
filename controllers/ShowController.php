<?php

namespace app\controllers;

use Yii;
use app\models\Show;
use app\controllers\ShowSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ShowController implements the CRUD actions for Show model.
 */
class ShowController extends CommonController
{
    /**
     * Lists all Students.
     * @return mixed
     */
    public function actionStudents()
    {
        $searchModel = new ShowSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Pools.
     * @return mixed
     */
    public function actionPools()
    {
        $searchModel = new ShowSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModelLogin($id),
        ]);
    }

    protected function findModelLogin($id)
    {
        if (($model = Show::find()
                ->join('INNER JOIN', 'cursus_users', 'cursus_users.xlogin = xlogins.login')
                ->where(['login' => $id, 'cursus_users.cursus_id' => 1])
                ->limit(1)
                ->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    /**
     * Finds the Show model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Show the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Show::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
