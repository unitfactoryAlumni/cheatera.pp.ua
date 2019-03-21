<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $searchModel app\controllers\ProjectsFilterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var string $pageName */
/* @var string $case */
/* @var string $subPage */
/* @var array $months */
/* @var array $years */

    $tmp = Yii::$app->session->get('username') ?>
    <?php Pjax::begin(['timeout' => 10000 ]); ?>
    <div class="projects-all-search-sub">


        <?php $form = ActiveForm::begin([
            'layout'=>'inline',
            'action' => [$action],
            'method' => 'get',
            'options' => [
                'data-pjax' => 1
            ],
            'fieldConfig' => [
                'template' => "{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                'options' => [
                    'class' => 'col-sm-3',
                ],
            ],
        ]); ?>

        <?= $form->field($searchModel, 'pool_month')->widget(Select2::classname(), [
            'data' => $months,
            'options' => ['placeholder' => Yii::t('app', 'Pool Month')],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>
        <?= $form->field($searchModel, 'pool_year')->widget(Select2::classname(), [
            'data' => $years,
            'options' => ['placeholder' => Yii::t('app', 'Pool Year')],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

    <div class="table-responsive col-lg-12">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'rowOptions' => function ($data, $key, $index, $grid) use ($subPage) {
                return ['data-href' => '/'. Yii::$app->language . "$subPage/" . $data['slug']];
            },
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
