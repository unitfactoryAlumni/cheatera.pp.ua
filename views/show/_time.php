<?php

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

    function countTime($countTime, $summa = null) {
        if (!isset($summa)) {
            strtok($countTime, '.');
            $exp = explode(':', $countTime);
            $result = intval($exp[0]);
            $result = $result . '.' . strtok((($exp[1]/60) * 100), '.');

            return ($result);
        }
        strtok($countTime, '.');
        $summa = floatval("$summa");
        $exp = explode(':', $countTime);
        $result = intval($exp[0]);
        $result = $result . '.' . strtok((($exp[1]/60) * 100), '.');
        return (floatval($result) + floatval($summa));
    }

    $labels = [];
    $data = [];
    $shit = [];
    $it = 0;
    $tempDate = null;
    $count = count($dataProviderTime->models);
    foreach ($dataProviderTime->models as $model) {
        $it++;
        if ($it > 1 && $count > 0) {
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
            $shit[$model->date] = countTime($model->how, $shit[$model->date]);
        } else {
            $shit[$model->date] = countTime($model->how);
        }
        echo "<pre>";
        var_export([$model->date => $model->how, $shit[$model->date]]);
        echo "</pre>";
        $tempDate = date('Y-m-d',strtotime($model->date));
    }
    ;
    foreach ($shit as $key => $value) {
        $labels = array_merge([$key], $labels);
        $data = array_merge([$value], $data);
    }
    $fix = 0;
    foreach ($data as &$key) {
        if ($fix > 0) {
            $key = $fix;
            $fix = 0;
        }
        if ($key > 24) {
            $fix = $key - 24;
            $key -= 24;
        }
    }

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
