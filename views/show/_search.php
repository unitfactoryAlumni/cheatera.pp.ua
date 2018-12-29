<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\controllers\ShowSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="show-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'correction_point') ?>

    <?= $form->field($model, 'displayname') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'first_name') ?>

    <?php // echo $form->field($model, 'xid') ?>

    <?php // echo $form->field($model, 'image_url') ?>

    <?php // echo $form->field($model, 'last_name') ?>

    <?php // echo $form->field($model, 'location') ?>

    <?php // echo $form->field($model, 'login') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'pool_month') ?>

    <?php // echo $form->field($model, 'pool_year') ?>

    <?php // echo $form->field($model, 'staff') ?>

    <?php // echo $form->field($model, 'url') ?>

    <?php // echo $form->field($model, 'wallet') ?>

    <?php // echo $form->field($model, 'howach') ?>

    <?php // echo $form->field($model, 'kick') ?>

    <?php // echo $form->field($model, 'lastloc') ?>

    <?php // echo $form->field($model, 'needupd') ?>

    <?php // echo $form->field($model, 'hours') ?>

    <?php // echo $form->field($model, 'lasthours') ?>

    <?php // echo $form->field($model, 'visible') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
