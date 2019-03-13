<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use \app\helpers\ViewHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\controllers\ShowSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var array $breadcrumbs */
/* @var array $months */
/* @var array $years */
/* @var array $action */

$this->params['breadcrumbs'][] = strtok($this->title, " ");
?>
<div class="show-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(['timeout' => 10000 ]); ?>
        <?= $this->render('_search', ['searchModel' => $searchModel, 'action' => $action, 'months' => $months, 'years' => $years]) ?>
        <?php $tmp = Yii::$app->session->get('username') ?>

        <div class="table-responsive">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel'  => $searchModel,
                'tableOptions' => [
                    'class' => 'table table-striped table-bordered table-responsive'
                ],
                'rowOptions'=>function($data) use ($tmp) {
                    if($data['login'] == $tmp){
                        return ['class' => 'warning'];
                    } else if ($data['lastloc'] == 0) {
                        return ['class' => 'success'];
                    }
                },
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'login',
                    [
                        'label' => '',
                        'format' => 'raw',
                        'attribute' => '',
                        'contentOptions'=> ['style'=>'position: relative'],
                        'value'  => function($data) use ($pageName) {
                            return ViewHelper::getLinkWithHover($data['login'], $pageName);
                        },
                    ],
                    'displayname',
                    'phone',
                    [
                        'attribute'=>'level',
                        'value'=>'level',
                    ],
                    'correction_point',
                    'pool_year',
                    'pool_month',
                    'location',
                    [
                        'label' => Yii::t('app', 'lastloc'),
                        'attribute' => 'lastloc',
                        'format' => 'raw',
                        'value' => function($data) {
                            if ($data['lastloc'] == 0) {

                                return Yii::t('app', 'ONLINE');
                            }
                            return ViewHelper::getHumanTime($data['lastloc']);
                        },
                    ],
                    'wallet',
                    'howach',
                    'hours',
                ],
            ]); ?>
        </div>
    <?php Pjax::end(); ?>
</div>
