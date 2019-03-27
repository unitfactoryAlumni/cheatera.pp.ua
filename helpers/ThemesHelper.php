<?php

namespace app\helpers;

use Yii;
// use yii\web\Cookie;
use yii\helpers\Html;

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


    private static function setCookie($value)
    {
        // return new Cookie([
        //     'name' => static::NAME,
        //     'value' => $value,
        //     'expire' => time() + 86400 * 365 * 5,
        //     // 'domain' => '.',
        // ]);
        setcookie(static::NAME, $value, time() + 86400 * 365 * 5);
    }

    /**
     * checkThemeCookie - get cookies Object for all the class
     * sets, if necessary, static::NAME cookie to static::$themes['default'] value.
     *
     * @return  Object      Cookies Object
     */
    private static function checkThemeCookie()
    {
        // $cookies = Yii::$app->getResponse()->getCookies();

        // echo '<pre>'; var_export($cookies); echo '</pre>'; die();

        // if (!$cookies->getValue(static::NAME, false)) {
        //     $cookies->add( static::createCookie(static::$themes['default']) );
        // }

        // return $cookies;

        if (!isset($_COOKIE[static::NAME])) {
            ThemesHelper::setDefault();
            return static::$themes['default'];
        }

        return $_COOKIE[static::NAME];
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
        return Html::a( Yii::t('app', (static::isDefault() ? 'Set Dark Theme' : 'Set Light Theme'))
        , '/' . static::ACTION_NAME );
    }


    public static function getCurrent()
    {
        return static::checkThemeCookie(); //, static::getDefault());
    }

    public static function getDefault()
    {
        return static::$themes['default'];
    }

    public static function getDark()
    {
        return static::$themes['dark'];
    }

    public static function isDefault()
    {
        return static::$themes['default'] == static::getCurrent();
    }

    public static function isDark()
    {
        return static::$themes['dark'] == static::getCurrent();
    }

    public static function setDark()
    {
        static::setCookie( static::$themes['dark'] );
    }

    public static function setDefault()
    {
        static::setCookie( static::$themes['default'] );
    }

}
