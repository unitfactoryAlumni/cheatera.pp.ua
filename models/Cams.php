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
