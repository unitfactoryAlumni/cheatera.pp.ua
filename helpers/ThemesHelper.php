<?php

namespace app\helpers;

use Yii;
use yii\helpers\Html;
use yii\web\Cookie;

/**
 * ThemesHelper
 */
class ThemesHelper
{
    public const ACTION_NAME = 'change-theme';
    public const NAME = 'theme';

    static private $themes = [
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
        'dark' => 'superhero',
    ];


    public static function getExpired()
    {
        return time() + 86400 * 365 * 5;
    }

    public static function checkThemeCoockie()
    {
        $cookies = Yii::$app->response->cookies;

        if (!$cookies->has(self::NAME)) {
            $cookies->add(new \yii\web\Cookie([
                'name' => self::NAME,
                'value' => self::$themes['default'],
                'expire' => self::getExpired(),
            ]));
        }

        return $cookies;
    }

    /**
     * getThemesSwitchetHtml - get html code for theme switcher to input to any place on site
     *
     * @param   Object  $theme  Initialized ThemeHelper, themself, Object
     *
     * @return  String          Generated Html for current ThemeHelper Object
     */
    public static function getThemesSwitcherHtml()
    {
        return Html::a( Yii::t('app', (self::isDefault() ? 'Set Dark Theme' : 'Set Default Theme'))
        , '/' . self::ACTION_NAME );
    }


    public static function getCurrent()
    {
        return self::checkThemeCoockie()->get(self::NAME)->value;
    }

    public static function getDefault()
    {
        return self::$themes['default'];
    }

    public static function getDark()
    {
        return self::$themes['dark'];
    }

    public static function isDefault()
    {
        return self::$themes['default'] == self::getCurrent();
    }

    public static function isDark()
    {
        return self::$themes['dark'] == self::getCurrent();
    }

    public static function setDark()
    {
        $cookies = self::checkThemeCoockie();

        $cookies->remove(self::NAME);
        $cookies->add(new Cookie([
            'name' => self::NAME,
            'value' => self::$themes['dark'],
            'expire' => self::getExpired(),
        ]));
    }

    public static function setDefault()
    {
        $cookies = self::checkThemeCoockie();

        $cookies->remove(self::NAME);
        $cookies->add(new Cookie([
            'name' => self::NAME,
            'value' => self::$themes['default'],
            'expire' => self::getExpired(),
        ]));
    }

}
