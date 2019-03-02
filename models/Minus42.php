<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "m42".
 *
 * @property int $id
 * @property string $xlogin
 * @property int $puid
 * @property string $updated_at
 */
class Minus42 extends \yii\db\ActiveRecord
{
    public $pool_year;
    public $pool_month;
    public $name;
    public $slug;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'm42';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['puid'], 'integer'],
            [['updated_at'], 'safe'],
            [['xlogin'], 'string', 'max' => 25],
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
            'puid' => Yii::t('app', 'Puid'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
