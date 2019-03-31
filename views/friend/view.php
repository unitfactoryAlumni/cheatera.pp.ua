<?php

use app\helpers\ViewHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\controllers\FriendSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
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

        'itemView' => function ($model , $key , $index , $widget) use ($tab) {
            Yii::$app->user->setReturnUrl(['friend/index']);
            $loc = ($model->lastloc != 0) ? ViewHelper::getHumanTime($model->lastloc) : Yii::t('app', 'ONLINE');
            $link = $tab !== 'profile' ? Html::a('', '', ['class' => 'popupModal btn btn-danger btn-sm pull-right glyphicon glyphicon-trash', 'data-toggle' => 'modal', 'data-target' => '#modal', 'data-id' => $model->login]) :'';
            if ($tab === 'income') {
                $link = Html::a('', '/' . Yii::$app->language . '/friends/create/' . $model['login'] . '/' . $model['course'], ['class' => 'btn btn-success btn-sm pull-right glyphicon glyphicon-plus']);
            }
            return '<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6">
            <div class="thumbnail friend-card" '. ViewHelper::friendOnline($model) . '>
                <img src="' . $model->image_url . '" class="img-card">
                <div class="caption">
                    <h4 class="">' . $model->login . ' ' . $model->level .' lvl</h4>
                    <p>' . $loc . ' ' . $model->location . '</p>
                    <p>' . $model->displayname . '</p>
                    <p>' . $model->phone . '</p>
                    <p>' . $model->pool_month  . ' ' . $model->pool_year . '</p>
                    '. $link . '
                    <a href="' . Url::to('/' . Yii::$app->language . "/$model->course/$model->login") . '" class="btn btn-success btn-sm" data-pjax=0>' . Yii::t('app', 'Profile') . '</a>
                </div>
            </div>
        </div>
         ';
        }
    ] ); ?>
    <?php
    Pjax::end();