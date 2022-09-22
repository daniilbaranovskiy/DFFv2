<?php

namespace app\modules\user\models;

use Yii;

/**
 * This is the model class for table "orderItems".
 *
 * @property int $id
 * @property int $order_id
 * @property int $dish_id
 * @property string $name
 * @property float $price
 * @property int $qty_item
 * @property float $sum_item
 */
class OrderItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_items';
    }

    public function getOrder() {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'dish_id', 'name', 'price', 'qty_item', 'sum_item'], 'required'],
            [['order_id', 'dish_id', 'qty_item'], 'integer'],
            [['price', 'sum_item'], 'number'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Номер',
            'order_id' => 'Номер замовлення',
            'dish_id' => 'Номер страви',
            'name' => 'Назва',
            'price' => 'Ціна',
            'qty_item' => 'Кідлькість страв',
            'sum_item' => 'Сумма',
        ];
    }
}
