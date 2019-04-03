<?php

use yii\widgets\Pjax;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = ucfirst(substr(Yii::$app->request->url, 1));

$this->registerJs('

refreshTimeout = 4500;

function refreshImages() {
    $.each($(".cam_address"), function(key, img) {
        img.src = img.src.replace(/\btime=[^&]*/, "time=" + new Date().getTime());
    });
    setTimeout(refreshImages, refreshTimeout);
}

$.each($(".cam_address"), function(key, img) {
    img.src += "?time=" + (new Date()).getTime();
});
setTimeout(refreshImages, refreshTimeout);

');

?>

<div class="row">
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'summary' => false,
        'itemView' => function ($model, $key, $index, $widget) {
            return $this->render('_camimg', ['model' => $model, 'key' => $key, 'index' => $index, 'widget' => $widget]);
        },
    ]); ?>
</div>
