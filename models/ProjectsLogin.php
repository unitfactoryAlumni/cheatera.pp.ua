<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "projects_users".
 *
 */
class ProjectsLogin extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projects_users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['current_team_id', 'cursus_ids', 'final_mark', 'puid', 'occurrence', 'project_id', 'parent_id'], 'integer'],
            [['xlogin'], 'string', 'max' => 12],
            [['name', 'slug'], 'string', 'max' => 255],
            [['status', 'validated'], 'string', 'max' => 25],
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
            'current_team_id' => Yii::t('app', 'Current Team ID'),
            'cursus_ids' => Yii::t('app', 'Cursus Ids'),
            'final_mark' => Yii::t('app', 'Final Mark'),
            'puid' => Yii::t('app', 'Puid'),
            'occurrence' => Yii::t('app', 'Retry'),
            'project_id' => Yii::t('app', 'Project ID'),
            'name' => Yii::t('app', 'Name'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'slug' => Yii::t('app', 'Slug'),
            'status' => Yii::t('app', 'Status'),
            'validated' => Yii::t('app', 'Validated'),
            'avgFinalMark' => Yii::t('app', 'final mark (AVG)'),
            'finished' => Yii::t('app', 'finished'),
            'failed' => Yii::t('app', 'failed'),
            'wfc' => Yii::t('app', 'wait correction'),
            'inprogress' => Yii::t('app', 'in progress'),
            'sag' => Yii::t('app', 'search group'),
            'cg' => Yii::t('app', 'created'),
        ];
    }
}
