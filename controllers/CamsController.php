<?php

namespace app\controllers;

use Yii;
use app\models\Cams;
use yii\data\ActiveDataProvider;

class CamsController extends CommonController
{

    public function actionIndex()
    {
        $title = Yii::t('app', 'Cameras from unit factory online');
        $description = Yii::t('app', 'Cameras has been stolen from https://marvin.unit.ua/cams');
        $this->setMeta($title, $description);

        $model = new Cams();
        $dataProvider = new ActiveDataProvider([
            'query' => $model::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'breadcrumbs' => [
                'name' => Yii::t('app', 'Cams'),
                'url' => 'cams'
            ],
        ]);
    }

}
