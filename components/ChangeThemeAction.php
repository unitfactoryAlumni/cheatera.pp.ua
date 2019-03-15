<?php

namespace app\components;

use Yii;
use yii\base\Action;
use app\helpers\ThemesHelper;

class ChangeThemeAction extends Action
{
    public function run()
    {
        $theme = new ThemesHelper;

        if ($theme->isDefault()) {
            $theme->setDark();
        } else {
            $theme->setDefault();
        }

        return Yii::$app->getResponse()->redirect(Yii::$app->getUser()->getReturnUrl(null));
    }
}
