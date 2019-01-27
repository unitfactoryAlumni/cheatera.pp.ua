<?php

use app\helpers\SkillsHelper;
use app\helpers\ViewHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Show */
/* @var array $breadcrumbs */

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
                    <p class="card-text"><b>Achivements:</b> <?= $model['howach']?></p>
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
        <div class="col-lg-9 mx-auto">
            <div class="card" style="width: 100%;">
                <div class="card-body">
                    <h5 class="card-title">Projects (finished)</h5>
                    <div style="max-width: 100%; overflow: auto;">
                        <table class="table ">
                            <thead>
                            <tr>
                                <th scope="col">name</th>
                                <th scope="col">final mark</th>
                                <th scope="col">Retry</th>
                                <th scope="col">status</th>
                            </tr>
                            </thead>
                            <tbody id="alldata">
                    <?php if (isset($projects)) { foreach ($projects as $item) { ?>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-success" role="progressbar" style="width:<?= ViewHelper::getProgressProject($item->final_mark)?>%">
                                            <span style="text-align:left;"><a style="color:black; " href="<?= $urlHelperForProjects ?><?= $item->slug ?>"><?= $item->name ?></a></span>
                                        </div>
                                    </div>
                                </td>
                                <td><?= $item->final_mark ?></td>
                                <td><?= $item->occurrence ?></td>
                                <td><?= $item->status ?></td>
                            </tr>
                    <?php } } ?>
                    <tr><td colspan="4"><h5 class="card-title">Projects (in_progress)</h5></td></tr>
                        <?php if (isset($projects['in_progress'])) { foreach ($projects['in_progress'] as $item) { ?>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" style="width:<?= ViewHelper::getProgressProject($item->final_mark)?>%">
                                            <span style="text-align:left;"><a style="color:black; " href="<?= $urlHelperForProjects ?><?= $item->slug ?>"><?= $item->name ?></a></span>
                                        </div>
                                    </div>
                                </td>
                                <td><?= $item->final_mark ?></td>
                                <td><?= $item->occurrence ?></td>
                                <td><?= $item->status ?></td>
                            </tr>
                        <?php } }?>





                            </tbody>
                        </table>
                    </div>
                </div>
                <hr>
                <!-- @TODO need create user time in clusters method -->
                <!--            <div class="card" style="width: 100%;">-->
                <!--                <div class="card-body">-->
<!--                    <h5 class="card-title">Time at cluster</h5>-->
<!--                    <canvas id="timer" width="770" height="385" style="display: block; width: 770px; height: 385px;"></canvas>-->
<!--                </div>-->
<!--            </div>-->
            </div>
            </div>
        </div>
