<?php
use yiivue\core\JSMin;

//定义
header('Content-type: text/javascript');

//循环加载文件
loadFiles(__DIR__);
function loadFiles($path){
    $dir = opendir($path);
    while ($file = readdir($dir)){
        if(in_array($file,[".","..",pathinfo(__FILE__,PATHINFO_BASENAME)]))
            continue;
        $filename = "$path/$file";
        if(is_dir($filename))
            loadFiles($filename);
        else{
            include($filename);
            echo "\n\n";
        }
    }
};

//
/*ob_start();
loadFiles(__DIR__);
$content = ob_get_contents();
echo $content;*/