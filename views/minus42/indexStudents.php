<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\controllers\Minus42StudentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->params['breadcrumbs'][] = ['label' => $breadcrumbs['name'], 'url' => [$breadcrumbs['url']]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="minus42-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(['timeout' => 10000 ]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'xlogin',
            [
                'label' => 'to user',
                'format' => 'raw',
                'attribute' => '',
                'value'  => function ($data) use ($subPage) {
                    return Html::a(Html::img(yii\helpers\Url::to('/web/img/profile.jpg'), ['width' => '20px']),'/'. Yii::$app->language . "/$subPage/" . $data['xlogin'], ['data-pjax' => '0']);
                },
            ],
            'name',
            [
                'label' => 'to project',
                'format' => 'raw',
                'attribute' => '',
                'value'  => function ($data) use ($subPage) {
                    return Html::a(Html::img(yii\helpers\Url::to('/web/img/profile.jpg'), ['width' => '20px']),'/'. Yii::$app->language . "/$subPage/projects/" . $data['slug'], ['data-pjax' => '0']);
                },
            ],
            'updated_at',
            'pool_year',
            'pool_month',
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
