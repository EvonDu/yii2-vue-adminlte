<?php
namespace vuelte\lte\lib;

use yii\helpers\Url;

class Breadcrumbs{
    static function getBreadcrumbs($view){
        $result = [];
        //home
        $home = [];
        $home["label"] = 'Home';
        $home["url"] = Url::home();
        $home["icon"] = 'fa fa-dashboard';
        $result[] = $home;
        //breadcrumbs
        $breadcrumbs = (isset($view->params["breadcrumbs"]) && is_array($view->params["breadcrumbs"]))? $view->params["breadcrumbs"] : [];
        foreach ($breadcrumbs as $breadcrumb){
            $item = [];
            if(is_array($breadcrumb)){
                $item["label"] = isset($breadcrumb['label']) ? $breadcrumb['label'] : "";
                if(isset($breadcrumb['url']))
                    $item["url"] = is_array($breadcrumb['url']) ? Url::to($breadcrumb['url']) : $breadcrumb['url'];
            }
            elseif (is_string($breadcrumb)){
                $item["label"] = $breadcrumb;
            }
            else{
                $item["label"] = $breadcrumb;
            }
            $result[] = $item;
        };
        //return
        return $result;
    }
}
