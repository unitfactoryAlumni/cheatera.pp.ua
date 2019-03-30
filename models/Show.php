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

    public $cursus_id;

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
            'pool_month' => Yii::t('app', 'Month'),
            'id' => Yii::t('app', 'ID'),
            'correction_point' => Yii::t('app', 'CP'),
            'displayname' => Yii::t('app', 'Name'),
            'email' => Yii::t('app', 'Email'),
            'first_name' => Yii::t('app', 'First Name'),
            'xid' => Yii::t('app', 'Xid'),
            'image_url' => Yii::t('app', ''),
            'last_name' => Yii::t('app', 'Last Name'),
            'location' => Yii::t('app', 'Host'),
            'login' => Yii::t('app', 'Login'),
            'phone' => Yii::t('app', 'Phone'),
            'pool_year' => Yii::t('app', 'Year'),
            'staff' => Yii::t('app', 'Staff'),
            'url' => Yii::t('app', 'Url'),
            'wallet' => Yii::t('app', 'Wallet'),
            'howach' => Yii::t('app', 'Achiv'),
            'kick' => Yii::t('app', 'Kick'),
            'lastloc' => Yii::t('app', 'Last login'),
            'needupd' => Yii::t('app', 'Needupd'),
            'hours' => Yii::t('app', 'Hours'),
            'visible' => Yii::t('app', 'Visible'),
            'level' => Yii::t('app', 'Level'),
            'link' => Yii::t('app', ''),
            'grade' => Yii::t('app', 'grade')
        ];
    }
}
