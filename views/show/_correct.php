<?php

use dosamigos\chartjs\ChartJs;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModelCorrections app\controllers\CorrectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="correct-index">

    <h3><?= Yii::t('app', 'Correction Logs') ?></h3>


    <?php Pjax::begin(['timeout' => 10000 ]); ?>
    <?= $this->render('_correct_search', ['model' => $searchModelCorrections, 'action' => $action]);

    $labels = [];
    $data = [];
    //strtok($model->date, ' ')
    foreach ($dataProviderCorrections->models as $model) {
        $labels = array_merge([$model->date], $labels);
        $data = array_merge([$model->corrections], $data);
    }
    echo ChartJs::widget([
        'type' => 'line',

        'data' => [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => Yii::t('app', 'Correction Logs'),
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
