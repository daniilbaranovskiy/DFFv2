<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

?>
<section id="slider">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#slider-carousel" data-slide-to="1"></li>
                        <li data-target="#slider-carousel" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="item active">
                            <div class="col-sm-6">
                                <h1><span>D</span>FF</h1>
                                <h2>Найсмачніші бургери у нас</h2>
                                <p>Найсмачніша їжа швидкого приготування у вашому місті. Перевірена якість та доступна
                                    ціна.</p>
                                <button type="button" class="btn btn-default get">Перейти до меню</button>
                            </div>
                            <div class="col-sm-6">
                                <img src="/web/images/home/slider1.jpg" class="food img-responsive" alt=""/>
                            </div>
                        </div>
                        <div class="item">
                            <div class="col-sm-6">
                                <h1><span>D</span>FF</h1>
                                <h2>Піца доступна у меню</h2>
                                <p>Ми дбаємо про наших відвідувачів та слідкуємо за приготування кожної страви, а також
                                    за оформленням кожного замовлення.</p>
                                <button type="button" class="btn btn-default get">Перейти до меню</button>
                            </div>
                            <div class="col-sm-6">
                                <img src="/web/images/home/slider2.jpg" class="food img-responsive" alt=""/>
                            </div>
                        </div>

                        <div class="item">
                            <div class="col-sm-6">
                                <h1><span>D</span>FF</h1>
                                <h2>На решту візьміть картоплю</h2>
                                <p>Продукти, з яких виготовляються страви, пройшли термальну обробку та мають найвищий
                                    знак якості.</p>
                                <button type="button" class="btn btn-default get">Перейти до меню</button>
                            </div>
                            <div class="col-sm-6">
                                <img src="/web/images/home/slider3.jpg" class="food img-responsive" alt=""/>
                            </div>
                        </div>
                    </div>
                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Категорії</h2>
                    <ul class="catalog category-products">
                        <?= \app\components\MenuCategoryWidget::widget(['tpl' => 'menuCategory']) ?>
                    </ul>
                </div>
            </div>
            <div class="col-sm-9 padding-right">
                <?php if (!empty($hits)): ?>
                <div class="features_items">
                    <h2 class="title text-center">Популярні товари</h2>
                    <div class="row masonry" data-columns>
                        <?php foreach ($hits as $hit): ?>
                            <?php $mainImg = $hit->getImage(); ?>
                            <div class="col-sm-4">
                                <div class="dish-image-wrapper">
                                    <div class="single-products">
                                        <div class="dish text-center">
                                            <?= Html::img($mainImg->getUrl(), ['alt' => [$hit->name],'height' => 230]); ?>
                                            <h2><?= $hit->price ?> грн</h2>
                                            <p>
                                                <a href="<?= Url::to(['dish/view', 'id' => $hit->id]) ?>"><?= $hit->name ?></a>
                                            </p>
                                            <a href="<?= Url::to(['cart/add', 'id' => $hit->id]) ?>"
                                               data-id="<?= $hit->id ?>" class="btn btn-default add-to-cart"><i
                                                        class="fa fa-shopping-cart"></i>В кошик</a>
                                        </div>
                                        <?php if ($hit->new): ?>
                                            <?= Html::img("@web/images/home/new.png", ['alt' => 'Новинка', 'class' => 'new']) ?>
                                        <?php endif; ?>
                                        <?php if ($hit->sale): ?>
                                            <?= Html::img("@web/images/home/sale.png", ['alt' => 'Знижка', 'class' => 'new']) ?>
                                        <?php endif; ?>
                                    </div>
                                    <br>
                                </div>
                            </div>
                            <?php $i++ ?>
                            <?php if ($i % 3 == 0): ?>
                                <div class="clearfix"></div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <div class="clearfix"></div>
                        <?php endif; ?>
                    </div>
                    <?php
                    echo LinkPager::widget(['pagination' => $pages]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>