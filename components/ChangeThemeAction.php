<?php

namespace app\components;

use Yii;
use yii\base\Action;
use app\helpers\ThemesHelper;

class ChangeThemeAction extends Action
{
    public function run()
    {
        ThemesHelper::setDark();
        if (ThemesHelper::isDefault()) {
        } else if (ThemesHelper::isDark()) {
            ThemesHelper::setDefault();
        }
        //  else {
        //     throw new Exception("Error Processing Request", 1);
        // }

        return Yii::$app->getResponse()->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
    }
}
