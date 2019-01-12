<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "log".
 *
 * @property int $id
 * @property string $xlogin
 * @property string $auth_date
 * @property string $ip
 * @property string $agent
 */
class Log extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['auth_date'], 'safe'],
            [['agent'], 'required'],
            [['agent'], 'string'],
            [['xlogin', 'ip'], 'string', 'max' => 25],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'xlogin' => 'Xlogin',
            'auth_date' => 'Auth Date',
            'ip' => 'Ip',
            'agent' => 'Agent',
        ];
    }
}
