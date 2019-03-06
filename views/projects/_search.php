<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\controllers\ProjectsAllSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="projects-all-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

<!--    --><?//= //$form->field($model, 'id') ?>
<!---->
<!--    --><?//= //$form->field($model, 'xlogin') ?>
<!---->
<!--    --><?//= //$form->field($model, 'current_team_id') ?>
<!---->
<!--    --><?//= //$form->field($model, 'cursus_ids') ?>
<!---->
<!--    --><?//= //$form->field($model, 'final_mark') ?>
<!---->
<!--    --><?php //// echo $form->field($model, 'puid') ?>
<!---->
<!--    --><?php //// echo $form->field($model, 'occurrence') ?>
<!---->
<!--    --><?php //// echo $form->field($model, 'project_id') ?>
<!---->
<!--    --><?php //// echo $form->field($model, 'name') ?>
<!---->
<!--    --><?php //// echo $form->field($model, 'parent_id') ?>
<!---->
<!--    --><?php //// echo $form->field($model, 'slug') ?>
<!---->
<!--    --><?php //// echo $form->field($model, 'status') ?>
<!---->
<!--    --><?php //// echo $form->field($model, 'validated') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
