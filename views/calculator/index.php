<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\Calculator */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use app\assets\AppAsset;

AppAsset::register($this);
$this->registerJsFile('js/calculator.js', ['depends' => [\yii\web\JqueryAsset::className()], 'position' => \yii\web\View::POS_END]);

?>

<div class="calculator-index">
    <h1><?= Html::encode($this->title) ?></h1><br />

    <?php $form = ActiveForm::begin([
        'id' => 'calculator-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "<div class='col-lg-2'>{label}</div> <div class='col-lg-3'>{input}</div> <div class='col-lg-7'>{error}</div>",
            'labelOptions' => ['class' => 'control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'lvlstart')
        ->label('Enter level')
        ->input('text', ['placeholder' => Yii::t('app', 'Enter number')])
        ->textInput(['autofocus' => true])
    ?>
    
    <?= $form->field($model, 'tier')
        ->label('Select tier')
        ->dropDownList($model->getTier(), ['prompt' => Yii::t('app', 'Select tier')])
    ?>
    
    <?= $form->field($model, 'finalmark')
        ->label('Enter mark')
        ->input('text', ['placeholder' => Yii::t('app', 'Enter number')])
        ->textInput()
    ?>

    <div class="form-group">
        <div class="col-lg-12">
            <?= Html::submitButton(Yii::t('app', 'Calculate'), ['class' => 'btn btn-primary', 'name' => 'calculateButton']) ?>
            <br /><h2>Result: <span id='fm'><?= $model->result ? $model->result : '' ?></span></h2>
            <?= Html::submitButton(Yii::t('app', 'To Input'), ['class' => 'btn btn-primary', 'name' => 'toInputButton']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

    <div style="color:#999">
        <?= Yii::t( 'app', 'Calculation kindly presented by {0}, errors in calculations may be from <code>0.01</code> till <code>0.2</code> (magic Intra, magic!)',
            Html::a('vpaladii', Url::toRoute('students/vpaladii', true)) )
        ?>
    </div>
</div>
