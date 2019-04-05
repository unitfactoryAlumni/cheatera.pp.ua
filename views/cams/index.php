<?php

use yii\widgets\ListView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = ucfirst(substr(Yii::$app->request->url, 1));

$this->registerJs('
refreshTimeout = 4500;
images = ".cam-address";

function refreshImages() {
    $.each($(images), function(key, img) {
        img.src = img.src.replace(/\btime=[^&]*/, "time=" + (new Date()).getTime());
    });
    setTimeout(refreshImages, refreshTimeout);
}

$.each($(images), function(key, img) {
    img.src += "?time=" + (new Date()).getTime();
});
setTimeout(refreshImages, refreshTimeout);

$(images).click(function() {
    console.log( $(this).is() );
    $("#modal-view-full-image").modal("show")
        .find("#modalHeader")
        .empty()
        .append( $(this).parent().find("h2").text() );

    $("#modal-view-full-image #modalContent").empty();

    $(this)
        .clone()
        .removeClass(images.slice(1))
        .removeAttr("title")
        .appendTo("#modal-view-full-image #modalContent");
});
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

<?php
    Modal::begin([
        'header' => '<h2 id="modalHeader"></h2>',
        'id'     => 'modal-view-full-image',
        'size'   => Modal::SIZE_LARGE,
    ]);
        echo '<div id="modalContent"></div>';
    Modal::end();
?>
