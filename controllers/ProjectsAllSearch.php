<?php

namespace app\controllers;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ProjectsAll;

/**
 * ProjectsAllSearch represents the model behind the search form of `app\models\ProjectsAll`.
 */
class ProjectsAllSearch extends ProjectsAll
{
    protected $course;

    protected $projectSlug;

    public function __construct($searchCourse, $searchSlug, array $config = [])
    {
        $this->course = $searchCourse;
        $this->projectSlug = $searchSlug;
        parent::__construct($config);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'current_team_id', 'cursus_ids', 'final_mark', 'puid', 'occurrence', 'project_id', 'parent_id'], 'integer'],
            [['xlogin', 'name', 'slug', 'status', 'validated'], 'safe'],
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
        $query = ProjectsAll::find()
            ->where([
                'cursus_ids' => $this->course,
                'slug' => $this->projectSlug
            ]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => [
                'final_mark' => SORT_DESC,
                'xlogin' => SORT_ASC
            ]]

        ]);

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
        ]);

        $query->andFilterWhere(['like', 'xlogin', $this->xlogin])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'validated', $this->validated]);

        return $dataProvider;
    }
}
