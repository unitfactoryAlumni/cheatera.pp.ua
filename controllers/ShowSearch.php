<?php

namespace app\controllers;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Show;

/**
 * ShowSearch represents the model behind the search form of `app\models\Show`.
 */
class ShowSearch extends Show
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'correction_point', 'xid', 'pool_year', 'wallet', 'howach', 'kick', 'needupd', 'visible'], 'integer'],
            [['displayname', 'email', 'first_name', 'last_name', 'location', 'login', 'phone', 'pool_month', 'staff', 'url', 'lastloc'], 'safe'],
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
        $query = Show::find();

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
            'correction_point' => $this->correction_point,
            'xid' => $this->xid,
            'pool_year' => $this->pool_year,
            'wallet' => $this->wallet,
            'howach' => $this->howach,
            'kick' => $this->kick,
            'lastloc' => $this->lastloc,
            'needupd' => $this->needupd,
            'visible' => $this->visible,
        ]);

        $query->andFilterWhere(['like', 'displayname', $this->displayname])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'login', $this->login])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'pool_month', $this->pool_month])
            ->andFilterWhere(['like', 'staff', $this->staff])
            ->andFilterWhere(['like', 'url', $this->url]);

        return $dataProvider;
    }
}
