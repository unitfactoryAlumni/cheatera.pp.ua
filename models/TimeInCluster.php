<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "time_in_cluster".
 *
 * @property int $id
 * @property string $xlogin
 * @property string $oneday
 * @property double $timer
 */
class TimeInCluster extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'time_in_cluster';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['oneday'], 'safe'],
            [['timer'], 'number'],
            [['xlogin'], 'string', 'max' => 12],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'xlogin' => Yii::t('app', 'Xlogin'),
            'oneday' => Yii::t('app', 'Oneday'),
            'timer' => Yii::t('app', 'Timer'),
        ];
    }
}
