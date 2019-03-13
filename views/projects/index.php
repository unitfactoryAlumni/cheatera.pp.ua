<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\controllers\ProjectsFilterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var array $breadcrumbs */
/* @var array $months */
/* @var array $years */
/* @var array $action */

$this->title = Yii::t('app', 'Projects');
$this->params['breadcrumbs'][] = ['label' => $breadcrumbs['name'], 'url' => [$breadcrumbs['url']]];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="projects-all-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(['timeout' => 10000 ]); ?>
        <?= $this->render('_search', ['model' => $searchModel, 'action' => $action, 'months' => $months, 'years' => $years]) ?>

        <div class="table-responsive">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'name',
                    [
                        'label' => '',
                        'format' => 'raw',
                        'attribute' => '',
                        'value'  => function ($data) use ($subPage) {
                            return Html::a(Html::img(yii\helpers\Url::to('/web/img/profile.jpg'), ['width' => '20px']),'/'. Yii::$app->language . "$subPage/" . $data['slug'], ['data-pjax' => '0']);
                        },
                    ],
                    'final_mark',
                    'validated',
                    'finished',
                    'failed',
                    'wfc',
                    'inprogress',
                    'sag',
                    'cg',
                ],
            ]); ?>
        </div>
    <?php Pjax::end(); ?>
</div>
