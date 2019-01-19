<?php

namespace app\controllers;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Minus42;

/**
 * Minus42Search represents the model behind the search form of `app\models\Minus42`.
 */
class Minus42Search extends Minus42
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'puid'], 'integer'],
            [['xlogin', 'updated_at'], 'safe'],
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
        $query = Minus42::find();

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
            'puid' => $this->puid,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'xlogin', $this->xlogin]);

        return $dataProvider;
    }
}
