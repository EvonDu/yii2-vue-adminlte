<?php

namespace vuelte\assets;

use yii\helpers\ArrayHelper;
use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class ElementAsset extends AssetBundle
{
    public $sourcePath = __DIR__.'/../resource/element';
    public $css = [
        'https://unpkg.com/element-ui/lib/theme-chalk/index.css',
        //'element.min.css'
    ];
    public $js = [
        'https://unpkg.com/element-ui/lib/index.js',
        //'element.min.js'
    ];
    public $jsOptions = [
        'position' => \yii\web\View::POS_HEAD
    ];
    public $cssOptions = [
        'position' => \yii\web\View::POS_HEAD
    ];
    public $depends = [
        'vuelte\assets\VueAsset'
    ];
}