<?php
namespace vuelte\tools;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

class VarConvert{
    static function run($view, $data, $name){
        $data = ArrayHelper::toArray($data);
        $view->registerJs(
            "var $name = ".json_encode($data).";",
            \yii\web\View::POS_HEAD
        );
    }
}
