<?php

namespace app\controllers;

use yii\base\Model;
use app\models\Locations;
use yii\data\ActiveDataProvider;

/**
 * LocationsSearch represents the model behind the search form of `app\models\Locations`.
 * DELIMITER //
 * CREATE TRIGGER `locations_upd` BEFORE INSERT ON `locations`
 * FOR EACH ROW
 * BEGIN
 * SET NEW.date = SUBSTRING_INDEX(NEW.begin_at, ' ', 1);
 * SET NEW.how = (CASE WHEN NEW.end_at > 0 AND  LENGTH(NEW.xlogin) > 2  THEN TIMEDIFF (NEW.end_at, NEW.begin_at) ELSE 0
 * END); END// DELIMITER ;
 */
class LocationsSearch extends Locations
{
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
            [['id', 'lid', 'campus_id', 'user_id'], 'integer'],
            [['host', 'begin_at', 'end_at', 'xlogin', 'date', 'dateStart', 'dateEnd', 'how'], 'safe'],
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
        $query = Locations::find()
            ->where(['xlogin' => $this->login])
            ->andWhere('end_at > 0');

        $this->load($params);
        // add conditions that should always apply here
        if (isset($this->dateStart) && isset($this->dateEnd)) {
            $query->andWhere(['between', 'date', $this->dateStart, $this->dateEnd]);
        }

        // add conditions that should always apply here

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
            'lid' => $this->lid,
            'campus_id' => $this->campus_id,
            'begin_at' => $this->begin_at,
            'end_at' => $this->end_at,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'host', $this->host])
            ->andFilterWhere(['like', 'xlogin', $this->xlogin]);

        return $dataProvider;
    }
}
