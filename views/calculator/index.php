<?php

/* @var $this yii\web\View */
/* @var $model app\models\Calculator */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;

$this->params['breadcrumbs'][] = ['label' => $breadcrumbs['name']];

?>

<div id="calculator-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(['id' => 'calculator']); ?>
        <?php $form = ActiveForm::begin([
            'action' => ['calculator/form-submission'],
            'options' => ['data' => ['pjax' => true]],
            'id' => 'calculator-form',
            'layout' => 'horizontal',
            'fieldConfig' => [
                'template' => "<div class='col-lg-2'>{label}</div> <div class='col-lg-3'>{input}</div> <div class='col-lg-7'>{error}</div>",
                'labelOptions' => ['class' => 'control-label'],
            ],
        ]); ?>

            <br><div>
                <?= Html::submitButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-lg btn-primary', 'name' => 'resetToDefault']) ?>
            </div><br>
            <?= $form->field($model, 'lvlstart')
                ->label(Yii::t('app', 'Enter level'))
                ->input('text', ['placeholder' => Yii::t('app', 'Enter number')])
                ->textInput(2)
            ?>

            <?= $form->field($model, 'finalmark')
                ->label(Yii::t('app', 'Enter mark'))
                ->input('text', ['placeholder' => Yii::t('app', 'Enter number')])
                ->textInput()
            ?>

            <div>
                <?php
                    foreach ($model->getTier() as $k => $v) {
                        echo Html::submitButton($v, ['class' => 'btn btn-primary tier-key', 'name' => $k, 'style' => 'margin: 3px']);
                    }
                ?>
                <h2><?= Yii::t('app', 'Result') . ':' ?> <span id='fm'><?= $model->result ? $model->result : '' ?></span></h2>
            </div>

        <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>

    <div class="bottom-text">
        <?= Yii::t( 'app', 'Calculations kindly presented by {0}, errors in calculations may be from <code>0.01</code> till <code>0.2</code> (magic Intra, magic!)',
            Html::a('vpaladii', Url::toRoute('students/vpaladii', true)) )
        ?>
    </div>
</div>
