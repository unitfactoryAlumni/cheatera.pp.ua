<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\controllers\ProjectsFilterSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="projects-all-search">

    <?php $form = ActiveForm::begin([
        'action' => [$action],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?php echo $form->field($model, 'pool_month')->label(Yii::t('app', 'Pool Month')) ?>
    <?php echo $form->field($model, 'pool_year')->label(Yii::t('app', 'Pool Year')) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
