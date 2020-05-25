<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuarios".
 *
 * @property int $id
 * @property string $alias
 * @property string $password
 * @property string|null $auth_key
 * @property string|null $telefono
 * @property string|null $email
 */
class Usuarios extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuarios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alias', 'password'], 'required'],
            [['alias', 'auth_key', 'telefono', 'email'], 'string', 'max' => 255],
            [['password'], 'string', 'max' => 60],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'alias' => 'Alias',
            'password' => 'Password',
            'auth_key' => 'Auth Key',
            'telefono' => 'Telefono',
            'email' => 'Email',
        ];
    }
}
