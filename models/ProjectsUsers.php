<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "projects_users".
 *
 * @property int $id
 * @property string $xlogin
 * @property int $current_team_id
 * @property int $cursus_ids
 * @property int $final_mark
 * @property int $puid
 * @property int $occurrence
 * @property int $project_id
 * @property string $name
 * @property int $parent_id
 * @property string $slug
 * @property string $status
 * @property string $validated
 */
class ProjectsUsers extends \yii\db\ActiveRecord
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
            'occurrence' => Yii::t('app', 'Occurrence'),
            'project_id' => Yii::t('app', 'Project ID'),
            'name' => Yii::t('app', 'Name'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'slug' => Yii::t('app', 'Slug'),
            'status' => Yii::t('app', 'Status'),
            'validated' => Yii::t('app', 'Validated'),
        ];
    }
}
