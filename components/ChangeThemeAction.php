<?php

namespace app\components;

use Yii;
use yii\base\Action;
use app\helpers\ThemesHelper;

class ChangeThemeAction extends Action
{
    public function run()
    {
        $session = Yii::$app->session;
        if (!$session->isActive) {
            $session->open();
        }
        $theme = $session->get('theme');

        if ($theme->isDefault()) {
            $theme->setDark();
        } else {
            $theme->setDefault();
        }

        return Yii::$app->getResponse()->redirect(Yii::$app->getUser()->getReturnUrl(null));
    }
}
