<?php
namespace vuelte\lib;

use yii\web\View;

class VueComponent{
    private $view;

    //构造函数
    public function __construct(View $view){
        $this->view = $view;
    }

    //组件开始
    public function begin(){
        //开启缓冲区
        ob_start();
    }

    //组件结束
    public function end(){
        //读取并关闭缓冲区
        $content = ob_get_contents();
        ob_end_clean();

        //提取template元素
        $template = $this->_getElement('template',$content);

        //提取script元素
        $script = $this->_getElement('script',$content);
        $script = str_replace("{{template}}",$template,$script);
        $this->view->registerJs($script, View::POS_HEAD);

        //提取style元素
        $style = $this->_getElement('style',$content);
        $this->view->registerCss($style);
    }

    //提取元素（使用正则表达式）
    private function _getElement($tag,$content){
        preg_match("/<$tag>[\w\W]+<\/$tag>/", $content, $matches);
        if($matches){
            $content = $matches[0];
            $content = str_replace("<$tag>","",$content);
            $content = str_replace("</$tag>","",$content);
        }
        else{
            $content = '';
        }
        return $this->_htmlCompress($content);
    }

    //HTML压缩
    private function _htmlCompress($string){
        $string = str_replace("\r\n", '', $string); //清除换行符
        $string = str_replace("\n", '', $string); //清除换行符
        $string = str_replace("\t", '', $string); //清除制表符
        $pattern = array (
            "/> *([^ ]*) *</",
            "/[\s]+/",
            "/<!--[\\w\\W\r\\n]*?-->/",
            "/\" /",
            "/ \"/",
            "'/\*[^*]*\*/'"
        );
        $replace = array (
            ">\\1<",
            " ",
            "",
            "\"",
            "\"",
            ""
        );
        return preg_replace($pattern, $replace, $string);
    }
}