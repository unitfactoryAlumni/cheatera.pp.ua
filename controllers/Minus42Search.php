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
        $query = ProjectsAll::find()
            ->select([
                'projects_users.*',
                'xlogins.*',
            ])
            ->innerJoin('xlogins','projects_users.xlogin = xlogins.login')
            ->andWhere('final_mark < 0')
            ->andWhere("projects_users.cursus_ids = $this->course")
        ;

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => $this->getSort(),
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
            'pool_year' => $this->pool_year,
        ]);

        $query->andFilterWhere(['like', 'xlogin', $this->xlogin])
            ->andFilterWhere(['like', 'pool_year', $this->pool_year])
            ->andFilterWhere(['like', 'pool_month', $this->pool_month]);

        return $dataProvider;
    }


    private function getSort()
    {
        return [
            'defaultOrder' => ['puid' => SORT_DESC],
            'attributes' => [
                'name' => [
                    'asc' => ['name' => SORT_ASC],
                    'desc' => ['name' => SORT_DESC],
                ],
                'puid' => [
                    'asc' => ['puid' => SORT_ASC],
                    'desc' => ['puid' => SORT_DESC],
                ],
                'displayname' => [
                    'asc' => ['displayname' => SORT_ASC],
                    'desc' => ['displayname' => SORT_DESC],
                ],
                'level' => [
                    'asc' => ['level' => SORT_ASC],
                    'desc' => ['level' => SORT_DESC],
                ],
                'pool_year' => [
                    'asc' => ['pool_year' => SORT_ASC],
                    'desc' => ['pool_year' => SORT_DESC],
                ],
                'pool_month' => [
                    'asc' => ['pool_month' => SORT_ASC],
                    'desc' => ['pool_month' => SORT_DESC],
                ],
                'location' => [
                    'asc' => ['location' => SORT_ASC],
                    'desc' => ['location' => SORT_DESC],
                ],
                'lastloc' => [
                    'asc' => ['lastloc' => SORT_ASC],
                    'desc' => ['lastloc' => SORT_DESC],
                ],
                'final_mark' => [
                    'asc' => ['final_mark' => SORT_ASC],
                    'desc' => ['final_mark' => SORT_DESC],
                ]
            ]
        ];
    }

}
