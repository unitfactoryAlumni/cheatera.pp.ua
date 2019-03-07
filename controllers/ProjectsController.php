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
     * @return mixed
     */
    public function actionStudentsView($id)
    {
        $getName = Projects::find()->where("slug = '$id'")->one();
        $project_name = $getName->name;
        $title = Yii::t('app', '{0} :: students project UNIT Factory', $project_name);
        $description = Yii::t('app','Full information about {0} from UNIT Factory', $project_name);
        $this->setMeta($title, $description);
        $this->course = 1;

        $searchModel = new ProjectsAllSearch($this->course, $id);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('view', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'breadcrumbs' => [
                '0' => [
                    'name' => Yii::t('app', 'Students'),
                    'url' => 'show/students',
                ],
                '1' => [
                    'name' => Yii::t('app', 'Students Projects'),
                    'url' => 'projects/students',
                ],
            ],
            'pageName' => 'students',
        ]);
    }

    /**
     * Displays a single Project models.
     * @param integer $id
     * @return mixed
     */
    public function actionPoolsView($id)
    {
        $getName = Projects::find()->where("slug = '$id'")->one();
        $project_name = $getName->name;
        $title = Yii::t('app', '{0} :: pools project UNIT Factory', $project_name);
        $description = Yii::t('app','Full information about {0} from UNIT Factory', $project_name);
        $this->setMeta($title, $description);
        $this->course = 4;

        $searchModel = new ProjectsAllSearch($this->course, $id);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('view', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'breadcrumbs' => [
                '0' => [
                    'name' => Yii::t('app', 'Pools'),
                    'url' => 'show/pools',
                ],
                '1' => [
                    'name' => Yii::t('app', 'Pools Projects'),
                    'url' => 'projects/pools',
                ],
            ],
            'pageName' => 'pools',
        ]);
    }
}
