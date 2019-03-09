<?php

namespace app\controllers;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Correct;

/**
 * CorrectSearch represents the model behind the search form of `app\models\Correct`.
 */
class CorrectSearch extends Correct
{
    public $dateStart = null;
    public $dateEnd = null;

    public function __construct($login, array $configs = [])
    {
        $this->xlogin = $login;
        parent::__construct($configs);
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'corrections'], 'integer'],
            [['xlogin', 'date', 'corrections', 'dateStart', 'dateEnd'], 'safe'],
            [['level'], 'number'],
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
        $query = Correct::find();

        // add conditions that should always apply here

        $this->load($params);

        if (isset($this->dateStart) && isset($this->dateEnd)) {
            $query = Correct::find()
                ->where(['between', 'date', $this->dateStart, $this->dateEnd]);
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'date' => SORT_DESC
                ]
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
            'id' => $this->id,
            'corrections' => $this->corrections,
            'level' => $this->level,
            'date' => $this->date,
        ]);

        $query->andFilterWhere(['like', 'xlogin', $this->xlogin]);

        return $dataProvider;
    }
}
