<?php

namespace app\controllers;

use app\helpers\SkillsHelper;
use app\models\ProjectsLogin;
use Yii;
use app\models\Show;
use yii\web\NotFoundHttpException;

/**
 * ShowController implements the CRUD actions for Show model.
 */
class ShowController extends CommonController
{
    protected $course;

    /**
     * Lists all Students.
     * @return mixed
     */
    public function actionStudents()
    {
        $title = Yii::t('app', 'Students UNIT Factory');
        $description = Yii::t('app','All student members UNIT Factory');
        $this->setMeta($title, $description);
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
        $title = Yii::t('app', 'Pools UNIT Factory');
        $description = Yii::t('app','All pool members UNIT Factory');
        $this->setMeta($title, $description);
        $this->course = 'Piscine C';

        $searchModel = new ShowSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $this->course);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'pageName' => 'pools',
        ]);
    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionStudentsView($id)
    {
        $title = Yii::t('app', '{0} :: student member UNIT Factory', $id);
        $description = Yii::t('app','Full information about {0} from UNIT Factory', $id);
        $this->setMeta($title, $description);
        $this->course = '42';
        $skills = SkillsHelper::getSkills($id, 1);
        $projects = $this->findProjectsLoginModel($id, 1);
        $searchModelCorrections = new CorrectSearch($id);
        $dataProviderCorrections = $searchModelCorrections->search(Yii::$app->request->queryParams);
        $searchModelTime = new LocationsSearch($id);
        $dataProviderTime = $searchModelTime->search(Yii::$app->request->queryParams);

        return $this->render('view', [
            'model' => $this->findModelLogin($id),
            'searchModelTime' => $searchModelTime,
            'dataProviderTime' => $dataProviderTime,
            'searchModelCorrections' => $searchModelCorrections,
            'dataProviderCorrections' => $dataProviderCorrections,
            'breadcrumbs' => [
                'name' => Yii::t('app', 'Students'),
                'url' => 'show/students'
            ],
            'skills' => $skills,
            'switch' => 'pools',
            'urlHelperForProjects' => '/students/projects/',
            'projects' => $projects['common'],
            'parents' => $projects['parents'],
            'course' => 1,
            'action' => "/students/$id"
        ]);
    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionPoolsView($id)
    {
        $title = Yii::t('app', '{0} :: pool member UNIT Factory', $id);
        $description = Yii::t('app','Full information about {0} from UNIT Factory', $id);
        $this->setMeta($title, $description);
        $this->course = 'Piscine C';
        $skills = SkillsHelper::getSkills($id, 4);
        $projects = $this->findProjectsLoginModel($id, 4);
        $searchModelTime = new LocationsSearch($id);
        $dataProviderTime = $searchModelTime->search(Yii::$app->request->queryParams);

        return $this->render('view', [
            'model' => $this->findModelLogin($id),
            'breadcrumbs' => [
                'name' => Yii::t('app', 'Pools'),
                'url' => 'show/pools'
            ],
            'searchModelTime' => $searchModelTime,
            'dataProviderTime' => $dataProviderTime,
            'skills' => $skills,
            'switch' => 'students',
            'urlHelperForProjects' => '/pools/projects/',
            'projects' => $projects['common'],
            'parents' => $projects['parents'],
            'course' => 4,
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
                    'cursus_users.*'
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
     * @return array|\yii\db\ActiveRecord[]
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findProjectsLoginModel($id, $course)
    {
        if (($model = ProjectsLogin::find()
                ->where(['xlogin' => $id, 'cursus_ids' => $course])
                ->orderBy('puid asc, final_mark desc')
                ->all()) !== null) {
            return $this->sortedProjects($model);
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    private function sortedProjects(array $models)
    {
        $result = [];
        $copyModels = $models;
        foreach ($models as $model) {
            if ($model->parent_id === 0) {
                $result[] = $model;
            } else {
                $result['withParent'][$this->getProjectNameByID($model->parent_id, $copyModels)][] = $model;
            }
        }
        $parents = isset($result['withParent']) ? $result['withParent'] : [];
        unset($result['withParent']);
        return ['common' => $result, 'parents' => $parents];
    }

    private function getProjectNameByID($parent, array $models)
    {
        foreach ($models as $model) {
            if ($parent == $model->project_id) {
                return $model->name;
            }
        }
        return 'no name';
    }


}
