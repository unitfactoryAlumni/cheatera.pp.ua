<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var ['model' => $model, 'key' => $key, 'index' => $index, 'widget' => $widget] */

?>

<div class="col-md-6 col-xs-6 cam-address-container">
    <h2><?= Html::encode($model->area_name) ?></h2>
    <img class="cam-address img-responsive" alt="<?= Html::encode($model->area_name) ?>" title="Click it!" src="<?= $model->cam_address ?>">
</div>
