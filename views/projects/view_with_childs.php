<?php

use yii\helpers\Html;
use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var array $breadcrumbs */
/* @var $searchModel app\controllers\ProjectsAllSearch */
/* @var $searchModelSubProject app\controllers\ProjectsFilterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $dataProviderSubProject yii\data\ActiveDataProvider */
/* @var string $pageName */
/* @var string $subPage */
/* @var array $months */
/* @var array $years */

$this->params['breadcrumbs'][] = ['label' => ucfirst($breadcrumbs['0']['name']), 'url' => [$breadcrumbs['0']['url']]];
$this->params['breadcrumbs'][] = ['label' => ucfirst($breadcrumbs['1']['name']), 'url' => [$breadcrumbs['1']['url']]];
$this->params['breadcrumbs'][] = ucfirst(strtok($this->title, '::'));

$this->registerJs("
    $('table tr[data-href]').click(function () {
        if ($(this).data('href') !== undefined) {
            window.location.href = $(this).data('href');
        }
    });");

?>

<div class="projects-view">
    <h1><?= Html::encode(ucfirst(strtok($this->title, '::'))) ?></h1>

    <?php
    $subProjects =
        $this->render('_sub', ['action' => $action,
            'searchModel' => $searchModelSubProject,
            'dataProvider' => $dataProviderSubProject,
            'pageName' => $pageName,
            'subPage' => $subPage,
            'months' => $months,
            'years' => $years]);
    $marks =
        $this->render('_marks', ['action' => $action,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'pageName' => $pageName,
            'months' => $months,
            'years' => $years]);

    $tmp = Yii::$app->session->get('username');

    $items = [
        [
            'label' => '<i class="glyphicon glyphicon-list"></i> ' . Yii::t('app', 'Sub Project'),
            'content' => $subProjects,
            'active' => true,
        ],
        [
            'label' => '<i class="glyphicon glyphicon-check"></i> ' . Yii::t('app', 'Marks'),
            'content' => $marks,
        ],
    ];

    echo TabsX::widget([
        'items' => $items,
        'position' => TabsX::POS_ABOVE,
        'encodeLabels' => false,
    ]);
    ?>

</div>
