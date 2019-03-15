<?php

namespace yii\web;

use Yii;
use yii\base\Action;

class ChangeThemeAction extends Action
{
    public function run()
    {
        echo '<pre>'; var_export('Hola!'); echo '</pre>'; die();
    }
}
