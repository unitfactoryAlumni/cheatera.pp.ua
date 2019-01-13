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

    /**
     * Lists all Projects models.
     * @return mixed
     */
    public function actionStudents()
    {
        $this->setMeta(
            Yii::t('app', 'Students projects UNIT Factory'),
            Yii::t('app','Full information about students projects from UNIT Factory')
        );

        $searchModel = new ProjectsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'breadcrumbs' => [
                'name' => Yii::t('app', 'Students'),
                'url' => 'show/students'
            ],
            'subPage' => '/students/projects'
        ]);
    }

    /**
     * Lists all Projects models.
     * @return mixed
     */
    public function actionPools()
    {
        $this->setMeta(
            Yii::t('app', 'Pools projects UNIT Factory'),
            Yii::t('app','Full information about pools projects from UNIT Factory')
        );

        $searchModel = new ProjectsPoolsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'breadcrumbs' => [
                'name' => Yii::t('app', 'Pools'),
                'url' => 'show/pools'
            ],
            'subPage' => '/pools/projects'
        ]);
    }

    /**
     * Displays a single students Projects model.
     * @param integer $id
     * @return mixed
     */
    public function actionStudentsView($id)
    {
        $this->setMeta(
            Yii::t('app', '{0} :: students project UNIT Factory', $id),
            Yii::t('app','Full information about {0} from UNIT Factory', $id)
        );
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
        ]);
    }

    /**
     * Displays a single Project models.
     * @param integer $id
     * @return mixed
     */
    public function actionPoolsView($id)
    {
        $this->setMeta(
            Yii::t('app', '{0} :: pools project UNIT Factory', $id),
            Yii::t('app', 'Full information about {0} from UNIT Factory', $id)
        );
        $this->course = 4;

        $searchModel = new ProjectsAllSearch($this->course, $id);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('view', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'breadcrumbs' => [
                '0' => [
                    'name' => Yii::t('app', 'Pools Projects'),
                    'url' => 'projects/pools',
                ],
                '1' => [
                    'name' => Yii::t('app', 'Pools Projects'),
                    'url' => 'projects/pools',
                ],
            ],
        ]);
    }
}
