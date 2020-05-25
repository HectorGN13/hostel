<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "room".
 *
 * @property int $id
 * @property int $floor
 * @property int $room_number
 * @property bool $has_conditioner
 * @property bool $has_tv
 * @property bool $has_phone
 * @property string $available_from
 * @property float|null $price_per_night
 * @property string|null $description
 *
 * @property Reservation[] $reservations
 */
class Room extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'room';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['floor', 'room_number', 'has_conditioner', 'has_tv', 'has_phone', 'available_from'], 'required'],
            [['floor', 'room_number'], 'default', 'value' => null],
            [['floor', 'room_number'], 'integer'],
            [['has_conditioner', 'has_tv', 'has_phone'], 'boolean'],
            [['available_from'], 'safe'],
            [['price_per_night'], 'number'],
            [['description'], 'string'],
            [['room_number'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'floor' => 'Floor',
            'room_number' => 'Room Number',
            'has_conditioner' => 'Has Conditioner',
            'has_tv' => 'Has Tv',
            'has_phone' => 'Has Phone',
            'available_from' => 'Available From',
            'price_per_night' => 'Price Per Night',
            'description' => 'Description',
        ];
    }

    /**
     * Gets query for [[Reservations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReservations()
    {
        return $this->hasMany(Reservation::className(), ['room_id' => 'id'])->inverseOf('room');
    }
}
