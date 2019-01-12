<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cursus_users".
 *
 * @property int $id
 * @property string $xlogin
 * @property int $cursus_id
 * @property string $begin_at
 * @property string $created_at
 * @property string $name
 * @property string $slug
 * @property string $end_at
 * @property string $grade
 * @property string $has_coalition
 * @property int $cursus_users_id
 * @property double $level
 * @property int $xid
 */
class Curses extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cursus_users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cursus_id', 'cursus_users_id', 'xid'], 'integer'],
            [['begin_at'], 'safe'],
            [['created_at', 'end_at'], 'string'],
            [['level'], 'number'],
            [['xlogin', 'has_coalition'], 'string', 'max' => 12],
            [['name', 'slug', 'grade'], 'string', 'max' => 255],
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
            'cursus_id' => 'Curses ID',
            'begin_at' => 'Begin At',
            'created_at' => 'Created At',
            'name' => 'Name',
            'slug' => 'Slug',
            'end_at' => 'End At',
            'grade' => 'Grade',
            'has_coalition' => 'Has Coalition',
            'cursus_users_id' => 'Curses Users ID',
            'level' => 'Level',
            'xid' => 'Xid',
        ];
    }
}
