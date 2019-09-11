<?php

namespace yiilte\assets;

use yii\web\AssetBundle;

/**
 * 版本2.4.3
 */
class JQueryUiAsset extends AssetBundle
{
    //参数
    public $sourcePath = __DIR__.'/../static/jquery-ui';
    public $css = [
        'jquery-ui.min.css'
    ];
    public $js = [
        'jquery-ui.min.js'
    ];
    public $jsOptions = [
        'position' => \yii\web\View::POS_HEAD
    ];
    public $cssOptions = [
        'position' => \yii\web\View::POS_HEAD
    ];

    //定义资源包的依赖
    public $depends = [
        'yii\web\JqueryAsset',                  //依赖jquery
    ];
}