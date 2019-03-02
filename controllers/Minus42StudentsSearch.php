<?php

namespace app\controllers;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Minus42;

/**
 * Minus42StudentsSearch represents the model behind the search form of `app\models\Minus42`.
 */
class Minus42StudentsSearch extends Minus42
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'puid'], 'integer'],
            [['xlogin', 'updated_at', 'pool_year', 'pool_month', 'name'], 'safe'],
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
        $query = Minus42::find()
            ->select([
                'm42.*',
                'xlogins.*',
                'projects_users.name',
                'projects_users.slug',
            ])
            ->innerJoin('projects_users','projects_users.project_id = m42.puid')
            ->innerJoin('xlogins','m42.xlogin = xlogins.login')
            ->andWhere('m42.xlogin = projects_users.xlogin and projects_users.cursus_ids=1')
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
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'xlogin', $this->xlogin])
         ->andFilterWhere(['like', 'name', $this->name])
         ->andFilterWhere(['like', 'pool_year', $this->pool_year])
         ->andFilterWhere(['like', 'pool_month', $this->pool_month]);

        return $dataProvider;
    }

    private function getSort()
    {
        return [
            'defaultOrder' => ['updated_at' => SORT_DESC],
            'attributes' => [
                'updated_at' => [
                    'asc' => ['updated_at' => SORT_ASC],
                    'desc' => ['updated_at' => SORT_DESC],
                ],
                'xlogin' => [
                    'asc' => ['xlogin' => SORT_ASC],
                    'desc' => ['xlogin' => SORT_DESC],
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
                'name' => [
                    'asc' => ['name' => SORT_ASC],
                    'desc' => ['name' => SORT_DESC],
                ]
            ]
        ];
    }
}
