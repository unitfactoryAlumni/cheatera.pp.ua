<?php

namespace app\controllers;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ProjectsAll;

/**
 * ProjectsFilterSearch represents the model behind the search form of `app\models\ProjectsAll`.
 */
class ProjectsFilterSearch extends ProjectsAll
{
    public $parent = null;
    public $course = null;
    public $childs = null;

    public function __construct(array $configs = [])
    {
        if (count($configs) > 0) {
            if (key_exists('parent', $configs)) {
                $this->parent = $configs['parent'];
            }
            if (key_exists('course', $configs)) {
                $this->course = $configs['course'];
            }
            if (key_exists('id', $configs)) {
                $this->childs = $configs['id'];
            }
        }
        parent::__construct($configs);
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'current_team_id', 'cursus_ids', 'puid', 'occurrence', 'project_id', 'parent_id'], 'integer'],
            [['xlogin', 'name', 'slug', 'status', 'pool_month', 'pool_year'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $where = [
            'projects_users.cursus_ids' => $this->course,
            'projects_users.parent_id' => $this->parent,
            'xlogins.visible' => 1,
        ];
        if ($this->childs) {
            $where = array_merge($where, ['projects_users.project_id' => $this->childs]);
        }
        $query = ProjectsAll::find()
            ->select([
                'projects_users.name',
                "AVG(CASE WHEN projects_users.validated='True' THEN projects_users.final_mark ELSE NULL END) as final_mark",
                "COUNT(CASE WHEN projects_users.status='finished' THEN 1 ELSE NULL END) as finished",
                "COUNT(CASE WHEN projects_users.validated='True' THEN 1 ELSE NULL END) as validated",
                "COUNT(CASE WHEN projects_users.validated='False' THEN 1 ELSE NULL END) as failed",
                "COUNT(CASE WHEN projects_users.status='in_progress' THEN 1 ELSE NULL END) as inprogress",
                "COUNT(CASE WHEN projects_users.status='searching_a_group' THEN 1 ELSE NULL END) as sag",
                "COUNT(CASE WHEN projects_users.status='waiting_for_correction' THEN 1 ELSE NULL END) as wfc",
                "COUNT(CASE WHEN projects_users.status='creating_group' THEN 1 ELSE NULL END) as cg",
                "projects_users.slug",
                "projects_users.name",
                "xlogins.pool_month",
            ])
            ->innerJoin('xlogins', 'xlogins.login = projects_users.xlogin')
            ->where($where)
            ->addGroupBy('projects_users.name')
        ;

        // add conditions that should always apply here
        $this->load($params);

        if ($this->pool_month) {
            $query->andWhere("xlogins.pool_month = '$this->pool_month'");
        }

        if ($this->pool_year) {
            $query->andWhere("xlogins.pool_year = '$this->pool_year'");
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => $this->getSort(),
            'pagination' => [
                'pageSize' => -1,
            ],
        ]);
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'name', $this->name]);
        return $dataProvider;
    }


    private function getSort()
    {
        return [
            'defaultOrder' => ['name' => SORT_ASC],
            'attributes' => [
                'name' => [
                    'asc' => ['name' => SORT_ASC],
                    'desc' => ['name' => SORT_DESC],
                ],
                'final_mark' => [
                    'asc' => ['final_mark' => SORT_ASC],
                    'desc' => ['final_mark' => SORT_DESC],
                ],
                'pool_year' => [
                    'asc' => ['pool_year' => SORT_ASC],
                    'desc' => ['pool_year' => SORT_DESC],
                ],
                'pool_month' => [
                    'asc' => ['pool_month' => SORT_ASC],
                    'desc' => ['pool_month' => SORT_DESC],
                ],
                'validated' => [
                    'asc' => ['validated' => SORT_ASC],
                    'desc' => ['validated' => SORT_DESC],
                ],
                'finished' => [
                    'asc' => ['finished' => SORT_ASC],
                    'desc' => ['finished' => SORT_DESC],
                ],
                'failed' => [
                    'asc' => ['failed' => SORT_ASC],
                    'desc' => ['failed' => SORT_DESC],
                ],
                'inprogress' => [
                    'asc' => ['inprogress' => SORT_ASC],
                    'desc' => ['inprogress' => SORT_DESC],
                ],
                'sag' => [
                    'asc' => ['sag' => SORT_ASC],
                    'desc' => ['sag' => SORT_DESC],
                ],
                'wfc' => [
                    'asc' => ['wfc' => SORT_ASC],
                    'desc' => ['wfc' => SORT_DESC],
                ],
                'cg' => [
                    'asc' => ['cg' => SORT_ASC],
                    'desc' => ['cg' => SORT_DESC],
                ],
            ]
        ];
    }
}
