<?php

namespace app\controllers;

use yii\base\Model;
use app\models\CorrectionLog;
use yii\data\ActiveDataProvider;

/**
 * CorrectionLogSearch represents the model behind the search form of `app\models\CorrectionLog`.
 */
class CorrectionsSearch extends CorrectionLog
{
    public $dateStart = null;

    public $dateEnd = null;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'count'], 'integer'],
            [['date', 'dateStart', 'dateEnd'], 'safe'],
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
        $query = CorrectionLog::find();

        // add conditions that should always apply here

        $this->load($params);

        if (isset($this->dateStart) && isset($this->dateEnd)) {
            $query = CorrectionLog::find()
                ->where(['between', 'date', $this->dateStart, $this->dateEnd]);
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'date' => SORT_DESC,
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
            'id' => $this->id,
            'count' => $this->count,
            'date' => $this->date,
        ]);

        return $dataProvider;
    }
}
