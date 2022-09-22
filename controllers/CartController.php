<?php

namespace app\controllers;

use app\models\Cart;
use app\models\Menu;
use app\models\Order;
use app\models\User;
use app\models\OrderItems;
use Yii;


class CartController extends AppController
{

    public function actionAdd()
    {
        $id = Yii::$app->request->get('id');
        $qty = (int)Yii::$app->request->get('qty');
        $qty = !$qty ? 1 : $qty;
        $dish = Menu::findOne($id);
        if (empty($dish)) return false;
        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->addToCart($dish, $qty);
        if (!Yii::$app->request->isAjax) {
            return $this->redirect(Yii::$app->request->referrer);
        }
        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }

    public function actionClear()
    {
        $session = Yii::$app->session;
        $session->open();
        $session->remove('cart');
        $session->remove('cart.qty');
        $session->remove('cart.sum');
        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }

    public function actionDelItem()
    {
        $id = Yii::$app->request->get('id');
        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->recalc($id);
        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }

    public function actionShow()
    {
        $session = Yii::$app->session;
        $session->open();
        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }

    public function actionView()
    {
        $session = Yii::$app->session;
        $session->open();
        $this->setMeta('DFF | Кошик');
        $order = new Order();
        $user = User::find()->where(['id' => Yii::$app->user->getId()])->one();
        if ($order->load(Yii::$app->request->post())) {
            $order->qty = $session['cart.qty'];
            $order->sum = $session['cart.sum'];
            if (Yii::$app->user->isGuest) {
                $order->user_id = 0;
            } else {
                $order->user_id = Yii::$app->user->getId();
            }
            if ($order->save()) {
                $this->saveOrderItems($session['cart'], $order->id);
                Yii::$app->session->setFlash('success', 'Ваше замовлення прийняте. Менеджер скоро зв`яжеться з вами.');
                $session->remove('cart');
                $session->remove('cart.qty');
                $session->remove('cart.sum');
                return $this->refresh();
            } else {
                Yii::$app->session->setFlash('error', 'Помилка!');
            }
        }
        return $this->render('view', compact('session', 'order', 'user'));
    }

    protected function saveOrderItems($items, $order_id)
    {
        foreach ($items as $id => $item) {
            $order_items = new OrderItems();
            $order_items->order_id = $order_id;
            $order_items->dish_id = $id;
            $order_items->name = $item['name'];
            $order_items->price = $item['price'];
            $order_items->qty_item = $item['qty'];
            $order_items->sum_item = $item['qty'] * $item['price'];
            $order_items->save();
        }
    }
}