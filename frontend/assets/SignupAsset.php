<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main main application asset bundle.
 */
class SignupAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
      'css/plugins.css',
      'css/signup/register.css',
    ];
    public $js = [

          'js/signup/jquery.2.1.3.js',
          'js/signup/jquery.easing.min.js',
          'js/signup/bootstrap.min.js',
          'js/signup/scripts.js',
          'js/signup/register.js',

    ];


    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
