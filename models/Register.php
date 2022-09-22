<?php

namespace app\models;

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
 * @property string $role
 * @property string $auth_key
 */
class Register extends \yii\db\ActiveRecord
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
            [['username', 'password', 'firstname', 'lastname', 'number', 'city'], 'string', 'max' => 255],
            ['username','unique','message'=>'Користувач з таким логіном вже існує']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Логін',
            'password' => 'Пароль',
            'firstname' => 'І`мя',
            'lastname' => 'Прізвище',
            'number' => 'Телефон',
            'city' => 'Місто',
        ];
    }
}
