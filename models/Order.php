<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\BaseActiveRecord;
use yii\db\Expression;


class Order extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'orders';
    }

    public function getOrderItems() {
        return $this->hasMany(OrderItems::className(), ['order_id' => 'id']);
    }

    public function behaviors() {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    BaseActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    BaseActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public function rules()
    {
        return [
            [['name', 'email', 'phone', 'address'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['qty'], 'integer'],
            [['sum'], 'number'],
            [['status'], 'boolean'],
            [['name', 'email', 'phone', 'address'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'І`мя',
            'email' => 'E-mail',
            'phone' => 'Телефон',
            'address' => 'Адреса',
        ];
    }
}
