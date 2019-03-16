<?php

namespace app\helpers;

use Yii;
use yii\web\Cookie;
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
        //     'name' => self::NAME,
        //     'value' => $value,
        //     'expire' => time() + 86400 * 365 * 5,
        //     // 'domain' => '.',
        // ]);
        setcookie(self::NAME, $value, time() + 86400 * 365 * 5);
    }

    /**
     * checkThemeCookie - get cookies Object for all the class
     * sets, if necessary, self::NAME cookie to self::$themes['default'] value.
     *
     * @return  Object      Cookies Object
     */
    private static function checkThemeCookie()
    {
        // $cookies = Yii::$app->getResponse()->getCookies();

        // echo '<pre>'; var_export($cookies); echo '</pre>'; die();

        // if (!$cookies->getValue(self::NAME, false)) {
        //     $cookies->add( self::createCookie(self::$themes['default']) );
        // }

        // return $cookies;

        if (!$_COOKIE[self::NAME]) {
            ThemesHelper::setDefault();
            return self::$themes['default'];
        }

        return $_COOKIE[self::NAME];
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
        return self::checkThemeCookie(); //, self::getDefault());
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
        self::setCookie( self::$themes['dark'] );
    }

    public static function setDefault()
    {
        self::setCookie( self::$themes['default'] );
    }

}
