<?php
namespace vuelte\tools;

use Yii;
use yii\web\View;
use yii\helpers\ArrayHelper;

class VarConvert{
    static function run(View $view, $data, $name){
        //值转字符串定义
        if(is_object($data)){
            $objectArray = ArrayHelper::toArray($data);
            $dataStr = empty($objectArray) ? "{}" : json_encode($objectArray);
        }
        else if(is_array($data)){
            $dataStr = json_encode($data);
        }
        else if(is_bool($data)){
            $dataStr = $data ? "true" : "false";
        }
        else if(is_int($data) || is_double($data)){
            $dataStr = $data;
        }
        else{
            $dataStr = "'$data'";
        }
        //输出到Http头部JS
        $view->registerJs("var $name = $dataStr;", View::POS_HEAD);
    }
}
