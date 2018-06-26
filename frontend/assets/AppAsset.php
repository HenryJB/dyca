<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css',
        'css/bootstrap.css',
        'css/mdb.css',
        'css/style.css'
    ];
    public $js = [
    "js/jquery-3.3.1.min.js",
    "js/popper.min.js",
    "js/bootstrap.min.js",
    "js/mdb.min.js",
    "js/script.js"
    ];
    public $depends = [
        //'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
