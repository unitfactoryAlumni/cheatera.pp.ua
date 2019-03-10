<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use \app\helpers\ViewHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\controllers\ShowSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = strtok($this->title, " ");
?>
<div class="show-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>

    <p>
    </p>
    <style>
        .filters .form-control {
            max-height: 25px;
        }

        .table {
            white-space: nowrap;
            /*font-size: smaller;*/
        }

        .table > tbody > tr.warning > td{
            background-color:#ffa200!important;
        }

        .table > tbody > tr.success > td {
            background-color: #c8ffbe!important;
        }

    </style>
    <script>
        $(document).on({
            mouseenter: function (e) {
                //stuff to do on mouse enter
                var test = e.target.getAttribute("name");
                $("#ah-"+test).css("display", "block");
            },
            mouseleave: function (e) {
                //stuff to do on mouse leave
                var test = e.target.getAttribute("name");
                $("#ah-"+test).css("display", "none");
            }
        }, "#ah");
    </script>
    <?php $tmp = Yii::$app->session->get('username') ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'tableOptions' => [
            'class' => 'table table-striped table-bordered table-responsive'
        ],
        'rowOptions'=>function($data) use ($tmp) {
            if($data['login'] == $tmp){
                return ['class' => 'warning'];
            } else if ($data['lastloc'] == 0) {
                return ['class' => 'success'];
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'login',
            [
                'label' => '',
                'format' => 'raw',
                'attribute' => '',
                'contentOptions'=> ['style'=>'position: relative'],
                'value'  => function($data) use ($pageName) {
                    return ViewHelper::getLinkWithHover($data['login'], $pageName);
                },
            ],
            'displayname',
            'phone',
            [
                'attribute'=>'level',
                'value'=>'level',
            ],
            'correction_point',
            'pool_year',
            'pool_month',
            'location',
            [
                'label' => Yii::t('app', 'lastloc'),
                'attribute' => 'lastloc',
                'format' => 'raw',
                'value' => function($data) {
                    if ($data['lastloc'] == 0) {

                        return Yii::t('app', 'ONLINE');
                    }
                    return ViewHelper::getHumanTime($data['lastloc']);
                },
            ],
            'wallet',
            'howach',
            'hours',
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
