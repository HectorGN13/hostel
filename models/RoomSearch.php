<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Room;

/**
 * RoomSearch represents the model behind the search form of `app\models\Room`.
 */
class RoomSearch extends Room
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'floor', 'room_number'], 'integer'],
            [['has_conditioner', 'has_tv', 'has_phone'], 'boolean'],
            [['available_from', 'description'], 'safe'],
            [['price_per_night'], 'number'],
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
        $query = Room::find();

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
            'floor' => $this->floor,
            'room_number' => $this->room_number,
            'has_conditioner' => $this->has_conditioner,
            'has_tv' => $this->has_tv,
            'has_phone' => $this->has_phone,
            'available_from' => $this->available_from,
            'price_per_night' => $this->price_per_night,
        ]);

        $query->andFilterWhere(['ilike', 'description', $this->description]);

        return $dataProvider;
    }
}
