<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reservation".
 *
 * @property int $id
 * @property int $room_id
 * @property int $customer_id
 * @property float $price
 * @property string $date_from
 * @property string $date_to
 * @property string $reservation_date
 *
 * @property Customer $customer
 * @property Room $room
 */
class Reservation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reservation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['room_id', 'customer_id', 'price', 'date_from', 'date_to'], 'required'],
            [['room_id', 'customer_id'], 'default', 'value' => null],
            [['room_id', 'customer_id'], 'integer'],
            [['price'], 'number'],
            [['date_from', 'date_to', 'reservation_date'], 'safe'],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
            [['room_id'], 'exist', 'skipOnError' => true, 'targetClass' => Room::className(), 'targetAttribute' => ['room_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'room_id' => 'Room ID',
            'customer_id' => 'Customer ID',
            'price' => 'Price',
            'date_from' => 'Date From',
            'date_to' => 'Date To',
            'reservation_date' => 'Reservation Date',
        ];
    }

    /**
     * Gets query for [[Customer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id'])->inverseOf('reservations');
    }

    /**
     * Gets query for [[Room]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRoom()
    {
        return $this->hasOne(Room::className(), ['id' => 'room_id'])->inverseOf('reservations');
    }
}
