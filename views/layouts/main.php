<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

$themes = [
    'cerulean' => 'Cerulean',
    'cosmo' => 'Cosmo',
    'custom' => 'Custom',
    'cyborg' => 'Cyborg',
    'darkly' => 'Darkly',
    'flatly' => 'Flatly',
    'fonts' => 'Fonts',
    'journal' => 'Journal',
    'lumen' => 'Lumen',
    'paper' => 'Paper',
    'readable' => 'Readable',
    'sandstone' => 'Sandstone',
    'simplex' => 'Simplex',
    'slate' => 'Slate',
    'spacelab' => 'Spacelab',
    'superhero' => 'Superhero',
    'united' => 'United',
    'yeti' => 'Yeti',

    'default' => 'cosmo'
];

$labled_themes = [];
foreach ($themes as $k => $v) {
    $labled_themes[] = ['label' => $v, 'url' => ['']];
}

raoul2000\bootswatch\BootswatchAsset::$theme = $themes['default'];
AppAsset::register($this);
$this->registerJsFile('@web/js/site.js', ['depends' => [yii\web\JqueryAsset::className()], 'position' => \yii\web\View::POS_END]);
$this->registerCssFile('@web/css/site' . (YII_ENV_DEV ? '.css' : '.min.css'), ['depends' => [yii\bootstrap\BootstrapAsset::className()]]);

// echo '<pre>'; var_export($request->post('1')); echo '</pre>'; die();

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
                    'class' => 'navbar-default navbar-fixed-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label' => 'Add issue', 'url' => 'https://github.com/omentes/cheatera.pp.ua/issues/new/choose'],
                    [
                        'label' => 'Update',
                        'items' => \app\helpers\ViewHelper::getLastUpdate(),
                    ],
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
                    [
                        'label' => Yii::t('app', 'Services'),
                        'items' => [
                            ['label' => Yii::t('app', 'Calculator'), 'url' => ['/calculator']],
                            ['label' => Yii::t('app', 'Corrections'), 'url' => ['/corrections']],
                        ]
                    ],
                    [
                        'label' => Yii::t('app', 'Themes'),
                        'items' => $labled_themes
                    ],
                    Yii::$app->user->isGuest
                    ? ([
                            'label' => Yii::t('app', 'Account'),
                            'items' => [
                                ['label' => Yii::t('app', 'with 42'), 'url' => ['/auth?authclient=auth42']],
                                ['label' => Yii::t('app', 'with pass'), 'url' => ['/login']],
                            ],
                        ])
                    : ([
                            'label' => (isset(Yii::$app->session['profile'])
                                ? (Yii::$app->user->identity->username)
                                : (Yii::t('app', 'Account'))
                            ),
                            'items' => [
                                isset(Yii::$app->session['profile'])
                                ? ([
                                    'label' => Yii::t('app', 'Profile'), 'url' => [Yii::$app->session['profile']]
                                ])
                                : '<li class="divider"></li>',
                                [
                                    'label' => Yii::t('app', 'Logout'),
                                    'url' => ['/site/logout'],
                                    'linkOptions' => ['data-method' => 'post']
                                ],
                            ],
                        ])
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

</body>

</html>
<?php $this->endPage() ?>
