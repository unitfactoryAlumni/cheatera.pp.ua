<?php

namespace app\helpers;

use yii\helpers\Html;
use klisl\languages\widgets\ListWidget;

class FlagsLang extends ListWidget
{
    protected function createLink($key, $value)
    {
        return Html::a(Html::img('/web/img/flags/' . $value . '.png', ['width' => '24px',
            'style' => 'padding:1px']), ['languages/default/index', 'lang' => $value], ['class' => 'language '
                                                                                                   . $value]);
    }
}
