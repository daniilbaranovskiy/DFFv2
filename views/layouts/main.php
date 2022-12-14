<?php

/** @var yii\web\View $this */

/** @var string $content */

use app\assets\AppAsset;
use app\assets\ltAppAsset;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\helpers\Url;

AppAsset::register($this);
ltAppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="shortcut icon" href="/web/images/ico/favicon.png">
</head>
<body class="d-flex flex-column min-vh-100">
<?php $this->beginBody() ?>
<header id="header">
    <div class="header_top">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="/"><i class="fa fa-phone"></i> +380961610434</a></li>
                            <li><a href="/"><i class="fa fa-envelope"></i> daniilbaranovskiy03@gmail.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav">
                            <li><a target="_blank" href="https://www.facebook.com/profile.php?id=100046113170837"><i
                                            class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a target="_blank" href="https://www.instagram.com/daniil_baranovskiy/"><i
                                            class="fa fa-instagram" aria-hidden="true"></i></a></li>
                            <li><a target="_blank" href="https://www.youtube.com/channel/UCEO7Gc-kvrxHGDHJLQRbWIA"><i
                                            class="fa fa-youtube" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-middle">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href="<?= \yii\helpers\Url::home(); ?>"><h1>DFF</h1></a>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar">
                            <?php if (Yii::$app->user->isGuest): ?>
                                <li><a href="<?= Url::to(['/site/register']) ?>"><i class="fa fa-user-plus"></i>
                                        ????????????????????</a></li>
                                <li><a href="<?= Url::to(['/site/login']) ?>"><i class="fa fa-sign-in"></i> ????????</a>
                                </li>
                            <?php elseif (!Yii::$app->user->isGuest): ?>
                                <li><a href="<?= Url::to(['/account']) ?>"><i class="fa fa-user"></i> ????????????</a></li>
                                <li><a href="<?= Url::to(['/site/logout']) ?>"><i class="fa fa-sign-in"></i> ??????????</a>
                                </li>
                            <?php endif; ?>
                            <li><a href="#" onclick="getCart()"><i class="fa fa-shopping-cart"></i> ??????????</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom">
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            <li><a href="/">??????????????</a></li>
                            <li><a href="<?= Url::to(['menu/index']) ?>">????????</a></li>
                            <li><a href="<?= Url::to(['about/index']) ?>">?????? ??????</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="search_box pull-right">
                        <form method="get" action="<?= yii\helpers\Url::to(['/category/search']) ?>">
                            <input type="text" placeholder="??????????" name="q" autocomplete="off">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<?= $content ?>
<footer id="footer" class="mt-auto">
    <div class="container">
        <div class="footer-widget">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="single-widget">
                            <h4>
                                ????????????????
                            </h4>
                            <div class="contact_link_box">
                                <span> <i class="fa fa-map-marker" aria-hidden="true"></i> ?????????????? ??????. ???????????? ???????????????????????? 67 </span><br>
                                <span><i class="fa fa-phone" aria-hidden="true"></i> ?????????????? +380961610434  </span><br>
                                <span><i class="fa fa-envelope"
                                         aria-hidden="true"></i> daniilbaranovskiy03@gmail.com</span><br>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="single-widget">
                            <h4>
                                DFF
                            </h4>
                            <span>
                    ?????????????????? ???????????????? ???????????? ??????????
                </span><br>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="single-widget">
                            <h4>
                                ???????? ????????????
                            </h4>
                            <span>
                    ?????????????? ??????
                </span><br>
                            <span>
                    10.00-23.00
                </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<?php
\yii\bootstrap4\Modal::begin([
    'title' => '<h2>??????????</h2>',
    'id' => 'cart',
    'size' => 'modal-xl',
    'footer' => '<button type="button" class="btn btn-default" data-dismiss="modal">???????????????????? ??????????????</button>
     <a href="' . Url::to(['cart/view']) . '" class="btn btn-success" >???????????????? ????????????????????</a>
                 <button type="button" class="btn btn-danger" onclick="clearCart()">???????????????? ??????????????</button>'
]);
\yii\bootstrap4\Modal::end();
?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
