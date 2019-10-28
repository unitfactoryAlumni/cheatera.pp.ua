<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "achievements".
 * @property int    $id
 * @property string $xlogin
 * @property string $description
 * @property int    $aid
 * @property string $image
 * @property string $kind
 * @property string $name
 * @property string $nbr_of_success
 * @property string $tier
 * @property string $users_url
 * @property string $visible
 */
class Achievements extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'achievements';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'image'], 'string'],
            [['aid'], 'integer'],
            [['xlogin'], 'string', 'max' => 12],
            [['kind', 'name', 'nbr_of_success', 'tier', 'users_url', 'visible'], 'string', 'max' => 255],
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
            'description' => Yii::t('app', 'Description'),
            'aid' => Yii::t('app', 'Aid'),
            'image' => Yii::t('app', 'Image'),
            'kind' => Yii::t('app', 'Kind'),
            'name' => Yii::t('app', 'Name'),
            'nbr_of_success' => Yii::t('app', 'Nbr Of Success'),
            'tier' => Yii::t('app', 'Tier'),
            'users_url' => Yii::t('app', 'Users Url'),
            'visible' => Yii::t('app', 'Visible'),
        ];
    }
}
