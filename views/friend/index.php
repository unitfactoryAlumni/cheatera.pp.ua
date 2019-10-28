<?php

use yii\helpers\Html;
use kartik\tabs\TabsX;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\controllers\FriendSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModelIncome app\controllers\FriendSearch */
/* @var $dataProviderIncome yii\data\ActiveDataProvider */
/* @var $searchModelOutgoing app\controllers\FriendSearch */
/* @var $dataProviderOutgoing yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Friends');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="friend-index row">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php

    $friends =
        $this->render('view', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider, 'tab' => 'friends']);
    $income =
        $this->render('view', ['searchModel' => $searchModelIncome,
            'dataProvider' => $dataProviderIncome,
            'tab' => 'income']);
    $outgoing =
        $this->render('view', ['searchModel' => $searchModelOutgoing,
            'dataProvider' => $dataProviderOutgoing,
            'tab' => 'outgoing']);

    $tmp = Yii::$app->session->get('username');

    $items = [
        [
            'label' => '<i class="glyphicon glyphicon-user"></i> ' . Yii::t('app', 'Friends'),
            'content' => $friends,
            'active' => true,
        ],
        [
            'label' => '<i class="glyphicon glyphicon-import"></i> ' . Yii::t('app', 'Income'),
            'content' => $income,
        ],
        [
            'label' => '<i class="glyphicon glyphicon-export"></i> ' . Yii::t('app', 'Outgoing'),
            'content' => $outgoing,
        ],
    ];

    echo TabsX::widget([
        'items' => $items,
        'position' => TabsX::POS_ABOVE,
        'encodeLabels' => false,
    ]);

    Modal::begin([
        'header' => '<h2 class="modal-title">' . Yii::t('app', 'Are you sure about this?') . '</h2>',
        'id' => 'modal-delete',
        'footer' => Html::a(Yii::t('app', 'Delete'), '', ['class' => 'btn btn-danger', 'data-method' => 'post',]),
    ]);
    Modal::end();
    $this->registerJs("$(function() {
   $('.popupModal').click(function(e) {
        url = '/friends/delete/';
        e.preventDefault();
        let id = $(this).closest('a')[0].dataset.id;
        $('#modal-delete').modal('show').find('.modal-body');
        $('.modal-footer a.btn.btn-danger')[0].setAttribute(\"href\", url + id);
   });
});");
    ?>
</div>
