<?php

use app\helpers\LogTimeHelper;
use dosamigos\chartjs\ChartJs;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModelTime app\controllers\LocationsSearch */
/* @var $dataProviderTime yii\data\ActiveDataProvider */

?>
<div class="time-in-cluster-index">

    <h3><?= Yii::t('app', 'Time in cluster') ?></h3>
    <?php Pjax::begin(['timeout' => 10000 ]); ?>
    <?php echo $this->render('_search_time', ['model' => $searchModelTime, 'action' => $action]); ?>
    <?php

    $labels = [];
    $data = [];
    $shit = [];
    $tempDate = null;
    $count = count($dataProviderTime->models);
    $amount = 0;
    $get = Yii::$app->request->get();
    $tempDate = '';
    if (isset($get['LocationsSearch']['dateEnd'])) {
        $tempDate = $get['LocationsSearch']['dateEnd'];
    } else {
        $tempDate = date('Y-m-d', time());
    }
    $first = '';
    foreach ($dataProviderTime->models as $model) {
        $first = $model->date;
        break;
    }
    while ($tempDate != $first) {
        $tempDate = date('Y-m-d', strtotime($tempDate . "-1 days"));
        $shit[$tempDate] = '00.00';
        break ;
    }
    foreach ($dataProviderTime->models as $model) {
        if ($count > 0) {
            if ($tempDate != $model->date) {
                while ($count > 0 && $tempDate != $model->date) {
                    $tempDate = date('Y-m-d', strtotime($tempDate . "-1 days"));
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
        $amount += $value;
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

    <h4><?= Yii::t('app', 'Amount') . ': ' . $amount ?></h4>
    <?php Pjax::end(); ?>

</div>
