<?php

namespace app\models;

use Yii;


class OrderItems extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'order_items';
    }

    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }

    public function rules()
    {
        return [
            [['order_id', 'dish_id', 'name', 'price', 'qty_item', 'sum_item'], 'required'],
            [['order_id', 'dish_id', 'qty_item'], 'integer'],
            [['price', 'sum_item'], 'number'],
            [['name'], 'string', 'max' => 255],
        ];
    }
}
