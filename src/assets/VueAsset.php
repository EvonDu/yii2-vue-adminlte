<?php

namespace vuelte\assets;

use yii\helpers\ArrayHelper;
use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class VueAsset extends AssetBundle
{
    public $sourcePath = __DIR__.'/../resource/vue';
    public $css = [];
    public $js = [
        //'https://unpkg.com/vue/dist/vue.js',
        'vue.js',
        'https://unpkg.com/vuex@3.0.1/dist/vuex.js',
    ];
    public $jsOptions = [
        'position' => \yii\web\View::POS_HEAD
    ];
    public $cssOptions = [
        'position' => \yii\web\View::POS_HEAD
    ];
    public $depends = [];
}