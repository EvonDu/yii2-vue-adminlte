<?php
namespace vuelte\lib;

use yii\web\View;
use yii\helpers\ArrayHelper;

class Import{
    /**
     * 导入Js变量（从php中）
     * @param View $view    视图
     * @param String $data  数据
     * @param String $name  变量名
     */
    static function value(View $view, $data, $name){
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

    /**
     * 导入Vue组件
     * @param View $view        视图
     * @param String $paths     组件路径
     * @param array $params     PHP参数
     */
    static function component(View $view, $paths, array $params = []){
        $content = $view->render($paths, $params);
        $component = new VueComponent($content);
        $component->export($view);
    }
}