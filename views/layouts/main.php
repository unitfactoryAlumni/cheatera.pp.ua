<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= $this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'href' => '/web/favicon.png']); ?>
    <?= Html::csrfMetaTags() ?>
    <title>
        <?= Html::encode($this->title) ?>
    </title>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-122178531-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-122178531-1');
    </script>
    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody() ?>

    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => Yii::$app->name,
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label' => 'Add issue', 'url' => 'https://github.com/omentes/cheatera.pp.ua/issues/new/choose'],
                    [
                            'label' => Yii::$app->getRequest()->getUserIP(),
                            'items' => [
                                ['label' => 'Debug', 'url' => ['/debug']],
                                '<li class="divider"></li>',
                                ['label' => 'Gii Model', 'url' => ['/gii/model']],
                                ['label' => 'Gii CRUD', 'url' => ['/gii/crud']],
                                ['label' => 'Gii Controller', 'url' => ['/gii/controller']],
                            ],
                    ],
                    [
                            'label' => Yii::t('app', 'Students'),
                            'items' => [
                                ['label' => Yii::t('app', 'Members'), 'url' => ['/students']],
                                ['label' => Yii::t('app', 'Projects'), 'url' => ['/students/projects']],
                                ['label' => Yii::t('app', 'Cheating'), 'url' => ['/students/cheating']],
                            ],
                    ],
                    [
                            'label' => Yii::t('app', 'Pools'),
                            'items' => [
                                ['label' => Yii::t('app', 'Members'), 'url' => ['/pools']],
                                ['label' => Yii::t('app', 'Projects'), 'url' => ['/pools/projects']],
                                ['label' => Yii::t('app', 'Cheating'), 'url' => ['/pools/cheating']],
                            ],
                    ],
                    ['label' => Yii::t('app', 'Calculator'), 'url' => ['/calculator']],
                    ['label' => Yii::t('app', 'Corrections'), 'url' => ['/corrections']],
                    Yii::$app->user->isGuest ? (
                        [
                                'label' => Yii::t('app', 'Sign In'),
                                'items' => [
                                    ['label' => Yii::t('app', 'with 42'), 'url' => ['/auth?authclient=auth42']],
                                    ['label' => Yii::t('app', 'with pass'), 'url' => ['/login']],
                            ],
                        ]
                    ) : (
                        '<li>'
                        . Html::beginForm(['/site/logout'], 'post')
                        . Html::submitButton(
                            Yii::t('app', 'Logout (') . Yii::$app->user->identity->username . ')',
                            ['class' => 'btn btn-link logout']
                        )
                        . Html::endForm()
                        . '</li>'
                    )
                ],
            ]);
            NavBar::end();
        ?>

        <div class="container">
            <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">
                <?= \app\helpers\FlagsLang::widget() ?>
            </p>

            <p class="pull-right">
                <?= Yii::powered() ?>
            </p>
        </div>
    </footer>
    <?php $this->endBody() ?>

    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

</body>
</html>
<?php $this->endPage() ?>
