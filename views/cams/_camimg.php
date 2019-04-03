<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var ['model' => $model, 'key' => $key, 'index' => $index, 'widget' => $widget] */

?>

<div class="col-md-4 col-xs-6">
    <h2><?= Html::encode($model->area_name) ?></h2>
    <img class="cam_address img-responsive" src="<?= $model->cam_address ?>">
</div>
