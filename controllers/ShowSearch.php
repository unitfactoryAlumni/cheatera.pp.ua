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
            [['displayname', 'email', 'location', 'login', 'phone', 'pool_month', 'lastloc'], 'safe'],
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
                'cursus_users.level'
            ])
            ->innerJoin('cursus_users','cursus_users.xlogin = xlogins.login')
            ->where([
                'visible' => 1,
                'cursus_users.name' => $course,
                ])
            ->orderBy('cursus_users.level DESC');
        ;

        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->sort->attributes['level'] = [
            'asc' => ['cursus_users.level' => SORT_ASC],
            'desc' => ['cursus_users.level' => SORT_DESC],];
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
//            $query->where('0=1');
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
            'visible' => $this->visible,
            'cursus_users.level' => $this->level
        ]);

        $query->andFilterWhere(['like', 'displayname', $this->displayname])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'login', $this->login])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'pool_month', $this->pool_month])
            ->andFilterWhere(['like', 'staff', $this->staff])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'correction_point', $this->correction_point]);

        return $dataProvider;
    }
}
