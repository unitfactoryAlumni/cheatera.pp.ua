<?php

/* @var $this yii\web\View */

use fedemotta\datatables\DataTables;
use yii\grid\GridView;

?>
<div class="site-index">

    <div class="body-content">

        <div class="row">
            <div class="col-lg-12">
                <h2>show/index</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>
                <?php
                $searchModel = new \app\models\ShowSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                ?>
                <?= DataTables::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,


                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'login',
                        'pool_month',
                        'pool_year',
                    ],
                    'clientOptions' => [
                        "lengthMenu"=> [[10,25, 100, 250,-1], [10,Yii::t('app',"All")]],
                        "info"=>true,
                        "responsive"=>true,
                    ],
                ]);?>

            </div>
        </div>

    </div>
</div>
