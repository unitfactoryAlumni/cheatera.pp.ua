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
        if ($countTime = 0) {
            $countTime = '0:0:0';
        }
        if (!isset($summa)) {
            strtok($countTime, '.');
            $exp = explode(':', $countTime);
            $result = intval($exp[0]);
            $result = $result . '.' . strtok((($exp[1]/60) * 100), '.');

            return ($result);
        }
        strtok($countTime, '.');
        strtok($summa, '.');
        $exp = explode(':', $countTime);
        $result = intval($exp[0]);
        $result = $result . '.' . strtok((($exp[1]/60) * 100), '.');
        $exp2 = explode(':', $summa);
        $result += intval($exp2[0]);
        $result = $result . '.' . strtok((($exp2[1]/60) * 100), '.');
        return ($result);
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
                    $shit[$tempDate] = 0;
                }
            } else {
                $tempDate = date('Y-m-d',strtotime($model->date));
                $count--;
            }
        }
        if (isset($shit[$model->date]) && $count > 0) {
            $shit[$model->date] = countTime($shit[$model->date], $model->how);
        } else {
            $shit[$model->date] = $model->how != 0 ? countTime($model->how) : 0;
        }
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
