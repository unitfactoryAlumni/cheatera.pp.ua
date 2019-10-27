<?php

namespace app\controllers;

use Yii;
use app\models\Show;
use app\models\ProjectsAll;
use yii\web\NotFoundHttpException;

/**
 * ProjectsController implements the CRUD actions for Projects model.
 */
class ProjectsController extends CommonController
{
    protected $course;

    protected $getId;

    protected $forParent;

    protected $team = 0;

    /**
     * Lists all Projects models.
     * @return mixed
     */
    public function actionStudents()
    {
        $title = Yii::t('app', 'Students projects UNIT Factory');
        $description = Yii::t('app', 'Full information about students projects from UNIT Factory');
        $this->setMeta($title, $description);
        $searchModel = new ProjectsFilterSearch(['course' => '1', 'parent' => '0']);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        [$months, $years] = self::getPoolsMonthAndYear();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'breadcrumbs' => [
                'name' => Yii::t('app', 'Students'),
                'url' => 'show/students',
            ],
            'subPage' => '/students/projects',
            'action' => 'students',
            'months' => $months,
            'years' => $years,
        ]);
    }

    /**
     * Lists all Projects models.
     * @return mixed
     */
    public function actionPools()
    {
        $title = Yii::t('app', 'Pools projects UNIT Factory');
        $description = Yii::t('app', 'Full information about pools projects from UNIT Factory');
        $this->setMeta($title, $description);
        $searchModel = new ProjectsFilterSearch(['course' => 4, 'parent' => 0]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        [$months, $years] = self::getPoolsMonthAndYear();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'breadcrumbs' => [
                'name' => Yii::t('app', 'Pools'),
                'url' => 'show/pools',
            ],
            'subPage' => '/pools/projects',
            'action' => 'pools',
            'months' => $months,
            'years' => $years,
        ]);
    }

    /**
     * Displays a single students Projects model.
     *
     * @param integer $id
     *
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionStudentsView($id)
    {
        $type = self::checkParentAndChildProjects($id);
        if (isset($type)) {
            return $type > 0 ? self::renderSingleProjectChild($id, 'students', 1)
                : self::renderParentProject($id, 'students', 1);
        }

        return self::renderSingleProject($id, 'students', 1);
    }

    /**
     * Displays a single Project models.
     *
     * @param integer $id
     *
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionPoolsView($id)
    {
        $type = self::checkParentAndChildProjects($id);
        if (isset($type)) {
            return $type > 0 ? self::renderSingleProjectChild($id, 'pools', 4)
                : self::renderParentProject($id, 'pools', 4);
        }

        return self::renderSingleProject($id, 'pools', 4);
    }

    /**
     * @param $id
     *
     * @return int
     * @throws NotFoundHttpException
     */
    private function checkParentAndChildProjects($id)
    {
        $model = ProjectsAll::find()->where("slug = '$id'")->one();
        if ($model !== null) {
            if (ProjectsAll::find()
                    ->where(['parent_id' => $model->project_id])
                    ->one() !== null
            ) {
                return 0;
            } elseif ($model->parent_id !== 0) {
                return 1;
            }

            return null;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Method for render Single Project Page without child and parent
     *
     * @param $id
     * @param $case
     * @param $course
     *
     * @return string
     */
    private function renderSingleProject($id, $case, $course)
    {
        self::beforeRender($id, $case);
        $searchModel = new ProjectsAllSearch($course, $id, $this->team);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        [$months, $years] = self::getPoolsMonthAndYear();

        return $this->render('view', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'breadcrumbs' => [
                '0' => [
                    'name' => Yii::t('app', $case),
                    'url' => "show/$case",
                ],
                '1' => [
                    'name' => Yii::t('app', $case . ' Projects'),
                    'url' => "projects/$case",
                ],
            ],
            'pageName' => $case,
            'action' => "$case/projects/$id",
            'months' => $months,
            'years' => $years,
            'team' => $this->team,
        ]);
    }

    /**
     * @param $id
     * @param $case
     * @param $course
     *
     * @return string
     */
    private function renderSingleProjectChild($id, $case, $course)
    {
        self::beforeRender($id, $case, true);
        $searchModel = new ProjectsAllSearch($course, $id, $this->team);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        [$months, $years] = self::getPoolsMonthAndYear();

        return $this->render('view', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'breadcrumbs' => [
                '0' => [
                    'name' => Yii::t('app', $case),
                    'url' => "show/$case",
                ],
                '1' => [
                    'name' => Yii::t('app', $case . ' Projects'),
                    'url' => "projects/$case",
                ],
                '2' => [
                    'name' => $this->forParent['name'],
                    'url' => "/students/projects/" . $this->forParent['slug'],
                ],
            ],
            'pageName' => $case,
            'action' => "$case/projects/$id",
            'months' => $months,
            'years' => $years,
            'team' => $this->team,
        ]);
    }

    /**
     * @param $id
     * @param $case
     * @param $course
     *
     * @return string
     */
    private function renderParentProject($id, $case, $course)
    {
        self::beforeRender($id, $case);
        $searchModel = new ProjectsAllSearch($course, $id, $this->team);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $searchModelSubProject = new ProjectsFilterSearch(['course' => $course, 'parent' => $this->getId]);
        $dataProviderSubProject = $searchModelSubProject->search(Yii::$app->request->queryParams);
        [$months, $years] = self::getPoolsMonthAndYear();

        return $this->render('view_with_childs', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'searchModelSubProject' => $searchModelSubProject,
            'dataProviderSubProject' => $dataProviderSubProject,
            'breadcrumbs' => [
                '0' => [
                    'name' => Yii::t('app', $case),
                    'url' => "show/$case",
                ],
                '1' => [
                    'name' => Yii::t('app', $case . ' Projects'),
                    //                    'url' => "projects/$case",
                    'url' => "projects/$case",
                ],
            ],
            'pageName' => $case,
            'subPage' => "/$case/projects",
            'action' => "$case/projects/$id",
            'months' => $months,
            'years' => $years,
            'team' => $this->team,
        ]);
    }

    /**
     * @param      $id
     * @param      $case
     * @param null $parent
     */
    private function beforeRender($id, $case, $parent = null)
    {
        $getName = ProjectsAll::find()->where("slug = '$id'")->one();
        $this->getId = (ProjectsAll::find()->where("slug = '$id'")->one())->project_id;
        $project_name = $getName->name;
        $title = Yii::t('app', '{0} :: {1} project UNIT Factory', [$project_name, $case]);
        $description = Yii::t('app', 'Full information about {0} from UNIT Factory', $project_name);
        $this->setMeta($title, $description);
        if (isset($parent)) {
            $parentName = ProjectsAll::find()->where("project_id = '{$getName->parent_id}'")->one();
            $this->forParent = ['slug' => $parentName->slug, 'name' => $parentName->name];
        }
    }

    /**
     * @return array
     */
    public function getPoolsMonthAndYear()
    {
        $months = [];
        $years = [];
        $monthQuery = Show::find()->select(['pool_month'])->where('visible = 1')->groupBy(['pool_month'])->all();
        $yearQuery = Show::find()->select(['pool_year'])->where('visible = 1')->groupBy(['pool_year'])->all();
        foreach ($monthQuery as $item) {
            $months = array_merge(["$item->pool_month" => "$item->pool_month"], $months);
        }
        foreach ($yearQuery as $item) {
            $str = "$item->pool_year";
            $years[$str] = (string)$item->pool_year;
        }

        return [$months, $years];
    }

    public function actionTeam($course, $name, $id)
    {
        $this->team = $id;

        return $course === 'students' ? $this->actionStudentsView($name) : $this->actionPoolsView($name);
    }
}
