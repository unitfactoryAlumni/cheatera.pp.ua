<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\controllers\ProjectsFilterSearch */
/* @var $form yii\widgets\ActiveForm */
/* @var array $months */
/* @var array $years */
?>

<div class="projects-all-search">
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

    <?php echo $form->field($model, 'pool_month')->widget(Select2::classname(), [
        'data' => $months,
        'options' => ['placeholder' => Yii::t('app', 'Pool Month')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>
    <?php echo $form->field($model, 'pool_year')->widget(Select2::classname(), [
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
