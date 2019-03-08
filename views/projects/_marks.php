<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\controllers\ProjectsFilterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var string $pageName */
/* @var string $case */
/* @var string $subPage */

    $tmp = Yii::$app->session->get('username') ?>
    <div class="projects-all-search">

        <?php $form = ActiveForm::begin([
            'action' => [$action],
            'method' => 'get',
            'options' => [
                'data-pjax' => 1
            ],
        ]); ?>

        <?php echo $form->field($searchModel, 'pool_month') ?>
        <?php echo $form->field($searchModel, 'pool_year') ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
<?php     $tmp = Yii::$app->session->get('username'); ?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel'  => $searchModel,
    'tableOptions' => [
        'class' => 'table table-striped table-bordered table-responsive'
    ],
    'rowOptions'=>function($data) use ($tmp) {
        if($data['xlogin'] == $tmp){
            return ['class' => 'info'];
        } else if ($data['lastloc'] == 0) {
            return ['class' => 'success'];
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
                return Html::a(Html::img(yii\helpers\Url::to('/web/img/profile.jpg'), ['width' => '20px']),'/'. Yii::$app->language . '/'. $pageName . '/'. $data['xlogin'], ['data-pjax' => '0']);
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