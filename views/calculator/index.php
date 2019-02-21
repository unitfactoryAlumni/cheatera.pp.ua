<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>

<div class="calculator-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin([
        'id' => 'calculator-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'lvlstart')->textInput(['autofocus' => true]) ?>
        
        <?= $form->field($model, 'finalmark')->dropDownList(
            [],
            ['prompt'=>'Select tier'])
        ?>
        
        <?= $form->field($model, 'finalmark')->textInput() ?>

        <?= Html::submitButton('Calculate') ?>

        <h2>Result:</h2>

    <?php ActiveForm::end(); ?>

    <div class="col-lg-offset-1" style="color:#999;">
        Расчеты любезно предоставлены <a href="https://profile.intra.42.fr/users/vpaladii">vpaladii</a> Погрешности от <code>0.01</code> до <code>0.2</code> (magic Intra, magic!)
    </div>
</div>
