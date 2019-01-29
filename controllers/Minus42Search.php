<?php

namespace app\controllers;

use app\models\ProjectsAll;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * Minus42Search represents the model behind the search form of `app\models\Minus42`.
 */
class Minus42Search extends ProjectsAll
{
    protected $course;

    /**
     * Minus42Search constructor.
     * @param $searchCourse
     */
    public function __construct($searchCourse)
    {
        $this->course = $searchCourse;
        parent::__construct();
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
            ->select([
                'projects_users.*',
            ])
            ->where([
                'cursus_ids' => $this->course,
            ])
            ->andWhere('final_mark < 0')
        ;

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'puid' => $this->puid,
            'name' => $this->name,
        ]);

        $query->andFilterWhere(['like', 'xlogin', $this->xlogin]);

        return $dataProvider;
    }
}
