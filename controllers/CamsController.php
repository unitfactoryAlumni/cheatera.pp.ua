<?php

namespace app\controllers;

use Yii;
use app\models\Cams;
use yii\data\ActiveDataProvider;

class CamsController extends CommonController
{
    public static $garantedIps = ['178.214.196.34'];

    public function actionIndex()
    {
        $title = Yii::t('app', 'Cameras from unit factory online');
        $description = Yii::t('app', 'Cameras has been stolen from https://marvin.unit.ua/cams');
        $this->setMeta($title, $description);

        $dataProvider = new ActiveDataProvider([
            'query' => Cams::find(),
        ]);

        $isAccessGaranted = YII_ENV_DEV || in_array(Yii::$app->getRequest()->getUserIP(), self::$garantedIps);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'isAccessGaranted' => $isAccessGaranted,
            'breadcrumbs' => [
                'name' => Yii::t('app', 'Cams'),
                'url' => 'cams'
            ],
        ]);
    }

}
