<?php

namespace app\components;

use Yii;
use yii\base\Action;
use app\helpers\ThemesHelper;

class ChangeThemeAction extends Action
{
    public function run()
    {
        if (ThemesHelper::isDefault()) {
            ThemesHelper::setDark();
        } elseif (ThemesHelper::isDark()) {
            ThemesHelper::setDefault();
        }

        return Yii::$app->getResponse()->redirect(Yii::$app->request->referrer ?? Yii::$app->homeUrl);
    }
}
