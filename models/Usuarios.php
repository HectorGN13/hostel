<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

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
class Usuarios extends \yii\db\ActiveRecord implements IdentityInterface
{
    const SCENARIO_CREAR = 'crear';
    const SCENARIO_UPDATE = 'update';

    public $password_repeat;

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
            [['alias', 'password', 'password_repeat', 'email' ], 'required'],
            [['alias'], 'unique'],
            [['alias', 'auth_key', 'telefono', 'email'], 'string', 'max' => 255],
            [
                ['password'],
                'required',
                'on' => [self::SCENARIO_DEFAULT, self::SCENARIO_CREAR],
            ],
            [
                ['password'],
                'trim',
                'on' => [self::SCENARIO_CREAR, self::SCENARIO_UPDATE],
            ],
            [['password'], 'string', 'max' => 60],
            [
                ['password_repeat'],
                'required',
                'on' => [self::SCENARIO_CREAR, self::SCENARIO_UPDATE],
            ],
            [
                ['password_repeat'],
                'compare',
                'compareAttribute' => 'password',
                'skipOnEmpty' => false,
                'on' => [self::SCENARIO_CREAR, self::SCENARIO_UPDATE],
            ],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'alias' => 'Nombre de usuario',
            'password' => 'Password',
            'password_repeat' => 'Repetir contraseña',
            'auth_key' => 'Auth Key',
            'telefono' => 'Telefono',
            'email' => 'Email',
        ];
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    public static function findPorAlias($alias)
    {
        return static::findOne(['alias' => $alias]);
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    public function beforeSave($insert)
    {
        $security = Yii::$app->security;
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if ($insert) {
            if ($this->scenario === self::SCENARIO_CREAR) {
                //$security = Yii::$app->security;
                $this->auth_key = $security->generateRandomString();
                $this->password = $security->generatePasswordHash($this->password);
            }
        } else {
            if ($this->scenario === self::SCENARIO_UPDATE) {
                if ($this->password === '') {
                    $this->password = $this->getOldAttribute('password');
                } else {
                    $this->password = $security->generatePasswordHash($this->password);
                }
            }
        }

        return true;
    }
}
