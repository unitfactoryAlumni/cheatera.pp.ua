<?php

use app\helpers\ViewHelper;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\User;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\controllers\FriendSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Friends');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="friend-index row">

    <h1><?= Html::encode($this->title) ?></h1>
<style>
    .friend-card {
        height: 530px;
    }
</style>
    <?php Pjax::begin(); ?>
    <?=
    ListView::widget ( [
        'dataProvider' => $dataProvider,
        'summary' => false,

        'itemView' => function ($model , $key , $index , $widget) {
            Yii::$app->user->setReturnUrl(['friend/index']);
            $loc = ($model->lastloc !== 0) ? ViewHelper::getHumanTime($model->lastloc) : Yii::t('app', 'ONLINE');
            return '<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6">
            <div class="thumbnail friend-card" '. ViewHelper::friendOnline($model) . '>
                <img src="' . $model->image_url . '" class="img-card">
                <div class="caption">
                    <h4 class="">' . $model->login . '</h4>
                    <p>' . $loc . ' ' . $model->location . '</p>
                    <p>' . $model->displayname . '</p>
                    <p>' . $model->phone . '</p>
                    <p>' . $model->pool_month  . ' ' . $model->pool_year . '</p>
                    '. Html::a('', '', ['class' => 'popupModal btn btn-danger btn-sm pull-right glyphicon glyphicon-trash', 'data-toggle' => 'modal', 'data-target' => '#modal', 'data-id' => $model->login]) .'
                    <a href="' . Url::to('/' . Yii::$app->language . "/$model->course/$model->login") . '" class="btn btn-success btn-sm" data-pjax=0>' . Yii::t('app', 'Profile') . '</a>
                </div>
            </div>
        </div>
         ';
        }
    ] ); ?>
    <?php
    Pjax::end();
    Modal::begin([
        'header' => '<h2 class="modal-title">' . Yii::t('app','Are you sure about this?') . '</h2>',
        'id'     => 'modal-delete',
        'footer' => Html::a(Yii::t('app', 'Delete'), '', ['class' => 'btn btn-danger', 'data-method' => 'post', ]),
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
