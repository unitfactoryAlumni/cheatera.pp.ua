<?php

use yii\helpers\Html;
use kartik\select2\Select2;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\controllers\ProjectsFilterSearch */
/* @var array $months */
/* @var array $years */

?>

<?php $form = ActiveForm::begin([
    'layout' => 'inline',
    'action' => [$action],
    'method' => 'get',
    'options' => [
        'class' => 'row',
        'data-pjax' => 1,
    ],
    'fieldConfig' => [
        'template' => "{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
        'options' => [
            'class' => 'col-md-3',
        ],
    ],
]); ?>

<?= $form->field($model, 'pool_month')->widget(Select2::classname(), [
    'data' => $months,
    'options' => ['placeholder' => Yii::t('app', 'Pool Month')],
    'pluginOptions' => [
        'allowClear' => true,
    ],
]); ?>

<?= $form->field($model, 'pool_year')->widget(Select2::classname(), [
    'data' => $years,
    'options' => ['placeholder' => Yii::t('app', 'Pool Year')],
    'pluginOptions' => [
        'allowClear' => true,
    ],
]); ?>

<div class="col-md-3 col-xs-12 form-group">
    <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
    <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
</div>

<?php ActiveForm::end(); ?>
