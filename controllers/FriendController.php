<?php

namespace app\controllers;

use Yii;
use app\models\Friend;
use app\controllers\FriendSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FriendController implements the CRUD actions for Friend model.
 */
class FriendController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Friend models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FriendSearch(Yii::$app->user->identity->username, 1);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, true);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Lists all Friend models.
     * @return mixed
     */
    public function actionIncomeRequest()
    {
        $searchModel = new FriendSearch(Yii::$app->user->identity->username, 0);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, true);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Friend models.
     * @return mixed
     */
    public function actionOutgoingRequest()
    {
        $searchModel = new FriendSearch(Yii::$app->user->identity->username, 0);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, false);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Creates a new Friend model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionCreate($id, $course)
    {
        $model = new Friend();
        $model->mylogin = Yii::$app->user->identity->username;
        $model->xlogin = $id;
        $model->course = $course;
        if ($model->save()) {
            return $this->goBack();
        }
        return $this->redirect(['error']);
    }

    /**
     * Deletes an existing Friend model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        if (Friend::find()->where(['mylogin' => Yii::$app->user->identity->username, 'xlogin' => $id])->one()->delete() !== null) {
            return $this->goBack();
        }
        return $this->redirect(['friend/index']);
    }



    /**
     * Updates an existing Friend model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = Friend::find()->where(['xlogin' => Yii::$app->user->identity->username, 'mylogin' => $id])->one(); //inverse
        $model->status = 1;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['friend/index']);
        }
        return $this->redirect(['friend/index']);
    }


    /**
     * Finds the Friend model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Friend the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Friend::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
