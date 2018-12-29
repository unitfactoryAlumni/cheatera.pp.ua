<?php
/**
 * Created by PhpStorm.
 * User: omentes
 * Date: 12/28/18
 * Time: 10:18 PM
 */

namespace app\models;


use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * @property mixed pool_month
 * @property mixed pool_year
 */
class ShowSearch extends Show
{
    public function rules()
    {
        // только поля определенные в rules() будут доступны для поиска
        return [
            [['pool_year', 'pool_month'], 'string'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Show::find()->where(['needupd' => 1]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // загружаем данные формы поиска и производим валидацию
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        // изменяем запрос добавляя в его фильтрацию
        $query->where(['needupd' => 1])
            ->andFilterWhere(['like', 'pool_year', $this->pool_year])
            ->andFilterWhere(['like', 'pool_month', $this->pool_month]);

        return $dataProvider;
    }
}