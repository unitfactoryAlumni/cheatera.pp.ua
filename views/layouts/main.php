<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\widgets\Alert;
use yii\bootstrap\Nav;
use app\assets\AppAsset;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\helpers\ThemesHelper;

raoul2000\bootswatch\BootswatchAsset::$theme = ThemesHelper::getCurrent();
AppAsset::register($this);
$this->registerJsFile('@web/js/site.js', ['depends' => [yii\web\JqueryAsset::className()],
    'position' => \yii\web\View::POS_END]);
$this->registerCssFile('@web/css/site' . (YII_ENV_DEV ? '.css'
        : '.min.css'), ['depends' => [yii\bootstrap\BootstrapAsset::className()]]);
if (ThemesHelper::isDark()) {
    $this->registerCssFile('@web/css/fix-dark-theme.css');
}

// echo '<pre>'; var_export(  ); echo '</pre>'; die();

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

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'UA-122178531-1');
    </script>

    <?php $this->head() ?>
</head>
<style>
    .new-friend {
        /* @TODO Add style */
    }

</style>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-default navbar-fixed-top',
        ],
    ]);
    $menu = [
        'options' => ['class' => 'navbar-nav navbar-right'],
        'encodeLabels' => false,
        'items' => [
            'Misc' => YII_ENV_DEV
                ? [
                    'label' => Yii::$app->getRequest()->getUserIP(),
                    'items' => [
                        ['label' => 'Debug', 'url' => ['/debug']],
                        '<li class="divider"></li>',
                        ['label' => 'Gii Model', 'url' => ['/gii/model']],
                        ['label' => 'Gii CRUD', 'url' => ['/gii/crud']],
                        ['label' => 'Gii Controller', 'url' => ['/gii/controller']],
                    ],
                ]
                : [
                    'label' => Yii::t('app', 'Add issue'),
                    'url' => 'https://github.com/cheatera-pp-ua/cheatera.pp.ua/issues/new/choose',
                ],
            'Update' => [
                'label' => Yii::t('app', 'Update log'),
                'items' => \app\helpers\ViewHelper::getLastUpdate(),
            ],
            'Links' => [
                'label' => 'Links',
                'items' => [
                    ['label' => 'UNIT Portal', 'url' => 'https://unitportal.click/'],
                    ['label' => 'Telegram Chat', 'url' => 'https://t.me/unit2k17'],
                ],
            ],
            'Students' => [
                'label' => Yii::t('app', 'Students'),
                'items' => [
                    ['label' => Yii::t('app', 'Members'), 'url' => ['/students']],
                    ['label' => Yii::t('app', 'Projects'), 'url' => ['/students/projects']],
                    ['label' => Yii::t('app', 'Cheating'), 'url' => ['/students/cheating']],
                ],
            ],
            'Pools' => [
                'label' => Yii::t('app', 'Pools'),
                'items' => [
                    ['label' => Yii::t('app', 'Members'), 'url' => ['/pools']],
                    ['label' => Yii::t('app', 'Projects'), 'url' => ['/pools/projects']],
                    ['label' => Yii::t('app', 'Cheating'), 'url' => ['/pools/cheating']],
                ],
            ],
            'Services' => [
                'label' => Yii::t('app', 'Services'),
                'items' =>
                    YII_ENV_DEV
                    || in_array(Yii::$app->getRequest()->getUserIP(), app\controllers\CamsController::$garantedIps)
                        ? [
                        ['label' => Yii::t('app', 'Calculator'), 'url' => ['/calculator']],
                        ['label' => Yii::t('app', 'Corrections'), 'url' => ['/corrections']],
                        ['label' => Yii::t('app', 'Cams'), 'url' => ['/cams']],
                    ]
                        : [
                        ['label' => Yii::t('app', 'Calculator'), 'url' => ['/calculator']],
                        ['label' => Yii::t('app', 'Corrections'), 'url' => ['/corrections']],
                    ],
            ],
            'Account' => Yii::$app->user->isGuest
                ? [
                    'label' => Yii::t('app', 'Account'),
                    'items' => [
                        ['label' => Yii::t('app', 'with 42'), 'url' => ['/auth?authclient=auth42']],
                        ['label' => Yii::t('app', 'with pass'), 'url' => ['/login']],
                    ],
                ]
                : [
                    'label' => (
                    isset(Yii::$app->session['profile'])
                        ? (Yii::$app->user->identity->username)
                        : (Yii::t('app', 'Account'))
                    ),
                    'items' => [
                        isset(Yii::$app->session['profile'])
                            ? ([
                            'label' => Yii::t('app', 'Profile'),
                            'url' => [Yii::$app->session['profile']],
                        ])
                            : '<li class="divider"></li>',
                        [
                            'label' => Yii::t('app', 'Friends'),
                            'url' => ['friend/index'],
                        ],
                        [
                            'label' => Yii::t('app', 'Logout'),
                            'url' => ['/site/logout'],
                            'linkOptions' => ['data-method' => 'post'],
                        ],
                    ],
                ],
        ],
    ];

    echo Nav::widget($menu);
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
            <span class="pull-left">
                <?= \app\helpers\FlagsLang::widget() ?>
            </span>

        <span class="pull-right">
                <?= ThemesHelper::getThemesSwitcherHtml() ?>
            </span>
    </div>
</footer>
<?php $this->endBody() ?>

</body>

</html>
<?php $this->endPage() ?>
