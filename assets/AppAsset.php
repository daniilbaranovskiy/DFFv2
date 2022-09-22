<?php

namespace app\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        "/web/css/mainStyle.css",
        "/web/css/bootstrap.min.css",
        "/web/css/font-awesome.min.css",
        "/web/css/prettyPhoto.css",
        "/web/css/animate.css",
        "/web/css/responsive.css"
    ];
    public $js = [
        '/web/js/jquery.js',
        '/web/js/bootstrap.min.js',
        '/web/js/jquery.scrollUp.min.js',
        '/web/js/jquery.prettyPhoto.js',
        '/web/js/jquery.cookie.js',
        '/web/js/jquery.accordion.js',
        '/web/js/main.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapPluginAsset',
    ];
}
