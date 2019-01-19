<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "updated_db".
 *
 * @property int $id
 * @property string $subject
 * @property string $updated_at
 */
class UpdatedDb extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'updated_db';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['updated_at'], 'safe'],
            [['subject'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'subject' => Yii::t('app', 'Subject'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
