<?php

namespace app\helpers;

use klisl\languages\widgets\ListWidget;
use yii\helpers\Html;

class FlagsLang extends ListWidget
{
    protected function createLink($key, $value){
        return Html::a(Html::img('/web/img/flags/'.$value.'.png', ['width' => '24px', 'style' => 'padding:1px']), ['languages/default/index', 'lang' => $value], ['class' => 'language '.$value] );
    }
}