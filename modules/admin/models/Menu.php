<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "menu".
 *
 * @property int $id
 * @property int $category_id
 * @property string $name
 * @property string|null $content
 * @property float|null $price
 * @property string|null $keywords
 * @property string|null $description
 * @property string|null $img
 * @property string $hit
 * @property string $new
 * @property string $sale
 */
class Menu extends \yii\db\ActiveRecord
{
    public $image;

    public function behaviors()
    {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'menu';
    }

    public function getCategory() {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'name', 'hit', 'new', 'sale'], 'required'],
            [['category_id'], 'integer'],
            [['content', 'hit', 'new', 'sale'], 'string'],
            [['price'], 'number'],
            [['name', 'keywords', 'description'], 'string', 'max' => 255],
            [['image'], 'file', 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID страви',
            'category_id' => 'Категорія',
            'name' => 'Назва',
            'content' => 'Опис',
            'price' => 'Цінка',
            'keywords' => 'Ключові слова',
            'description' => 'Мета-опис',
            'image' => 'Картинка',
            'hit' => 'Хіт',
            'new' => 'Новинка',
            'sale' => 'Розпродаж',
        ];
    }
    public function upload() {
        if($this->validate()){
            $path = 'upload/store' . $this->image->baseName . '.' . $this->image->extension;
            $this->image->saveAs($path);
            $this->attachImage($path);
            @unlink($path);
            return true;
        }else{
            return false;
        }
    }
}
