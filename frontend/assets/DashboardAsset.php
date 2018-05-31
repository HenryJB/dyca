<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class DashboardAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/font-face.css',
        'vendor/font-awesome-4.7/css/font-awesome.min.css',
        'vendor/font-awesome-5/css/fontawesome-all.min.css',
        'vendor/mdi-font/css/material-design-iconic-font.min.css',
        'vendor/bootstrap-4.1/bootstrap.min.css',
        'vendor/animsition/animsition.min.css',
        'vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css',
        'vendor/wow/animate.css',
        'vendor/css-hamburgers/hamburgers.min.css',
        'vendor/slick/slick.css',
        'vendor/select2/select2.min.css',
        'vendor/perfect-scrollbar/perfect-scrollbar.css',
        'css/theme.css',
        'css/extra-styles.css',
    ];
    public $js = [
        'vendor/jquery-3.2.1.min.js',
        'vendor/bootstrap-4.1/popper.min.js',
        'vendor/bootstrap-4.1/bootstrap.min.js',
        'vendor/slick/slick.min.js',
        'vendor/wow/wow.min.js',
        'vendor/animsition/animsition.min.js',
        'vendor/bootstrap-progressbar/bootstrap-progressbar.min.js',
        'vendor/counter-up/jquery.waypoints.min.js',
        'vendor/counter-up/jquery.counterup.min.js',
        'vendor/circle-progress/circle-progress.min.js',
        'vendor/perfect-scrollbar/perfect-scrollbar.js',
        'vendor/chartjs/Chart.bundle.min.js',
        'vendor/select2/select2.min.js',
        'js/main.js',
        'js/custom-scripts.js',
    ];
    public $depends = [
        //'yii\web\YiiAsset',
      //  'yii\bootstrap\BootstrapAsset',
    ];
}