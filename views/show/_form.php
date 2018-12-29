<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Show */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="show-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'correction_point')->textInput() ?>

    <?= $form->field($model, 'displayname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'xid')->textInput() ?>

    <?= $form->field($model, 'image_url')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'location')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'login')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pool_month')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pool_year')->textInput() ?>

    <?= $form->field($model, 'staff')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'wallet')->textInput() ?>

    <?= $form->field($model, 'howach')->textInput() ?>

    <?= $form->field($model, 'kick')->textInput() ?>

    <?= $form->field($model, 'lastloc')->textInput() ?>

    <?= $form->field($model, 'needupd')->textInput() ?>

    <?= $form->field($model, 'hours')->textInput() ?>

    <?= $form->field($model, 'lasthours')->textInput() ?>

    <?= $form->field($model, 'visible')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
