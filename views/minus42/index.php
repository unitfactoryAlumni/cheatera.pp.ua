<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\controllers\Minus42Search */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->params['breadcrumbs'][] = $this->title;
?>
<div class="minus42-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'xlogin',
            'puid',
            'updated_at',

        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
