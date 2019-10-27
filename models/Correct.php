<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "correction_history".
 * @property int    $id
 * @property string $xlogin
 * @property int    $corrections
 * @property double $level
 * @property string $date
 */
class Correct extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'correction_history';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['xlogin', 'corrections', 'level'], 'required'],
            [['corrections'], 'integer'],
            [['level'], 'number'],
            [['date'], 'safe'],
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
            'corrections' => Yii::t('app', 'Corrections'),
            'level' => Yii::t('app', 'Level'),
            'date' => Yii::t('app', 'Date'),
        ];
    }
}
