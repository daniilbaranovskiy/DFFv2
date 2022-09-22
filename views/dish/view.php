<?php

use yii\widgets\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;

?>
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
            <?php $mainImg = $dish->getImage(); ?>
            <div class="col-sm-9 padding-right">
                <div class="dish-details">
                    <div class="col-sm-5">
                        <div class="view-dish">
                            <?= Html::img($mainImg->getUrl(), ['alt' => [$dish->name],'height' => 280]); ?>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="dish-information">
                            <?php if ($dish->new): ?>
                                <?= Html::img("@web/images/home/new.png", ['alt' => 'Новинка', 'class' => 'new']) ?>
                            <?php endif; ?>
                            <?php if ($dish->sale): ?>
                                <?= Html::img("@web/images/home/sale.png", ['alt' => 'Распродажа', 'class' => 'new']) ?>
                            <?php endif; ?>
                            <h2><?= $dish->name ?></h2>
                            <p>ID: <?= $dish->id ?></p>
                            <span>
									<span><?= $dish->price ?> грн</span>
									<label>Кількість:</label>
									<input type="text" value="1" id="qty"/>
                                 <a href="<?= yii\helpers\Url::to(['cart/add', 'id' => $dish->id]) ?>"
                                    data-id="<?= $dish->id ?>"
                                    class="btn btn-fefault add-to-cart cart">
										<i class="fa fa-shopping-cart"></i>
										В кошик
									</a>
								</span>
                            <p><b>Категорія:</b><a
                                        href="<?= yii\helpers\Url::to(['category/view', 'id' => $dish->category->id]) ?>"> <?= $dish->category->name ?></a>
                            </p>
                            <b>Опис:</b> <?= $dish->content ?>
                        </div>
                    </div>
                </div>
                <div class="recommended_items">
                    <h2 class="title text-center">Популярні товари</h2>
                    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <?php $count = count($hits);
                            $i = 0;
                            foreach ($hits as $hit): ?>
                                <?php if ($i % 3 == 0): ?>
                                    <div class="item <?php if ($i == 0) echo 'active' ?>">
                                <?php endif ?>
                                <?php $mainImg = $hit->getImage(); ?>
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <?= Html::img($mainImg->getUrl(), ['alt' => [$hit->name], 'height' => 200]); ?>
                                                <h2 style="color: #FE980F;"><?= $hit->price ?> грн</h2>
                                                <p>
                                                    <a href="<?= yii\helpers\Url::to(['dish/view', 'id' => $hit->id]) ?>"><?= $hit->name ?></a>
                                                </p>
                                                <button type="button" class="btn btn-default add-to-cart"><i
                                                            class="fa fa-shopping-cart"></i>В кошик
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php $i++;
                                if ($i % 3 == 0 || $i == $count): ?>
                                    </div>
                                <?php endif ?>
                            <?php endforeach; ?>
                        </div>
                        <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<br>
