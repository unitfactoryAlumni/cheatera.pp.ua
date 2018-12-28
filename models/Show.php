<?php
/**
 * Created by PhpStorm.
 * User: omentes
 * Date: 12/28/18
 * Time: 11:38 AM
 */

namespace app\models;


use yii\db\ActiveRecord;

class Show extends ActiveRecord
{
    public static function tableName()
    {
        return 'xlogins';
    }
}