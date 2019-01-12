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
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'tableOptions' => [
            'class' => 'table table-striped table-bordered'
        ],
        'columns'      => [
            ['class' => 'yii\grid\SerialColumn'],
            'login',
            [
                'label' => 'Name',
                'format' => 'raw',
                'value'  => function ($data) use ($pageName) {
                        return Html::a(Html::encode($data['displayname']),"$pageName/" . $data['login']);
                    },
            ],
//            [
//                'attribute' => 'image_url',
//                'format'    => 'html',
//                'label'     => 'Photo',
//                'value'     => function ($data) {
//                    return Html::img($data['image_url'],
//                        ['width' => '60px']);
//                },
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
