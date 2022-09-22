<?php

namespace app\models;

use yii\db\ActiveRecord;

class Menu extends ActiveRecord
{
    public function behaviors()
    {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }
    public static function tableName()
    {
        return 'menu';
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

}