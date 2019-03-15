<?php

namespace app\helpers;

use Yii;
use yii\helpers\Html;

class ThemesHelper
{
    public const ACTION_NAME = 'change-theme';
    public const NAME = 'theme';

    private $themes = [
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

        'default' => 'cosmo',
        'black' => 'superhero',
    ];

    private $cookies;
    private $expire;


    public function __construct()
    {
        $this->cookies = Yii::$app->response->cookies;
        $this->expire = time() + 86400 * 365;

        if (!$this->cookies->has(self::NAME)) {
            $this->cookies->add(new \yii\web\Cookie([
                'name' => self::NAME,
                'value' => $this->themes['default'],
                'expire' => $this->expire,
            ]));
        }
    }

    /**
     * getThemesSwitchetHtml - 
     *
     * @param   Object  $theme  Initialized ThemeHelper, themself, Object
     *
     * @return  String          Generated Html for current ThemeHelper Object
     */
    static public function getThemesSwitcherHtml($theme)
    {
        $toReturn = '<span class="bs-component">';
            foreach (['Default', 'Dark'] as $v) {
                $classes = 'label reglink ' . ($theme->{('is' . $v)}() ? 'label-primary' : 'label-default');
                $toReturn .= Html::a( Yii::t('app', "Set $v Theme"), '/' . self::ACTION_NAME, ['class' => $classes] );
            }
        $toReturn .= '</span>';

        return $toReturn;
    }


    public function getCurrent()
    {
        return $this->cookies->get(self::NAME)->value;
    }

    public function getDefault()
    {
        return $this->themes['default'];
    }

    public function getDark()
    {
        return $this->themes['dark'];
    }

    public function isDefault()
    {
        return $this->themes['default'] == $this->getCurrent();
    }

    public function isDark()
    {
        return $this->themes['dark'] == $this->getCurrent();
    }

    public function setDark()
    {
        $this->cookies->remove(self::NAME);
        $this->cookies->add(new \yii\web\Cookie([
            'name' => self::NAME,
            'value' => $this->themes['dark'],
            'expire' => $this->expire,
        ]));
    }

    public function setDefault()
    {
        $this->cookies->remove(self::NAME);
        $this->cookies->add(new \yii\web\Cookie([
            'name' => self::NAME,
            'value' => $this->themes['default'],
            'expire' => $this->expire,
        ]));
    }

}
