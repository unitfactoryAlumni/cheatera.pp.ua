<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\controllers\ShowSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = strtok($this->title, " ");
?>
<div class="show-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>

    <p>
    </p>
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
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'tableOptions' => [
            'class' => 'table table-striped table-bordered table-responsive'
        ],
        'rowOptions'=>function($data) use ($tmp) {
            if($data['login'] == $tmp){
                return ['class' => 'danger'];
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'login',
            [
                'label' => '',
                'format' => 'raw',
                'attribute' => '',
                'value'  => function ($data) use ($pageName) {
                    return Html::a(Html::img(yii\helpers\Url::to('/web/img/profile.jpg'), ['width' => '20px']),"$pageName/" . $data['login']);
                },
            ],
            'displayname',
            // need for hover images
//            [
//                'label' => 'Name',
//                'format' => 'raw',
//                'value'  => function ($data) use ($pageName) {
//                        return Html::a(Html::encode($data['displayname']),"$pageName/" . $data['login']);
//                    },
//            ],
            'phone',
            [
                'attribute'=>'level',
                'value'=>'level',
                //'contentOptions'=>['style'=>'width: 120px;']
            ],
            'correction_point',
            'pool_year',
            'pool_month',
            'location',
            'lastloc',
//            'url:ntext',
            'wallet',
            'howach',
            'hours',
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
