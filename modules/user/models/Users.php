<?php

namespace app\modules\user\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $firstname
 * @property string $lastname
 * @property string $number
 * @property string $city
 * @property string|null $role
 * @property string|null $auth_key
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password', 'firstname', 'lastname', 'number', 'city'], 'required'],
            [['username', 'password', 'firstname', 'lastname', 'number', 'city', 'role', 'auth_key'], 'string', 'max' => 255],
            ['username','unique','message'=>'Користувач з таким логіном вже існує']

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Номер користувача',
            'username' => 'Логін',
            'password' => 'Пароль',
            'firstname' => 'Ім`я',
            'lastname' => 'Прізвище',
            'number' => 'Телефон',
            'city' => 'Місто',
            'role' => 'Роль',
            'auth_key' => 'Ключ авторизації',
        ];
    }
}
