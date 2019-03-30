<?php

namespace app\controllers;

use Yii;
use app\models\Friend;
use yii\web\Controller;
use yii\filters\VerbFilter;

/**
 * FriendController implements the CRUD actions for Friend model.
 */
class FriendController extends CommonController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return array_merge([
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ], parent::behaviors());
    }

    /**
     * Lists all Friend models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FriendSearch(Yii::$app->user->identity->username, 1);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, true);
        $searchModelIncome = new FriendSearch(Yii::$app->user->identity->username, 0);
        $dataProviderIncome = $searchModelIncome->search(Yii::$app->request->queryParams, true);
        $searchModelOutgoing = new FriendSearch(Yii::$app->user->identity->username, 0);
        $dataProviderOutgoing = $searchModelOutgoing->search(Yii::$app->request->queryParams, false);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'searchModelIncome' => $searchModelIncome,
            'dataProviderIncome' => $dataProviderIncome,
            'searchModelOutgoing' => $searchModelOutgoing,
            'dataProviderOutgoing' => $dataProviderOutgoing,
        ]);
    }

    /**
     * Creates a new Friend model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id, $course)
    {
        $model = new Friend();
        $model->mylogin = Yii::$app->user->identity->username;
        $model->xlogin = $id;
        $model->course = $course;
        $friend = Friend::find()->where(['mylogin' => $id, 'xlogin' => Yii::$app->user->identity->username])->one();
        if ($friend) {
            $friend->status = 1;
            $friend->save();
            $model->status = 1;
        }
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
        $friend = Friend::find()->where(['mylogin' => $id, 'xlogin' => Yii::$app->user->identity->username])->one();
        if ($friend) {
            $friend->status = 0;
            $friend->save();
        }
        if (Friend::find()->where(['mylogin' => Yii::$app->user->identity->username, 'xlogin' => $id])->one()->delete() !== null) {
            return $this->goBack();
        }
        return $this->redirect(['friend/index']);
    }
}
