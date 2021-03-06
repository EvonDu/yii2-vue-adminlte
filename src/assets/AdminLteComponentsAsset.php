<?php

namespace yiilte\assets;

use yii\web\AssetBundle;

/**
 * 版本2.4.3
 */
class AdminLteComponentsAsset extends AssetBundle
{
    //参数
    public $sourcePath = __DIR__.'/../components';
    public $css = [];
    public $js = [
        'lte-components.js.php',
    ];
    public $jsOptions = [
        'position' => \yii\web\View::POS_HEAD
    ];

    //定义资源包的依赖
    public $depends = [
        'yiivue\assets\VueAsset',
        'yiilte\assets\AdminLteAsset',
        'yiilte\assets\JQueryUiAsset',
    ];
}