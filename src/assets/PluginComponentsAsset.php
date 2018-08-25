<?php

namespace vuelte\assets;

use yii\helpers\ArrayHelper;
use yii\web\AssetBundle;

/**
 * 版本2.4.3
 */
class PluginComponentsAsset extends AssetBundle
{
    public $sourcePath = __DIR__.'/../components/plugins';
    public $css = [];
    public $js = [
        'bootstrap-switch.js',
        'summernote.js',
    ];
    public $jsOptions = [
        'position' => \yii\web\View::POS_HEAD
    ];
    public $cssOptions = [
        'position' => \yii\web\View::POS_HEAD
    ];
    public $depends = [
        'vuelte\assets\VueAsset',
        'vuelte\assets\PluginAsset',
    ];
}