<?php

use app\helpers\LogTimeHelper;
use yii\helpers\Html;
use dosamigos\chartjs\ChartJs;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModelTime app\controllers\LocationsSearch */
/* @var $dataProviderTime yii\data\ActiveDataProvider */

?>
<div class="time-in-cluster-index">

    <h3><?= Yii::t('app', 'Time in cluster') ?></h3>
    <?php Pjax::begin(); ?>
    <?php echo $this->render('_search_time', ['model' => $searchModelTime, 'action' => $action]); ?>
    <?php

    $labels = [];
    $data = [];
    $shit = [];
    $tempDate = null;
    $count = count($dataProviderTime->models);
    $tempDate = date('Y-m-d', time());
    foreach ($dataProviderTime->models as $model) {
        if ($count > 0) {
            if ($tempDate != $model->date) {
                while ($count > 0 && $tempDate != $model->date) {
                    $tempDate = date('Y-m-d',strtotime($tempDate . "-1 days"));
                    $shit[$tempDate] = '00.00';
                }
            } else {
                $tempDate = date('Y-m-d',strtotime($model->date));
                $count--;
            }
        }
        if (isset($shit[$model->date]) && $count > 0) {
            $shit[$model->date] = LogTimeHelper::countTime($model->how, $shit[$model->date]);
        } else {
            $shit[$model->date] = LogTimeHelper::countTime($model->how);
        }
        $tempDate = date('Y-m-d',strtotime($model->date));
    }
    ;
    foreach ($shit as $key => $value) {
        $labels = array_merge([$key], $labels);
        $data = array_merge([$value], $data);
    }
    LogTimeHelper::fix24($data);

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
                ]
            ]
        ],
        'options'=> [
            'height' => '100%',
            'responsive'=> true,
            'tooltips'=> [
                'mode'=> 'index',
                'intersect'=> false,
            ],
            'hover'=> [
                'mode'=> 'nearest',
                'intersect'=> true
            ],
        ]
    ]);?>

    <?php Pjax::end(); ?>

</div>
