<?php

namespace vuelte\vue\assets;

use Yii;
use yii\web\View;
use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class VueAsset extends AssetBundle
{
    public $sourcePath = __DIR__.'/../static/vue';
    public $css = [];
    public $js = [
        'vue.js',
        'vuex.js',
    ];
    public $jsOptions = [
        'position' => \yii\web\View::POS_HEAD
    ];
    public $cssOptions = [
        'position' => \yii\web\View::POS_HEAD
    ];
    public $depends = [
        'vuelte\vue\assets\VueYiiAsset',
    ];
}