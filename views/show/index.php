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
    <div style="white-space: nowrap;font-size: smaller;">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [
            ['class' => 'yii\grid\SerialColumn'],
            'login',
            'displayname',
            [
                'attribute' => 'image_url',
                'format'    => 'html',
                'label'     => 'Photo',
                'value'     => function ($data) {
                    return Html::img($data['image_url'],
                        ['width' => '60px']);
                },
            ],
            'phone',
            'correction_point',
            'pool_year',
            'pool_month',
            'location',
            'lastloc',
//            'url:ntext',
            'wallet',
            'howach',
            'hours',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?></div>
    <?php Pjax::end(); ?>
</div>
