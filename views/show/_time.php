<?php

use yii\widgets\Pjax;
use dosamigos\chartjs\ChartJs;
use app\helpers\LogTimeHelper;

/* @var $this yii\web\View */
/* @var $searchModelTime app\controllers\LocationsSearch */
/* @var $dataProviderTime yii\data\ActiveDataProvider */

?>
<div class="time-in-cluster-index">

    <h3><?= Yii::t('app', 'Time in cluster') ?></h3>
    <?php Pjax::begin(['timeout' => 10000]); ?>
    <?= $this->render('_search_time', ['model' => $searchModelTime, 'action' => $action]); ?>
    <?php
    $get = Yii::$app->request->get();
    [$amount, $labels, $data] = LogTimeHelper::getChartJSInfo($dataProviderTime->models, $get);

    echo ChartJs::widget([
        'type' => 'line',

        'data' => [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => Yii::t('app', 'Time in cluster'),
                    'backgroundColor' => "rgba(255,99,132,0.2)",
                    'borderColor' => "rgba(255,99,132,1)",
                    'pointBackgroundColor' => "rgba(255,99,132,1)",
                    'pointBorderColor' => "#fff",
                    'pointHoverBackgroundColor' => "#fff",
                    'pointHoverBorderColor' => "rgba(255,99,132,1)",
                    'data' => $data,
                    'lineTension' => '0.1',
                ],
            ],
        ],
        'options' => [
            'height' => '100%',
            'responsive' => true,
            'tooltips' => [
                'mode' => 'index',
                'intersect' => false,
            ],
            'hover' => [
                'mode' => 'nearest',
                'intersect' => true,
            ],
        ],
    ]);
    ?>

    <h4><?= Yii::t('app', 'Amount') . ': ' . $amount ?></h4>
    <?php Pjax::end(); ?>

</div>
