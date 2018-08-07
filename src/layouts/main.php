<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use backend\assets\AppAsset;
use vuelte\assets\ElementAsset;
use vuelte\assets\AdminLteComponentsAsset;

AppAsset::register($this);
ElementAsset::register($this);
AdminLteComponentsAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="hold-transition skin-blue fixed sidebar-mini">
<?php $this->beginBody() ?>

<div class="wrapper">
    <div id="app-header">
        <lte-header title="YII-Admin2" :messages="header.messages" :notifications="header.notifications" :tasks="header.tasks" :user="user"
                    :url-home="urlHome" :url-signout="urlSignOut"></lte-header>
        <lte-sidebar :nodes="nodes" :user="user"></lte-sidebar>
    </div>
    <div class="content-wrapper">
        <div id="content-header">
            <lte-content-header :small="small" :breadcrumbs="breadcrumbs"><?=$this->title?></lte-content-header>
        </div>
        <div class="content"><?= $content ?></div>
    </div>
    <div id="app-footer">
        <lte-footer><strong>Copyright &copy; 2017-2018 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights reserved.</lte-footer>
        <lte-sidebar-setting></lte-sidebar-setting>
    </div>
</div>

<script>
    const store = new Vuex.Store({
        state: {},
        mutations: {}
    });
    new Vue({
        el: '#app-header',
        store:store,
        data: function() {
            return {
                urlHome:"<?=Url::home()?>",
                urlSignOut:"<?=Url::to(["site/logout"])?>",
                user:{
                    'name': "User",
                    'image': "https://adminlte.io/themes/AdminLTE/dist/img/user8-128x128.jpg",
                    'job': "Developer",
                    'abstract':'Member since Nov. 2012'
                },
                header:{
                    messages:[],
                    notifications:[],
                    tasks:[{"progress":"68","content":"后端开发","url":"#"}]
                },
                nodes:[
                    { "title": "Gii", "header": true },
                    {
                        "url": "#",
                        "title": "Yii Code Generator",
                        "icon": "fa fa-dashboard",
                        "active": true,
                        "tags": [{"content": "Yii", "class": "bg-green"}],
                        "nodes": [
                            {"title": "Model Generator", "url": "<?=Url::to(["/gii/default/view","id"=>"model"])?>"},
                            {"title": "CRUD Generator", "url": "<?=Url::to(["/gii/default/view","id"=>"crud"])?>"},
                            {"title": "Module Generator", "url": "<?=Url::to(["/gii/default/view","id"=>"module"])?>"},
                        ]
                    }
                ]
            }
        }
    });
    new Vue({
        el: '#content-header',
        store:store,
        data:{
            "small":"<?= isset($this->params['small']) ? $this->params['small'] : "";?>",
            "breadcrumbs":<?= json_encode(vuelte\tools\Breadcrumbs::getBreadcrumbs($this)) ?>
        }
    });
    new Vue({el: '#app-footer'});
</script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
