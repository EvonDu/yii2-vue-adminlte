<?php

namespace vuelte\assets;

use yii\helpers\ArrayHelper;
use yii\web\AssetBundle;

/**
 * 版本2.4.3
 */
class PluginAsset extends AssetBundle
{
    //参数
    public $sourcePath = __DIR__.'/../resource/plugins';

    //定义资源包的css
    public $css = [
        'bootstrap-switch/css/bootstrap3/bootstrap-switch.min.css',
    ];

    //定义资源包的js
    public $js = [
        'bootstrap-switch/js/bootstrap-switch.min.js',
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
        'vuelte\assets\AdminLteAsset',   //依赖AdminLteAsset
    ];
}