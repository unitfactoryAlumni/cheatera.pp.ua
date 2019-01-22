<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "xlogins".
 *
 * @property int $id
 * @property int $correction_point
 * @property string $displayname
 * @property string $email
 * @property string $first_name
 * @property int $xid
 * @property string $image_url
 * @property string $last_name
 * @property string $location
 * @property string $login
 * @property string $phone
 * @property string $pool_month
 * @property int $pool_year
 * @property string $staff
 * @property string $url
 * @property int $wallet
 * @property int $howach
 * @property int $kick
 * @property string $lastloc
 * @property int $needupd
 * @property double $hours
 * @property double $lasthours
 * @property int $visible
 */
class Show extends \yii\db\ActiveRecord
{
    public $level;

    public $grade;

    public $link;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'xlogins';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['correction_point', 'xid', 'pool_year', 'wallet', 'howach', 'kick', 'needupd', 'visible'], 'integer'],
            [['image_url', 'url', 'link'], 'string'],
            [['kick', 'lastloc'], 'required'],
            [['lastloc'], 'safe'],
            [['hours', 'lasthours'], 'number'],
            [['displayname', 'email', 'first_name', 'last_name', 'location', 'login', 'phone', 'pool_month', 'staff'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'correction_point' => 'CP',
            'displayname' => 'Name',
            'email' => 'Email',
            'first_name' => 'First Name',
            'xid' => 'Xid',
            'image_url' => '',
            'last_name' => 'Last Name',
            'location' => 'Host',
            'login' => 'Login',
            'phone' => 'Phone',
            'pool_month' => Yii::t('app', 'Month'),
            'pool_year' => 'Year',
            'staff' => 'Staff',
            'url' => 'Url',
            'wallet' => 'Wallet',
            'howach' => 'Achiv',
            'kick' => 'Kick',
            'lastloc' => 'Last login',
            'needupd' => 'Needupd',
            'hours' => 'Hours',
            'visible' => 'Visible',
            'level' => 'lvl',
            'link' => '',
            'grade' => 'grade'
        ];
    }
}
