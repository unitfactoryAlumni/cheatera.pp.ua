<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Show */
/* @var array $breadcrumbs */

$this->params['breadcrumbs'][] = ['label' => $breadcrumbs['name'], 'url' => [$breadcrumbs['url']]];
$this->params['breadcrumbs'][] = strtok($this->title, " ");
\yii\web\YiiAsset::register($this);
?>
<div class="show-view">

    <h1><?= Html::encode(strtok($this->title, " ")) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'login',
            'level',
            'displayname',
            'phone',
            'email:email',
            'correction_point',
            'first_name',
            'last_name',
            'image_url:ntext',
            'location',
            'pool_month',
            'pool_year',
            'staff',
            'url:ntext',
            'wallet',
            'howach',
            'kick',
            'lastloc',
            'needupd',
            'hours',
            'lasthours',
            'visible',
        ],
    ]) ?>

</div>
