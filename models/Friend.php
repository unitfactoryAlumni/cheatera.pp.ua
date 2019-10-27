<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "friend".
 * @property int    $id
 * @property string $mylogin
 * @property string $xlogin
 * @property int    $status
 * @property string $course
 */
class Friend extends \yii\db\ActiveRecord
{
    public $login;

    public $displayname;

    public $phone;

    public $image_url;

    public $level;

    public $correction_point;

    public $pool_year;

    public $pool_month;

    public $location;

    public $lastloc;

    public $wallet;

    public $howach;

    public $hours;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'friends';
    }

    public static function check($id)
    {
        return Friend::find()->where(['mylogin' => Yii::$app->user->identity->username, 'xlogin' => $id])->one();
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['mylogin', 'xlogin', 'course'], 'string', 'max' => 25],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'course' => Yii::t('app', 'Course'),
            'mylogin' => Yii::t('app', 'Mylogin'),
            'xlogin' => Yii::t('app', 'Xlogin'),
            'status' => Yii::t('app', 'Status'),
            'pool_month' => Yii::t('app', 'Month'),
            'correction_point' => Yii::t('app', 'CP'),
            'displayname' => Yii::t('app', 'Name'),
            'email' => Yii::t('app', 'Email'),
            'first_name' => Yii::t('app', 'First Name'),
            'image_url' => Yii::t('app', ''),
            'last_name' => Yii::t('app', 'Last Name'),
            'location' => Yii::t('app', 'Host'),
            'login' => Yii::t('app', 'Login'),
            'phone' => Yii::t('app', 'Phone'),
            'pool_year' => Yii::t('app', 'Year'),
            'url' => Yii::t('app', 'Url'),
            'wallet' => Yii::t('app', 'Wallet'),
            'howach' => Yii::t('app', 'Achiv'),
            'kick' => Yii::t('app', 'Kick'),
            'lastloc' => Yii::t('app', 'Last login'),
            'needupd' => Yii::t('app', 'Needupd'),
            'hours' => Yii::t('app', 'Hours'),
        ];
    }
}
