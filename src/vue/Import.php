<?php
namespace vuelte\vue;

use yii\web\View;
use yii\helpers\ArrayHelper;

class Import{
    /**
     * 导入JavaScript变量（从PHP变量中）
     * 布尔型会被处理成字符串的1和0
     * @param View $view
     * @param $data
     * @param $name
     * @return string
     */
    static public function value(View $view, $data, $name){
        //对象与数组值转换
        if(is_object($data)){
            $objectArray = ArrayHelper::toArray(self::valueAdjust($data));
            $dataStr = json_encode($objectArray);
        }
        else if(is_array($data)){
            $objectArray = ArrayHelper::toArray(self::valueAdjust($data));
            $dataStr = json_encode($objectArray);
        }
        //布尔值转换
        else if(is_bool($data)){
            $dataStr = $data ? "1" : "0";
        }
        //默认类型转换
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
    static public function component(View $view, $paths, array $params = []){
        $content = $view->render($paths, $params);
        $component = new VueComponent($content);
        $component->export($view);
    }

    /**
     * 导入Vue组件(直接以内容形式)
     * @param View $view        视图
     * @param String $content   组件内容
     */
    static public function componentByContent(View $view, $content){
        $component = new VueComponent($content);
        $component->export($view);
    }

    /**
     * 导入JavaScript时，对变量进行处理
     * 布尔型会被处理成字符串的1和0
     * @param $data
     * @return array|int
     */
    static private function valueAdjust($data){
        //对象处理
        if(is_object($data)){
            foreach ($data as $key=>$value){
                $data->$key = self::valueAdjust($data->$key);
            }
            return $data;
        }
        //数组处理
        else if(is_array($data)){
            foreach ($data as $key=>$value){
                $data[$key] = self::valueAdjust($data[$key]);
            }
            return $data;
        }
        //布尔型处理
        else if(is_bool($data)){
            return $data ? "1" : "0";
        }
        //其他
        else{
            return $data;
        }
    }
}