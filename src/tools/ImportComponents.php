<?php
namespace vuelte\tools;

use yii\web\View;

class ImportComponents{
    static function run(View $view, $paths, array $params = []){
        if(is_array($paths)){
            foreach ($paths as $path){
                print $view->render($path, $params);
            }
        }
        else{
            print $view->render($paths, $params);
        }
    }
}