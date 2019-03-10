<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\controllers\CorrectSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="correction-log-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>


    <?= $form->field($model, 'dateStart')->label(Yii::t('app', 'dateStart'))->widget(DatePicker::className(),[
        'type' => DatePicker::TYPE_INPUT,
        'removeButton' => ['icon' => 'trash'],
        'pickerButton' => false,
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'autoclose' => true,
            'todayHighlight' => true,
        ]
    ]) ?>
    <?= $form->field($model, 'dateEnd')->label(Yii::t('app', 'dateEnd'))->widget(DatePicker::className(),[
        'type' => DatePicker::TYPE_INPUT,
        'removeButton' => ['icon' => 'trash'],
        'pickerButton' => false,
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'autoclose' => true,
            'todayHighlight' => true,
        ]
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
