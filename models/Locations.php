<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "locations".
 *
 * @property int $id
 * @property int $lid
 * @property int $campus_id
 * @property string $host
 * @property string $begin_at
 * @property string $end_at
 * @property string $xlogin
 * @property int $user_id
 */
class Locations extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'locations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lid', 'campus_id', 'user_id'], 'integer'],
            [['begin_at', 'end_at', 'date', 'how'], 'safe'],
            [['host'], 'string', 'max' => 25],
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
            'lid' => Yii::t('app', 'Lid'),
            'campus_id' => Yii::t('app', 'Campus ID'),
            'host' => Yii::t('app', 'Host'),
            'begin_at' => Yii::t('app', 'Begin At'),
            'end_at' => Yii::t('app', 'End At'),
            'xlogin' => Yii::t('app', 'Xlogin'),
            'user_id' => Yii::t('app', 'User ID'),
        ];
    }
}
