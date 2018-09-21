<?php

namespace vuelte\assets;

use yii\helpers\ArrayHelper;
use yii\web\AssetBundle;

/**
 * 版本2.4.3
 */
class AdminLteAsset extends AssetBundle
{
    //参数
    public $sourcePath = __DIR__.'/resource/adminlte';

    //定义资源包的css
    public $css = [
        'bower_components/font-awesome/css/font-awesome.min.css',
        'bower_components/Ionicons/css/ionicons.min.css',
        'css/AdminLTE.min.css',
        'css/skins/_all-skins.css',
    ];

    //定义资源包的js
    public $js = [
        'bower_components/jquery-slimscroll/jquery.slimscroll.min.js',
        'bower_components/fastclick/lib/fastclick.js',
        'js/adminlte.min.js',
        'js/demo.js',
    ];

    //定义加载选项
    public $jsOptions = [
        'position' => \yii\web\View::POS_HEAD
    ];

    //定义加载选项
    public $cssOptions = [
        'position' => \yii\web\View::POS_HEAD
    ];

    //定义资源包的依赖
    public $depends = [
        'yii\web\JqueryAsset',                  //依赖jquery
        'yii\bootstrap\BootstrapAsset',         //依赖Bootstrap
        'yii\bootstrap\BootstrapPluginAsset',   //依赖BootstrapJs
    ];
}