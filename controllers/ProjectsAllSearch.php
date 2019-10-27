<?php

namespace app\controllers;

use yii\base\Model;
use app\models\ProjectsAll;
use yii\data\ActiveDataProvider;

/**
 * ProjectsAllSearch represents the model behind the search form of `app\models\ProjectsAll`.
 */
class ProjectsAllSearch extends ProjectsAll
{
    protected $course;

    protected $projectSlug;

    protected $team = null;

    public function __construct($searchCourse, $searchSlug, $team)
    {
        $this->course = $searchCourse;
        $this->projectSlug = $searchSlug;
        if ($team > 0) {
            $this->team = $team;
        }
        parent::__construct();
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'current_team_id', 'cursus_ids', 'final_mark', 'puid', 'occurrence', 'project_id', 'parent_id'],
                'integer'],
            [['xlogin', 'name', 'slug', 'status', 'validated', 'pool_year', 'pool_month'], 'safe'],
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
            'cursus_ids' => $this->course,
            'slug' => $this->projectSlug,
        ];
        if ($this->team) {
            $where['current_team_id'] = $this->team;
        }
        $query = ProjectsAll::find()
            ->select([
                'projects_users.*',
                'xlogins.*',
            ])
            ->innerJoin('xlogins', 'projects_users.xlogin = xlogins.login')
            ->where($where);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 42,
            ],
            'sort' => ['defaultOrder' => [
                'final_mark' => SORT_DESC,
                'xlogin' => SORT_ASC,
            ]],
        ]);
        $dataProvider->sort->attributes['location'] = [
            'asc' => ['xlogins.location' => SORT_ASC],
            'desc' => ['xlogins.location' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['lastloc'] = [
            'asc' => ['xlogins.lastloc' => SORT_ASC],
            'desc' => ['xlogins.lastloc' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'current_team_id' => $this->current_team_id,
            'cursus_ids' => $this->cursus_ids,
            'final_mark' => $this->final_mark,
            'puid' => $this->puid,
            'occurrence' => $this->occurrence,
            'project_id' => $this->project_id,
            'parent_id' => $this->parent_id,
            'pool_year' => $this->pool_year,
            'pool_month' => $this->pool_month,
        ]);

        $query->andFilterWhere(['like', 'xlogin', $this->xlogin])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'validated', $this->validated]);

        return $dataProvider;
    }
}
