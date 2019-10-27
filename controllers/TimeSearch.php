<?php

namespace app\controllers;

use yii\base\Model;
use app\models\TimeInCluster;
use yii\data\ActiveDataProvider;

/**
 * TimeSearch represents the model behind the search form of `app\models\TimeInCluster`.
 */
class TimeSearch extends TimeInCluster
{
    public $login;

    public $dateStart = null;

    public $dateEnd = null;

    public function __construct($login, array $configs = [])
    {
        $this->login = $login;
        parent::__construct($configs);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['xlogin', 'oneday', 'dateStart', 'dateEnd', 'timer'], 'safe'],
            [['timer'], 'number'],
        ];
    }
    /**
     * SELECT *,
     * SUBSTRING_INDEX(begin_at, ' ', 1) as begin_at_,
     * TIMEDIFF (end_at, begin_at) as how
     * FROM `locations`
     * WHERE end_at > 0 AND xlogin = "apakhomo"
     * ORDER BY `begin_at_`  ASC
     */
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
        $query = TimeInCluster::find()
            ->select([
                'xlogin',
                'xlogin',
                "SUBSTRING_INDEX(begin_at, ' ', 1) as date",
                'TIMEDIFF (end_at, begin_at) as how',
            ])
            ->where(['xlogin' => $this->login])
            ->andWhere('end_at > 0');

        $this->load($params);
        // add conditions that should always apply here
        if (isset($this->dateStart) && isset($this->dateEnd)) {
            $query->andWhere(['between', 'date', $this->dateStart, $this->dateEnd]);
        }


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ],
            ],
            'pagination' => [
                'pageSize' => -1,
            ],
        ]);


        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'oneday' => $this->oneday,
            'timer' => $this->timer,
        ]);

        $query->andFilterWhere(['like', 'xlogin', $this->xlogin]);

        return $dataProvider;
    }
}
