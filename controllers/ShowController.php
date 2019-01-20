<?php

namespace app\controllers;

use Yii;
use app\models\Show;
use app\controllers\ShowSearch;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ShowController implements the CRUD actions for Show model.
 */
class ShowController extends CommonController
{
    protected $course;

    public $level;
    /**
     * Lists all Students.
     * @return mixed
     */
    public function actionStudents()
    {
        $this->setMeta(
            Yii::t('app', 'Students UNIT Factory'),
            Yii::t('app', 'All student members UNIT Factory')
        );
        $this->course = '42';
        $searchModel = new ShowSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $this->course);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'pageName' => 'students',
        ]);
    }

    /**
     * Lists all Pools.
     * @return mixed
     */
    public function actionPools()
    {
        $this->setMeta(
            Yii::t('app', 'Pools UNIT Factory'),
            Yii::t('app', 'All pool members UNIT Factory')
        );
        $this->course = 'Piscine C';

        $searchModel = new ShowSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $this->course);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'pageName' => 'pools',
        ]);
    }

    public function actionStudentsView($id)
    {
        $title = Yii::t('app', '{0} :: student member UNIT Factory', $id);
        $description = Yii::t('app','Full information about {0} from UNIT Factory', $id);
        $this->setMeta($title, $description);
        $this->course = '42';

        return $this->render('view', [
            'model' => $this->findModelLogin($id),
            'breadcrumbs' => [
                'name' => Yii::t('app', 'Students'),
                'url' => 'show/students'
            ],
        ]);
    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionPoolsView($id)
    {
        $this->setMeta(
            Yii::t('app', '{0} :: pool member UNIT Factory', $id),
            Yii::t('app', 'Full information about {0} from UNIT Factory', $id)
        );
        $this->course = 'Piscine C';

        return $this->render('view', [
            'model' => $this->findModelLogin($id),
            'breadcrumbs' => [
                'name' => Yii::t('app', 'Pools'),
                'url' => 'show/pools'
            ],
        ]);
    }

    /**
     * @param $id
     * @return array|\yii\db\ActiveRecord|null
     * @throws NotFoundHttpException
     */
    protected function findModelLogin($id)
    {
        if (($model = Show::find()
                ->select([
                    'xlogins.*',
                    'cursus_users.level'
                ])
                ->innerJoin('cursus_users','cursus_users.xlogin = xlogins.login')
                ->where(['login' => $id, 'cursus_users.name' => $this->course])
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
