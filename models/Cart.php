<?php

namespace app\models;

use yii\base\Model;


class Cart extends Model
{

    public function addToCart($dish, $qty = 1)
    {
        $mainImg = $dish->getImage();
        if (isset($_SESSION['cart'][$dish->id])) {
            $_SESSION['cart'][$dish->id]['qty'] += $qty;
        } else {
            $_SESSION['cart'][$dish->id] = [
                'qty' => $qty,
                'name' => $dish->name,
                'price' => $dish->price,
                'img' => $mainImg->getUrl('x50')
            ];
        }
        $_SESSION['cart.qty'] = isset($_SESSION['cart.qty']) ? $_SESSION['cart.qty'] + $qty : $qty;
        $_SESSION['cart.sum'] = isset($_SESSION['cart.sum']) ? $_SESSION['cart.sum'] + $qty * $dish->price : $qty * $dish->price;
    }

    public function recalc($id)
    {
        if (!isset($_SESSION['cart'][$id])) return false;
        $qtyMinus = $_SESSION['cart'][$id]['qty'];
        $sumMinus = $_SESSION['cart'][$id]['qty'] * $_SESSION['cart'][$id]['price'];
        $_SESSION['cart.qty'] -= $qtyMinus;
        $_SESSION['cart.sum'] -= $sumMinus;
        unset($_SESSION['cart'][$id]);
    }

    public function behaviors()
    {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }
}