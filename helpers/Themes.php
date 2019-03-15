<?php

namespace app\helpers;

use Yii;

class Themes
{

    private const COOCKIE_NAME = 'theme';

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

        if (!$this->cookies->has(self::COOCKIE_NAME)) {
            $this->cookies->add(new \yii\web\Cookie([
                'name' => self::COOCKIE_NAME,
                'value' => $this->themes['default'],
                'expire' => $this->expire,
            ]));
        }
    }


    public function getCurrent()
    {
        return $this->cookies->get(self::COOCKIE_NAME)->value;
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
        $this->cookies->remove(self::COOCKIE_NAME);
        $this->cookies->add(new \yii\web\Cookie([
            'name' => self::COOCKIE_NAME,
            'value' => $this->themes['dark'],
            'expire' => $this->expire,
        ]));
    }

    public function setDefault()
    {
        $this->cookies->remove(self::COOCKIE_NAME);
        $this->cookies->add(new \yii\web\Cookie([
            'name' => self::COOCKIE_NAME,
            'value' => $this->themes['default'],
            'expire' => $this->expire,
        ]));
    }

}
