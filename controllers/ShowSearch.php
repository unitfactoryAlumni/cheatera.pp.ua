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
            [['displayname', 'location', 'login', 'phone', 'pool_month', 'pool_year', 'lastloc'], 'safe'],
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

            'sort' => [
                'defaultOrder' => [
                    'level' => SORT_DESC],
                'attributes' => [
                    'level' => [
                        'asc' => ['level' => SORT_ASC],
                        'desc' => ['level' => SORT_DESC]
                    ],
                ]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
//            $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions


        $query->andFilterWhere(['like', 'displayname', $this->displayname])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'login', $this->login])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'pool_month', $this->pool_month])
            ->andFilterWhere(['like', 'pool_year', $this->pool_year])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'correction_point', $this->correction_point]);

        return $dataProvider;
    }
}
