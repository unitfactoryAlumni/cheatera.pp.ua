<?php

namespace app\controllers;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Show;

/**
 * ShowSearch represents the model behind the search form of `app\models\Show`.
 * @property mixed level
 */
class ShowSearch extends Show
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'xid', 'pool_year', 'kick', 'needupd', 'visible'], 'integer'],
            [['lasthours'], 'number'],
            [['displayname', 'location', 'login', 'phone', 'pool_month', 'pool_year', 'location', 'lastloc'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     * @param string $course
     * @return ActiveDataProvider
     */
    public function search($params, $course)
    {

        $query = Show::find()
            ->select([
                'xlogins.*',
                'cursus_users.*'
            ])
            ->innerJoin('cursus_users','cursus_users.xlogin = xlogins.login')
            ->where([
                'xlogins.visible' => 1,
                'cursus_users.name' => $course,
                ]);

        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => $this->getSort()
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
//            $query->where('0=1');
            return $dataProvider;
        }

        // for sort
        $query->andFilterWhere(['like', 'displayname', $this->displayname])
            ->andFilterWhere(['like', 'login', $this->login])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'pool_month', $this->pool_month])
            ->andFilterWhere(['like', 'pool_year', $this->pool_year])
            ->andFilterWhere(['like', 'location', $this->location])
            ->andFilterWhere(['like', 'lastloc', $this->lastloc]);
        return $dataProvider;
    }

    private function getSort()
    {
        return [
            'defaultOrder' => [
                'level' => SORT_DESC,
            ],
            'attributes' => [
                'login' => [
                    'asc' => ['login' => SORT_ASC],
                    'desc' => ['login' => SORT_DESC],
                ],
                'displayname' => [
                    'asc' => ['displayname' => SORT_ASC],
                    'desc' => ['displayname' => SORT_DESC],
                ],
                'phone' => [
                    'asc' => ['phone' => SORT_ASC],
                    'desc' => ['phone' => SORT_DESC],
                ],
                'level' => [
                    'asc' => ['level' => SORT_ASC],
                    'desc' => ['level' => SORT_DESC],
                ],
                'correction_point' => [
                    'asc' => ['correction_point' => SORT_ASC],
                    'desc' => ['correction_point' => SORT_DESC],
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
                'wallet' => [
                    'asc' => ['wallet' => SORT_ASC],
                    'desc' => ['wallet' => SORT_DESC],
                ],
                'howach' => [
                    'asc' => ['howach' => SORT_ASC],
                    'desc' => ['howach' => SORT_DESC],
                ],
                'hours' => [
                    'asc' => ['hours' => SORT_ASC],
                    'desc' => ['hours' => SORT_DESC],
                ]
            ]
        ];
    }

}
