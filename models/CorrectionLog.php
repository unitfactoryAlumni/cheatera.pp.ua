<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "correction_log".
 *
 * @property int $id
 * @property int $count
 * @property string $date
 */
class CorrectionLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'correction_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['count', 'date'], 'required'],
            [['count'], 'integer'],
            [['date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'count' => Yii::t('app', 'Count'),
            'date' => Yii::t('app', 'Date'),
        ];
    }
}
