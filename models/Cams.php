<?php

namespace app\models;

use Yii;
use yii\filters\AccessControl;

/**
 * This is the model class for table "cams".
 *
 * @property string $area_name
 * @property string $cam_address
 */
class Cams extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only'  => ['index'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'ips' => ['10.112.*.*', '172.*.*.*', '192.168.99.1', '127.0.0.1', '::1'],
                    ],
                ],
                'denyCallback' => function ($rule, $action) {
                    throw new \Exception(Yii::t('app', 'You are not allowed to access this page'));
                }
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cams';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cam_address'], 'required'],
            [['area_name'], 'string', 'max' => 127],
            [['cam_address'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'area_name' => Yii::t('app', 'Area Name'),
            'cam_address' => Yii::t('app', 'Cam Address'),
        ];
    }
}
