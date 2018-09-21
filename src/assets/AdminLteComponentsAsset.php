<?php

namespace vuelte\assets;

use yii\helpers\ArrayHelper;
use yii\web\AssetBundle;

/**
 * 版本2.4.3
 */
class AdminLteComponentsAsset extends AssetBundle
{
    //参数
    public $sourcePath = __DIR__.'/components';
    public $css = [];
    public $js = [
        'layout/lte-header.js',
        'layout/lte-footer.js',
        'layout/lte-sidebar.js',
        'layout/lte-sidebar-items.js',
        'layout/lte-sidebar-setting.js',
        'layout/lte-content-header.js',
        'layout/lte-content.js',
        'censoring/lte-row.js',
        'censoring/lte-col.js',
        'lte-box.js',
        'lte-btn.js',
        'lte-btn-group.js',
        'lte-nav.js',
        'lte-small-box.js',
    ];
    public $jsOptions = [
        'position' => \yii\web\View::POS_HEAD
    ];

    //定义资源包的依赖
    public $depends = [
        'vuelte\assets\VueAsset',
        'vuelte\assets\AdminLteAsset',
    ];
}