<?php

namespace app\controllers;

use app\models\ProjectsAll;
use Yii;
use app\models\Projects;
use app\controllers\ProjectsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProjectsController implements the CRUD actions for Projects model.
 */
class ProjectsController extends CommonController
{
    protected $course;
    /** 1. Написать метод проверки. Варианты
     *           - есть дочки, рендерим ParentCase
     *           - есть родитель, рендерим с крошками родителя
     *           - нет дочек - рендерим как сейчас
     *           - нет ничего - вернуть 404.
     *     Все по максимуму разбить в разные методы и вынести. Крошки можно вынести в хелпер, пригодится
     *     Также выносим в методы проверку дочка/родители и тд
     *
     *  2. Добавить функционал фильтрации как в таблице аггрегации в самом просмотре проекта
     */

    /**
     * Lists all Projects models.
     * @return mixed
     */
    public function actionStudents()
    {
        $title = Yii::t('app', 'Students projects UNIT Factory');
        $description = Yii::t('app','Full information about students projects from UNIT Factory');
        $this->setMeta($title, $description);

        $searchModel = new ProjectsFilterSearch(['course' => '1', 'parent' => '0']);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'breadcrumbs' => [
                'name' => Yii::t('app', 'Students'),
                'url' => 'show/students'
            ],
            'subPage' => '/students/projects',
            'action' => 'students'
        ]);
    }

    /**
     * Lists all Projects models.
     * @return mixed
     */
    public function actionPools()
    {
        $title = Yii::t('app', 'Pools projects UNIT Factory');
        $description = Yii::t('app','Full information about pools projects from UNIT Factory');
        $this->setMeta($title, $description);

        $searchModel = new ProjectsFilterSearch(['course' => 4, 'parent' => 0]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'breadcrumbs' => [
                'name' => Yii::t('app', 'Pools'),
                'url' => 'show/pools'
            ],
            'subPage' => '/pools/projects',
            'action' => 'pools'
        ]);
    }

    /**
     * Displays a single students Projects model.
     * @param integer $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionStudentsView($id)
    {
        $type = self::checkParentAndChildProjects($id);
        if ($type) {
            return $type > 0 ? self::renderParentProject($id, 'students', 1): self::renderSingleProject($id, 'students', 1);
        }
        return self::renderSingleProject($id, 'students', 1);
    }


    /**
     * Displays a single Project models.
     * @param integer $id
     * @return mixed
     */
    public function actionPoolsView($id)
    {
        return self::renderSingleProject($id, 'students', 4);
    }

    /**
     * @param $id
     * @return int
     * @throws NotFoundHttpException
     */
    private function checkParentAndChildProjects($id)
    {
        $model = Projects::find()->where("slug = '$id'")->one();
        if ($model !== null) {
            if (ProjectsAll::find()
                    ->where(['parent_id' => $id])
                    ->one() !== null) {
                return 1;
            } else if ($model->parent_id !== 0) {
                return -1;
            } else {
                return 0;
            }
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Method for render Single Project Page without child and parent
     *
     * @param $id
     * @param $case
     * @param $course
     * @return string
     */
    private function renderSingleProject($id, $case, $course)
    {
        $getName = Projects::find()->where("slug = '$id'")->one();
        $project_name = $getName->name;
        $title = Yii::t('app', '{0} :: $case project UNIT Factory', $project_name);
        $description = Yii::t('app','Full information about {0} from UNIT Factory', $project_name);
        $this->setMeta($title, $description);
        $searchModel = new ProjectsAllSearch($course, $id);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

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
        ]);
    }
    private function renderParentProject($id, $case, $course)
    {
        $getName = Projects::find()->where("slug = '$id'")->one();
        $getId = (Projects::find()->where("slug = '$id'")->one())->project_id;
        $project_name = $getName->name;
        $title = Yii::t('app', '{0} :: $case project UNIT Factory', $project_name);
        $description = Yii::t('app','Full information about {0} from UNIT Factory', $project_name);
        $this->setMeta($title, $description);
        $searchModel = new ProjectsAllSearch($course, $id);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $searchModel2 = new ProjectsFilterSearch(['course' => $course, 'parent' => $getId]);
        $dataProvider2 = $searchModel2->search(Yii::$app->request->queryParams);

        return $this->render('view_with_childs', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'searchModel2' => $searchModel2,
            'dataProvider2' => $dataProvider2,
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
            'subPage' => "/$case/projects",
            'action' => "$case/projects/$id"
        ]);
    }

}
