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
            <div class="col-sm-9 padding-right">
                <?php if (!empty($dish)): ?>
                <div class="features_items">
                    <h2 class="title text-center">Результат пошуку: <?= Html::encode($q) ?> </h2>
                    <div class="row masonry" data-columns>
                        <?php foreach ($dish as $menu): ?>
                            <?php $mainImg = $menu->getImage(); ?>
                            <div class="col-sm-4">
                                <div class="dish-image-wrapper">
                                    <div class="single-products">
                                        <div class="dish text-center">
                                            <?= Html::img($mainImg->getUrl(), ['alt' => $menu->name]); ?>
                                            <h2><?= $menu->price ?> грн</h2>
                                            <p>
                                                <a href="<?= Url::to(['dish/view', 'id' => $menu->id]) ?>"><?= $menu->name ?></a>
                                            </p>
                                            <a href="#" data-id="<?= $menu->id ?>"
                                               class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>В кошик</a>
                                        </div>
                                        <?php if ($menu->new): ?>
                                            <?= Html::img("@web/images/home/new.png", ['alt' => 'Новинка', 'class' => 'new']) ?>
                                        <?php endif; ?>
                                        <?php if ($menu->sale): ?>
                                            <?= Html::img("@web/images/home/sale.png", ['alt' => 'Распродажа', 'class' => 'new']) ?>
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
                    </div>
                    <?php
                    echo LinkPager::widget(['pagination' => $pages]);
                    ?>
                    <?php else: ?>
                        <h2 class="title text-center"><?= $category->name ?></h2>
                        <h3>Нічого не знайдено</h3>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>