<?php
use kartik\tabs\TabsX;
use app\helpers\ViewHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Show */
/* @var array $breadcrumbs */
/* @var array $parents */
/* @var int $course */
/* @var string $urlHelperForProjects */
/* @var string $action */
/* @var $searchModelTime app\controllers\TimeSearch */
/* @var $dataProviderTime yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = ['label' => $breadcrumbs['name'], 'url' => [$breadcrumbs['url']]];
$this->params['breadcrumbs'][] = strtok($this->title, " ");
\yii\web\YiiAsset::register($this);
?>

    <div class="row"> <div class="col-lg-12 mx-auto">
            <div class="progress my-shadow" style="margin: 0.75rem auto ;">
                <div class="progress-bar progress-bar-<?= ViewHelper::getLevelColorClass($model['level'])?> progress-bar-striped active" role="progressbar" style="width: <?= ViewHelper::getProgress($model['level'])?>%"><?= $model['level'] ?></div>
            </div>
        </div>
        <div class="col-lg-3 mx-auto">
            <div class="card" style="width: 100%;">
                <img class="card-img-top" src="<?= $model['image_url']?>" alt="">
                <div class="card-body">
                    <h5 class="card-title"><?= $model['displayname']?></h5>
                    <p class="card-text"><b>Login:</b> <?= $model['login']?></p>
                    <p class="card-text"><b>Level:</b> <?= $model['level']?></p>
                    <p class="card-text"><b>Phone:</b> <a style="color:#000;" href="tel:<?= $model['phone']?>"><?= $model['phone']?></a></p>
                    <p class="card-text"><b>Email:</b> <?= $model['email']?></p>
                    <p class="card-text"><b>Pool year:</b> <?= $model['pool_year']?></p>
                    <p class="card-text"><b>Pool month:</b> <?= $model['pool_month']?></p>
                    <p class="card-text"><b>Wallet:</b> <?= $model['wallet']?></p>
                    <p class="card-text"><b>Grade:</b> <?= $model['grade']?></p>
                    <p class="card-text"><b>Correction Point:</b> <?= $model['correction_point']?></p>
                    <p class="card-text"><b>Achievements:</b> <?= $model['howach']?></p>
                    <p class="card-text"><b>Host:</b> <?= $model['location']?></p>
                    <p class="card-text"><b>Last login:</b> <?= $model['lastloc']?></p>
                    <p class="card-text"><b>Hours at cluster:</b> <?= $model['hours']?></p>
                    <a href="//profile.intra.42.fr/users/<?= $model['login']?>" target="_blank" class="btn btn-warning bg-warning">Intra</a>
                    <a href="/<?= $switch ?>/<?= $model['login'] ?>" class="btn btn-success bg-success"><?= ucfirst(substr_replace($switch, "", -1)) ?> Profile</a>
                </div>
            </div>
            <div class="card" style="width: 100%;">
                <div class="card-body">
                    <h5 class="card-title">Навыки</h5>
                        <?php foreach ($skills as $skill) { ?>
                    <div class="progress" data-placement="left" data-toggle="tooltip" title="<?= $skill['skills_level'] ?>">
                        <div class="progress-bar mini progress-bar-<?= ViewHelper::getLevelColorClass($skill['skills_level'])?> progress-bar-striped active" role="progressbar" style="width:<?= ViewHelper::getProgress($skill['skills_level'])?>%"><p><?= $skill['skills_name'] ?></p></div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php

        $projects = $this->render('_projects', [
                'model' => $model,
                'switch' => $switch,
                'projects' => $projects,
                'urlHelperForProjects' => $urlHelperForProjects,
                'course' => $course,
                'parents' => $parents,
        ]);

        $times = $this->render('_time', [
                'model' => $model,
                'switch' => $switch,
                'projects' => $projects,
                'urlHelperForProjects' => $urlHelperForProjects,
                'course' => $course,
                'parents' => $parents,
                'searchModelTime' => $searchModelTime,
                'dataProviderTime' => $dataProviderTime,
                'action' => $action
        ]);

        $tmp = Yii::$app->session->get('username');

        $items = [
            [
                'label'   => '<i class="glyphicon glyphicon-list"></i> ' . Yii::t('app', 'Projects'),
                'content' => $projects,
                'active'  => true,
            ],
            [
                'label'   => '<i class="glyphicon glyphicon-time"></i> ' . Yii::t('app', 'Time in cluster'),
                'content' => $times,
            ],
            [
                'label'   => '<i class="glyphicon glyphicon-ok-circle"></i> ' . Yii::t('app', 'Corrections Log'),
                'content' => '',
            ],
            [
                'label'   => '<i class="glyphicon glyphicon-gift"></i> ' . Yii::t('app', 'Achievements'),
                'content' => '',
            ],
        ];
?>
        <div class="col-lg-9 mx-auto">
            <div class="card" style="width: 100%;">
                <div class="card-body">
                <?php
                echo TabsX::widget([
                    'items'=>$items,
                    'position'=>TabsX::POS_ABOVE,
                    'encodeLabels'=>false
                ]);
                ?>
                </div>
            </div>
        </div>
