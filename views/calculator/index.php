<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\Calculator */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

use app\assets\AppAsset;
AppAsset::register($this);

$cookies = Yii::$app->request->cookies;
$level = $cookies->getValue('level');
$this->registerJsFile('js/calculator.js', ['depends' => [\yii\web\JqueryAsset::className()], 'position' => \yii\web\View::POS_END]);
$model->lvlstart = $level;
$model->finalmark = '125';

?>

<script>console.log("<?= var_dump($cookies->get('level')) ?>")</script>

<div class="calculator-index">
    <h1><?= Html::encode($this->title) ?></h1><br />

    <?php $form = ActiveForm::begin([
        'id' => 'calculator-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'lvlstart')
        ->textInput(['autofocus' => true])
        ->input('text', ['placeholder' => Yii::t('app', "Enter level")])
    ?>
    
    <?= $form->field($model, 'tier')->dropDownList(
        [
            '1' => 'T0',
            '2' => 'T1',
            '3' => 'T2',
            '4' => 'T3',
            '5' => 'T4',
            '6' => 'T5',
            '7' => 'T6',
            '8' => 'T7',
        ],
        ['prompt' => Yii::t('app', 'Select tier')])
    ?>
    
    <?= $form->field($model, 'finalmark')
        ->textInput()->input('text', ['placeholder' => Yii::t('app', "Enter mark")])
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
        Html::a('vpaladii', Url::toRoute('students/vpaladii', true)) ) ?>
    </div>
</div>
