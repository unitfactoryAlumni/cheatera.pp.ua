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

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'login',
            [
                'attribute' => 'image_url',
                'format' => 'html',
                'label' => 'Photo',
                'value' => function ($data) {
                    return Html::img($data['image_url'],
                        ['width' => '60px']);
                },
            ],
            'email:email',
            'phone',
            'correction_point',
            'displayname',
            //'last_name',
            'location',
            'pool_month',
            'pool_year',
            //'staff',
//            'url:ntext',
            'wallet',
            'howach',
            //'kick',
            'lastloc',
            //'needupd',
            'hours',
            'lasthours',
            //'visible',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
