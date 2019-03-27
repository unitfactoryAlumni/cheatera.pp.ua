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

class Xlogins extends \yii\db\ActiveRecord
{
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
            [['image_url', 'url'], 'string'],
            [['kick', 'lastloc'], 'required'],
            [['lastloc'], 'safe'],
            [['hours', 'lasthours'], 'number'],
            [['displayname', 'email', 'first_name', 'last_name', 'location', 'login', 'phone', 'pool_month', 'staff'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        $this->kick = 0; // ???WTF
        $this->lastloc = date('Y-m-d H:i:s'); // ???WTF
        parent::init();
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'correction_point' => Yii::t('app', 'Correction Point'),
            'displayname' => Yii::t('app', 'Displayname'),
            'email' => Yii::t('app', 'Email'),
            'first_name' => Yii::t('app', 'First Name'),
            'xid' => Yii::t('app', 'Xid'),
            'image_url' => Yii::t('app', 'Image Url'),
            'last_name' => Yii::t('app', 'Last Name'),
            'location' => Yii::t('app', 'Location'),
            'login' => Yii::t('app', 'Login'),
            'phone' => Yii::t('app', 'Phone'),
            'pool_month' => Yii::t('app', 'Pool Month'),
            'pool_year' => Yii::t('app', 'Pool Year'),
            'staff' => Yii::t('app', 'Staff'),
            'url' => Yii::t('app', 'Url'),
            'wallet' => Yii::t('app', 'Wallet'),
            'howach' => Yii::t('app', 'Howach'),
            'kick' => Yii::t('app', 'Kick'),
            'lastloc' => Yii::t('app', 'Lastloc'),
            'needupd' => Yii::t('app', 'Needupd'),
            'hours' => Yii::t('app', 'Hours'),
            'lasthours' => Yii::t('app', 'Lasthours'),
            'visible' => Yii::t('app', 'Visible'),
        ];
    }
}
