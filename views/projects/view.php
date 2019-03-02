<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var array $breadcrumbs */
/* @var $searchModel app\controllers\ProjectsAllSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var string $pageName */

$this->params['breadcrumbs'][] = ['label' => $breadcrumbs['0']['name'], 'url' => [$breadcrumbs['0']['url']]];
$this->params['breadcrumbs'][] = ['label' => $breadcrumbs['1']['name'], 'url' => [$breadcrumbs['1']['url']]];
$this->params['breadcrumbs'][] = strtok($this->title, ' ');
?>
<div class="projects-view">
    <h1><?= Html::encode(strtok($this->title, ' ')) ?></h1>
    <?php Pjax::begin(); ?>
    <style>
        .filters .form-control {
            max-height: 25px;
        }

        .table {
            white-space: nowrap;
            /*font-size: smaller;*/
        }
    </style>
    <?php $tmp = Yii::$app->session->get('username') ?>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'tableOptions' => [
            'class' => 'table table-striped table-bordered table-responsive'
        ],
        'rowOptions'=>function($data) use ($tmp) {
            if($data['xlogin'] == $tmp){
                return ['class' => 'danger'];
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'xlogin',
            [
                'label' => '',
                'format' => 'raw',
                'attribute' => '',
                'value'  => function ($data) use ($pageName) {
                    return Html::a(Html::img(yii\helpers\Url::to('/web/img/profile.jpg'), ['width' => '20px']),'/'. Yii::$app->language . "/$pageName/" . $data['xlogin']);
                },
            ],
            'final_mark',
            'occurrence',
            'status',
            'validated',
            'location',
            'lastloc',
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
