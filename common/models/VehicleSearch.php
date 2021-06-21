<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Vehicle;

/**
 * VehicleSearch represents the model behind the search form of `common\models\Vehicle`.
 */
class VehicleSearch extends Vehicle
{
    public $user;
    public $make;
    public $model;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'make_id', 'model_id', 'color_id', 'body_type_id', 'gear_box_id', 'is_deleted'], 'integer'],
            [['title', 'title_en', 'price', 'description', 'description_en', 'main_image', 'type', 'user', 'make', 'model', 'status', 'manufacturing_year', 'created_at', 'updated_at'], 'safe'],
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
    public function search($params,$type = null)
    {
        $query = Vehicle::find();
        $query->joinWith([
            'make' => function ($q) {
                $q->select(['id', 'title', 'title_en']);
            },
            'model AS model_taxonomy' => function ($q) {
                $q->select(['id', 'title', 'title_en']);
            },
            'user'
        ]);
        if ($type == self::TYPE_NEW) {
            $query->where(['vehicle.type' => $type]);
            $query = $query->with([
                'user.company',
                'user.city',
                'newVehicle']);
        } if($type == self::TYPE_USED) {
            $query->where(['vehicle.type' => $type]);
            $query = $query->with([
                'user.individualUser','user.company', 'user.city',
                'usedVehicle']);
        }

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
            'color_id' => $this->color_id,
            'body_type_id' => $this->body_type_id,
            'gear_box_id' => $this->gear_box_id,
            'is_deleted' => $this->is_deleted,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'title_en', $this->title_en])
            ->andFilterWhere(['like', 'price', $this->price])
            ->andFilterWhere(['like', 'user.username', $this->user])
            ->andFilterWhere(['like', 'taxonomy.title_en', $this->make])
            ->andFilterWhere(['like', 'model_taxonomy.title_en', $this->model])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'description_en', $this->description_en])
            ->andFilterWhere(['like', 'main_image', $this->main_image])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'manufacturing_year', $this->manufacturing_year]);

        return $dataProvider;
    }
}
