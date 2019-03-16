<?php

namespace app\controllers;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Friend;

/**
 * FriendSearch represents the model behind the search form of `app\models\Friend`.
 */
class FriendSearch extends Friend
{
    public $who;

    /**
     * FriendSearch constructor.
     * @param $login
     */
    public function __construct($login)
    {
        $this->who = $login;
        parent::__construct();
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['mylogin', 'xlogin'], 'safe'],
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
        $query = Friend::find()
            ->select([
                'friends.*',
                'xlogins.*',
                'cursus_users.level'
            ])
            ->innerJoin('xlogins', 'xlogins.login = friends.xlogin')
            ->innerJoin('cursus_users', 'cursus_users.xlogin = friends.xlogin')
            ->where(['mylogin' => $this->who]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => -1,
            ],
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
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'mylogin', $this->mylogin])
            ->andFilterWhere(['like', 'xlogin', $this->xlogin]);

        return $dataProvider;
    }
}
