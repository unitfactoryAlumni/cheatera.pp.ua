<?php

namespace app\controllers;

use app\models\ProjectsAll;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;

/**
 * ProjectsAllFiltering represents the model behind the search form of `app\models\ProjectsAll`.
 */
class ProjectsAllFiltering extends ProjectsAll
{
    public $parent = null;
    public $course = null;

    public function __construct(array $configs = [])
    {
        if (count($configs) > 0) {
            if (key_exists('parent', $configs)) {
                $this->parent = $configs['parent'];
            }
            if (key_exists('course', $configs)) {
                $this->course = $configs['course'];
            }
        }
        parent::__construct($configs);
    }

    /**
     * For pools data
     *
     * SELECT pu.*
    34 FROM
    35         projects_users as pu,
    36     (
    37         SELECT * FROM xlogins
    38                 WHERE xlogins.pool_year = \"" . $data_array['year'] .
     * "\" and xlogins.pool_month=\"" . $data_array['month'] . "\" ORDER BY xlogins    .login ASC
    39     ) as xl
    40 WHERE pu.xlogin = xl.login and pu.cursus_ids=\"4\"
    41 ORDER BY pu.name ASC, pu.xlogin ASC
    42   ;";
     * old shit code
     *     $it = 0;
    $fm = 0;
    $valid = 0;
    $fin = 0;
    $fail = 0;
    $ip = 0;
    $sag = 0;
    $cg = 0;
    $wfc = 0;
    foreach ($newnew[$val[0]] as $val) {
        if ($val[status] == "in_progress") {
        $ip++;
        }
        if ($val[status] == "searching_a_group") {
        $sag++;
        }
        if ($val[status] == "creating_group") {
        $cg++;
        }
        if ($val[status] == "waiting_for_correction") {
        $wfc++;
        }
        if ($val[validated] != "None") {
        if ($val[validated] == "True") { $valid++; } else { $fail++; }
        $it++;
        $fm += $val[final_mark];
        }
     *
     * SELECT
    pu.name,
    AVG(CASE WHEN pu.status='finished' THEN pu.final_mark ELSE 0 END) as finalmark,
    COUNT(CASE WHEN pu.status='finished' THEN 1 ELSE NULL END) as finished,
    COUNT(CASE WHEN pu.validated='True' THEN 1 ELSE NULL END) as validated,
    COUNT(CASE WHEN pu.validated='False' THEN 1 ELSE NULL END) as failed,
    COUNT(CASE WHEN pu.status='in_progress' THEN 1 ELSE NULL END) as inprogress,
    COUNT(CASE WHEN pu.status='searching_a_group' THEN 1 ELSE NULL END) as sag,
    COUNT(CASE WHEN pu.status='waiting_for_correction' THEN 1 ELSE NULL END) as wfc,
    COUNT(CASE WHEN pu.status='creating_group' THEN 1 ELSE NULL END) as cg,
    pu.slug
    FROM `projects_users` as pu
    INNER join xlogins on xlogins.login = pu.xlogin
    where xlogins.pool_month = "february" and pu.cursus_ids = 1
    GROUP BY pu.project_id
    ORDER BY `finalmark` asc
    }
    */

    public function getDataByCourse()
    {
         return ProjectsAll::find()
            ->select([
                'projects_users.*',
                'xlogins.*',
            ])
            ->innerJoin('xlogins','projects_users.xlogin = xlogins.login and xlogins.kick = 0')
            ->where([
                'cursus_ids' => $this->course,
                'parent_id' => 0,
            ]);
    }

    public function getDataByParent()
    {
        /**
         * @TODO Implementation function for get data
         */
    }

    public function counting($allRecords)
    {
        $records = [];
        $models = [];
        foreach ($allRecords as $record) {
            $records[$record->slug][] = $record;
        }
        foreach ($records as $group) {
            $it = 0;
            $fm = 0;
            $valid = 0;
            $fail = 0;
            $ip = 0;
            $sag = 0;
            $cg = 0;
            $wfc = 0;
            $model = [];
            foreach ($group as $record) {
                if ($record->status == "in_progress") {
                    $ip++;
                }
                if ($record->status == "searching_a_group") {
                    $sag++;
                }
                if ($record->status == "creating_group") {
                    $cg++;
                }
                if ($record->status == "waiting_for_correction") {
                    $wfc++;
                }
                if ($record->validated != "None") {
                    if ($record->validated == "True") { $valid++; } else { $fail++; }
                    $it++;
                    $fm += $record->final_mark;
                }
                $model['name'] = $record->name;
            }
            $model['final_mark'] = round($fm / $it, 0);
            $model['validated'] = $valid;
            $model['finished'] = $valid + $fail;
            $model['failed'] = $fail;
            $model['wfc'] = $wfc;
            $model['inprogress'] = $ip;
            $model['sag'] = $sag;
            $model['cg'] = $cg;
            $models[] = $model;
        }
        return $models;
    }

    public function search($params)
    {
        $query = self::counting(self::getDataByCourse());

        // add conditions that should always apply here

        $dataProvider = new ArrayDataProvider([
            'allModels' => $query,
//            'pagination' => [
//                'pageSize' => 150,
//            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        return $dataProvider;
    }
}
