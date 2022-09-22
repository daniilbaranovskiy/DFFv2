<?php

namespace app\modules\user\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $created_at
 * @property string $updated_at
 * @property int $qty
 * @property float $sum
 * @property string $status
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $address
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    public function getOrderItems() {
        return $this->hasMany(OrderItems::className(), ['order_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'qty'], 'integer'],
            [['created_at', 'updated_at', 'qty', 'sum', 'status', 'name', 'email', 'phone', 'address'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['sum'], 'number'],
            [['status'], 'string'],
            [['name', 'email', 'phone', 'address'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Номер замовлення',
            'user_id' => 'Номер користувача',
            'created_at' => 'Дата створення',
            'updated_at' => 'Дата зміни',
            'qty' => 'Кількість',
            'sum' => 'Сума',
            'status' => 'Статус',
            'name' => 'Ім`я',
            'email' => 'E-mail',
            'phone' => 'Телефон',
            'address' => 'Адреса',
        ];
    }
}
