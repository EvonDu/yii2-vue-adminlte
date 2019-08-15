<?php
namespace vuelte\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * Class ImageAsset
 * @package vuelte\lte\assets
 */
class ImageAsset extends AssetBundle {
    /**
     * @var string
     */
    public $sourcePath = __DIR__.'/../static/image';

    /**
     * @param View $view
     * @param $name
     * @return string
     */
    static function get(View $view, $name){
        //加载资源包
        if(!$view->getAssetManager()->getBundle(self::className()))
            self::register($view);

        //获取基本地址
        $asset_url=$view->getAssetManager()->getBundle(self::className())->baseUrl;

        //返回访问地址
        return "$asset_url/$name";
    }
}