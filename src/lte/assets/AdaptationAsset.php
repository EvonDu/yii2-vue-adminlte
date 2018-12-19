<?php
namespace vuelte\lte\assets;

use yii\web\AssetBundle;

class AdaptationAsset extends AssetBundle {
    public $sourcePath = __DIR__.'/../static/adaptation';
    public $css = [];
    public $js = [
        'form-submit.js',
    ];
    public $jsOptions = [
        'position' => \yii\web\View::POS_HEAD
    ];
    public $cssOptions = [
        'position' => \yii\web\View::POS_HEAD
    ];
    public $depends = [];
}