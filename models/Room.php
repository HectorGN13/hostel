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
    private $_disponible = null;

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
            'floor' => 'Planta',
            'room_number' => 'Número de Hab.',
            'has_conditioner' => 'Aire acondicionado',
            'has_tv' => 'Televisión',
            'has_phone' => 'Teléfono',
            'available_from' => 'Disponible desde',
            'price_per_night' => 'Precio por noche',
            'description' => 'Descripción',
        ];
    }

    public function setDisponible($disponible)
    {
        $this->_disponible = $disponible;
    }

    public function getDisponible()
    {
        if ($this->_disponible === null && !$this->isNewRecord) {
            $this->setDisponible($this->estaDisponible());
        }
        return $this->_disponible;
    }

    public function estaDisponible()
    {
        $result = false;
        $fecha_actual = date('dd-mm-YYYY', time()) ;
        $fecha_disponible = $this->available_from;
        if ($fecha_disponible < $fecha_actual) {
            $result = true;
        }
        return $result;
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
