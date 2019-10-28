<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "skills".
 * @property int    $id
 * @property string $xlogin
 * @property int    $cursus_id
 * @property int    $skills_id
 * @property double $skills_level
 * @property string $skills_name
 */
class Skills extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'skills';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cursus_id', 'skills_id'], 'integer'],
            [['skills_level'], 'number'],
            [['xlogin'], 'string', 'max' => 12],
            [['skills_name'], 'string', 'max' => 255],
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
            'cursus_id' => Yii::t('app', 'Cursus ID'),
            'skills_id' => Yii::t('app', 'Skills ID'),
            'skills_level' => Yii::t('app', 'Skills Level'),
            'skills_name' => Yii::t('app', 'Skills Name'),
        ];
    }
}
