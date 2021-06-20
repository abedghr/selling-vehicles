<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\UsedVehicle;

/**
 * UsedVehicleSearch represents the model behind the search form of `common\models\UsedVehicle`.
 */
class UsedVehicleSearch extends UsedVehicle
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['vehicle_id', 'city_id', 'mileage_id', 'vehicle_checking_id'], 'integer'],
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
        $query = UsedVehicle::find();

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
            'vehicle_id' => $this->vehicle_id,
            'city_id' => $this->city_id,
            'mileage_id' => $this->mileage_id,
            'vehicle_checking_id' => $this->vehicle_checking_id,
        ]);

        return $dataProvider;
    }
}
