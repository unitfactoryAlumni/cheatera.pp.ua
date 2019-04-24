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
/* @var $searchModelCorrections app\controllers\CorrectionsSearch */
/* @var $dataProviderCorrections yii\data\ActiveDataProvider */
/* @var $searchModelFriend app\controllers\FriendSearch */
/* @var $dataProviderFriend yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = ['label' => $breadcrumbs['name'], 'url' => [$breadcrumbs['url']]];
$this->params['breadcrumbs'][] = strtok($this->title, " ");
\yii\web\YiiAsset::register($this);
$explode = explode('/', $urlHelperForProjects);
$explode = $explode[1];
Yii::$app->user->setReturnUrl(['/' . $explode . '/'. $model['login']]);

?>

    <div class="row"> <div class="col-lg-12 mx-auto">
            <div class="progress my-shadow progress-bar-main">
                <div class="progress-bar progress-bar-<?= ViewHelper::getLevelColorClass($model['level'])?> progress-bar-striped active" role="progressbar" style="width: <?= ViewHelper::getProgress($model['level'])?>%"><?= $model['level'] ?></div>
            </div>
        </div>
        <div class="col-lg-3 mx-auto">
            <div class="card">
                <img class="card-img-top" src="<?= $model['image_url']?>" alt="">
                <div class="card-body" <?= ViewHelper::friendOnline($model) ?>>
                    <h5 class="card-title"><?= $model['displayname']?></h5>
                    <p class="card-text"><b><?= Yii::t('app', 'Login:') ?></b> <?= $model['login']?></p>
                    <p class="card-text"><b><?= Yii::t('app', 'Level:') ?></b> <?= $model['level']?></p>
                    <p class="card-text"><b><?= Yii::t('app', 'Phone:') ?></b> <a class="phone" href="tel:<?= $model['phone']?>"><?= $model['phone']?></a></p>
                    <p class="card-text"><b><?= Yii::t('app', 'Email:') ?></b> <?= $model['email']?></p>
                    <p class="card-text"><b><?= Yii::t('app', 'Pool Year') ?>:</b> <?= $model['pool_year']?></p>
                    <p class="card-text"><b><?= Yii::t('app', 'Pool Month') ?>:</b> <?= $model['pool_month']?></p>
                    <p class="card-text"><b><?= Yii::t('app', 'Wallet') ?>:</b> <?= $model['wallet']?></p>
                    <p class="card-text"><b><?= Yii::t('app', 'Grade') ?>:</b> <?= $model['grade']?></p>
                    <p class="card-text"><b><?= Yii::t('app', 'Correction Point') ?>:</b> <?= $model['correction_point']?></p>
                    <p class="card-text"><b><?= Yii::t('app', 'Achievements:') ?></b> <?= $model['howach']?></p>
                    <p class="card-text"><b><?= Yii::t('app', 'Host') ?>:</b> <?= $model['location']?></p>
                    <p class="card-text"><b><?= Yii::t('app', 'Last login') ?>:</b> <?php if ($model['lastloc'] == 0) { echo Yii::t('app', 'ONLINE'); } else { echo ViewHelper::getHumanTime($model['lastloc']);}?></p>
                    <p class="card-text"><b><?= Yii::t('app', 'Hours at cluster') ?>:</b> <?= $model['hours']?></p>
                    <p class="card-text"><a href="//profile.intra.42.fr/users/<?= $model['login']?>" target="_blank" class="btn btn-warning bg-warning">Intra</a></p>
                    <p class="card-text"><a href="<?= '/' . Yii::$app->language . '/' . $switch ?>/<?= $model['login'] ?>" class="btn btn-success bg-success"><?= ucfirst(substr_replace($switch, "", -1)) ?> Profile</a></p>
                    <?php  if ($model['login'] !== Yii::$app->user->identity->username) {
                    if(\app\models\Friend::check($model['login'])) { ?>
                        <a href="<?php echo '/' . Yii::$app->language ?>/friends/delete/<?= $model['login'] ?>" id="friends-delete" class="btn btn-md btn-danger bg-danger" data-method="POST"><?= Yii::t('app', 'Delete Friend')?></a>
                    <?php } else {;?>
                        <a href="<?php echo '/' . Yii::$app->language ?>/friends/create/<?= $model['login'] ?>/<?= $explode ?>" id="friends-create" class="btn btn-md btn-success bg-success"><?= Yii::t('app', 'Add Friend')?></a>
                    <?php }
                    } ?>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= Yii::t('app', 'Skills') ?></h5>
                    <?php foreach ($skills as $skill) { ?>
                        <div class="progress" data-placement="left" data-toggle="tooltip" title="<?= $skill['skills_level'] ?>">
                            <div class="progress-bar mini progress-bar-<?= ViewHelper::getLevelColorClass($skill['skills_level'])?> progress-bar-striped active" role="progressbar" style="width:<?= ViewHelper::getProgress($skill['skills_level'])?>%">
                                <p><?= $skill['skills_name'] ?></p>
                            </div>
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

            $corrections = $this->render('_correct', [
                    'model' => $model,
                    'switch' => $switch,
                    'projects' => $projects,
                    'urlHelperForProjects' => $urlHelperForProjects,
                    'course' => $course,
                    'parents' => $parents,
                    'searchModelCorrections' => $searchModelCorrections,
                    'dataProviderCorrections' => $dataProviderCorrections,
                    'action' => $action
            ]);

            $friends = $this->render('@app/views/friend/view', ['searchModel' => $searchModelFriend, 'dataProvider' => $dataProviderFriend, 'tab' => 'profile']);

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
                    'label'   => '<i class="glyphicon glyphicon-ok-circle"></i> ' . Yii::t('app', 'Correction Logs'),
                    'content' => $corrections,
                ],
                [
                    'label'   => '<i class="glyphicon glyphicon-gift"></i> ' . Yii::t('app', 'Achievements'),
                    'content' => '',
                ],
                [
                    'label'   => '<i class="glyphicon glyphicon-user"></i> ' . Yii::t('app', 'Friends'),
                    'content' => $friends,
                ],
            ];
        ?>

        <div class="col-lg-9 mx-auto">
            <div class="card">
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
