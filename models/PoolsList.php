<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pools".
 *
 * @property int $id
 * @property string $year
 * @property string $month
 * @property string $begin_at
 * @property string $end_at
 */
class PoolsList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pools';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['year', 'month', 'begin_at', 'end_at'], 'required'],
            [['begin_at', 'end_at'], 'safe'],
            [['year', 'month'], 'string', 'max' => 25],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'year' => Yii::t('app', 'Year'),
            'month' => Yii::t('app', 'Month'),
            'begin_at' => Yii::t('app', 'Begin At'),
            'end_at' => Yii::t('app', 'End At'),
        ];
    }
}
