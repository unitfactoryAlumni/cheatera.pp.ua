<?php

use app\helpers\ViewHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Show */
/* @var array $breadcrumbs */
/* @var array $projects */
/* @var string $urlHelperForProjects */
/* @var string $course */

?>

                    <h5 class="card-title"><?= Yii::t('app', 'Projects') ?></h5>
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

                            <?php if (isset($projects)) { foreach ($projects as $item) {
                                if ($item->name === 'Rushes') { continue; } ?>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar progress-bar-<?= ViewHelper::getProgressProjectColor($item->final_mark, $course, $item->status)?>" role="progressbar" style="width:<?= ViewHelper::getProgressProject($item->final_mark, $course)?>%">
                                            <p><a style="color:white; " href="<?= '/' . Yii::$app->language . $urlHelperForProjects ?><?= $item->slug ?>"><?= $item->name ?></a></p>
                                        </div>
                                    </div>
                                </td>
                                <td><?= $item->final_mark ?></td>
                                <td><?= $item->occurrence ?></td>
                                <td><?= str_replace('_', ' ', $item->status) ?></td>
                            </tr>
                            <?php } } ?>


                            <?php if (isset($parents)) { foreach ($parents as $parent => $value) { ?>
                                <tr><td colspan="4"><h5 class="card-title"><?= $parent?></h5></td></tr>
                            <?php if (isset($value)) { foreach ($value as $item) { ?>
                                <tr>
                                    <td>
                                        <div class="progress my-shadow">
                                            <div class="progress-bar progress-bar-<?= ViewHelper::getProgressProjectColor($item->final_mark, $course, $item->status)?>" role="progressbar" style="width:<?= ViewHelper::getProgressProject($item->final_mark, $course)?>%">
                                                <p><a style="color:white; " href="<?= '/' . Yii::$app->language . $urlHelperForProjects ?><?= $item->slug ?>"><?= $item->name ?></a></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?= $item->final_mark ?></td>
                                    <td><?= $item->occurrence ?></td>
                                    <td><?= str_replace('_', ' ', $item->status) ?></td>
                                </tr>
                            <?php } } } } ?>

                            </tbody>
                        </table>
                    </div>
                <hr>
                <!-- @TODO need create user time in clusters method -->
                <!--            <div class="card" style="width: 100%;">-->
                <!--                <div class="card-body">-->
<!--                    <h5 class="card-title">Time at cluster</h5>-->
<!--                    <canvas id="timer" width="770" height="385" style="display: block; width: 770px; height: 385px;"></canvas>-->
<!--                </div>-->
<!--            </div>-->

