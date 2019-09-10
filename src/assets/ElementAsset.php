<?php

namespace yiilte\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class ElementAsset extends AssetBundle
{
    public $sourcePath = __DIR__.'/../static/element';
    public $css = [
        //'https://unpkg.com/element-ui/lib/theme-chalk/index.css',
        'theme-chalk/index.css'
    ];
    public $js = [
        //'https://unpkg.com/element-ui/lib/index.js',
        'index.js'
    ];
    public $jsOptions = [
        'position' => \yii\web\View::POS_HEAD
    ];
    public $cssOptions = [
        'position' => \yii\web\View::POS_HEAD
    ];
    public $depends = [
        'yiivue\assets\VueAsset'
    ];
}