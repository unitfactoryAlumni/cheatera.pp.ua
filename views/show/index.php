<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\controllers\ShowSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Shows';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="show-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
<!--        <?//= Html::a('Create Show', ['create'], ['class' => 'btn btn-success']) ?>-->
    </p>
    <div style="white-space: nowrap;font-size: smaller;">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'login',
            'displayname',
            [
                'attribute' => 'image_url',
                'format' => 'html',
                'label' => 'Photo',
                'value' => function ($data) {
                    return Html::img($data['image_url'],
                        ['width' => '60px']);
                },
            ],
            'phone',
            'correction_point',
            //'last_name',
            'pool_year',
            'pool_month',
            'location',
            'lastloc',
            //'staff',
//            'url:ntext',
            'wallet',
            'howach',
            //'kick',
            //'needupd',
            'hours',
            //'visible',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?></div>
    <?php Pjax::end(); ?>
</div>
