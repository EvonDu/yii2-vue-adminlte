<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Url;
use yii\helpers\Html;
use vuelte\vue\Import;
use vuelte\vue\assets\ElementAsset;
use vuelte\lte\assets\AppAsset;
use vuelte\lte\assets\AdminLteComponentsAsset;

//加载资源
AppAsset::register($this);
ElementAsset::register($this);
AdminLteComponentsAsset::register($this);

//加载内容(组件形式)
Import::componentByContent($this, $content);

//读取配置信息
$config = [];
$config_path = Yii::getAlias("@app/config/adminlte.php");
if(file_exists($config_path)){
    $config = include($config_path);
    $config = is_array($config) ? $config : [];
}
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

<div id="app" class="wrapper">
    <lte-header :title="title" :url-home="urlHome" :signout="signout"
                :messages="header.messages" :notifications="header.notifications" :tasks="header.tasks"
                :user="user" :user-buttons="userButtons" :signout="signout" :profile="profile"></lte-header>
    <lte-sidebar :nav="nav" :user="user"></lte-sidebar>
    <div class="content-wrapper">
        <lte-content-header :small="small" :breadcrumbs="breadcrumbs"><?=$this->title?></lte-content-header>
        <div class="content">
            <let-content></let-content>
        </div>
    </div>
    <lte-footer><?= isset($config['footer']) ? $config['footer'] : '<strong>Copyright &copy; 2017-2018 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights reserved.'?></lte-footer>
    <lte-sidebar-setting>
        <div slot="home"><h4 class="control-sidebar-heading">Home</h4></div>
        <div slot="setting"><h4 class="control-sidebar-heading">Setting</h4></div>
    </lte-sidebar-setting>
</div>

<script>
    const store = new Vuex.Store({
        state: {},
        mutations: {}
    });
    const vue = new Vue({
        el: '#app',
        store:store,
        data: function() {
            return {
                title:"<?= isset($config['productName']) ? $config['productName'] : 'Yii AdminLet'?>",
                urlHome:"<?=Url::home()?>",
                user:{
                    'name': "<?= isset($config['user']['name']) ? $config['user']['name'] : 'Admin'?>",
                    'image': "<?= isset($config['user']['image']) ? $config['user']['image'] : 'https://adminlte.io/themes/AdminLTE/dist/img/user8-128x128.jpg'?>",
                    'job': "<?= isset($config['user']['job']) ? $config['user']['job'] : 'Developer'?>",
                    'abstract': "<?= isset($config['user']['abstract']) ? $config['user']['abstract'] : 'Member since Nov. 2012'?>"
                },
                header:{
                    messages: <?= isset($config['messages']) ? json_encode($config['messages']) : '[]'?>,
                    notifications: <?= isset($config['notifications']) ? json_encode($config['notifications']) : '[]'?>,
                    tasks: <?= isset($config['tasks']) ? json_encode($config['tasks']) : '[]'?>,
                },
                nav: <?= isset($config['nav']) ? json_encode($config['nav']) : '[]'?>,
                profile : <?= isset($config['profile']) ? json_encode($config['profile']) : '{}'?>,
                signout : <?= isset($config['signout']) ? json_encode($config['signout']) : '{"text":"Sign Out"}'?>,
                userButtons : <?= isset($config['userButtons']) ? json_encode($config['userButtons']) : '[]'?>,
                small:"<?= isset($this->params['small']) ? $this->params['small'] : "";?>",
                breadcrumbs:<?= json_encode(vuelte\lte\lib\Breadcrumbs::getBreadcrumbs($this)) ?>
            }
        }
    });
</script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
