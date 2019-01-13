<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "projects_cache".
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property double $avgFinalMark
 * @property int $validated
 * @property int $finished
 * @property int $failed
 * @property int $wfc
 * @property int $inprogress
 * @property int $sag
 * @property int $cg
 * @property string $course
 */
class Projects extends \yii\db\ActiveRecord
{
    protected $course;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projects_cache';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'slug', 'avgFinalMark', 'validated', 'finished', 'failed', 'wfc', 'inprogress', 'sag', 'cg'], 'required'],
            [['slug'], 'string'],
            [['avgFinalMark'], 'number'],
            [['validated', 'finished', 'failed', 'wfc', 'inprogress', 'sag', 'cg'], 'integer'],
            [['name', 'course'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('app', 'project'),
            'avgFinalMark' => Yii::t('app', 'final mark (AVG)'),
            'validated' => Yii::t('app', 'validated'),
            'finished' => Yii::t('app', 'finished'),
            'failed' => Yii::t('app', 'failed'),
            'wfc' => Yii::t('app', 'wait correction'),
            'inprogress' => Yii::t('app', 'in progress'),
            'sag' => Yii::t('app', 'search group'),
            'cg' => Yii::t('app', 'created'),
        ];
    }
}
