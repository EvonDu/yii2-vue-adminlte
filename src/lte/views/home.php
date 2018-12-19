<?php
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = '仪表盘';
$this->params['small'] = 'Dashboard';
?>
<div id="app">
    <lte-row>
        <lte-small-box title="Operating System" bg="aqua" icon="ion ion-bag"><?= PHP_OS ?></lte-small-box>
        <lte-small-box title="PHP Version" bg="green" icon="ion ion-stats-bars"><?= PHP_VERSION; ?></lte-small-box>
        <lte-small-box title="Post Max Size" bg="yellow" icon="ion ion-person-add"><?= ini_get('post_max_size')?></lte-small-box>
        <lte-small-box title="Upload Max Filesize" bg="red" icon="ion ion-pie-graph"><?= ini_get('upload_max_filesize') ?></lte-small-box>
    </lte-row>

    <lte-row>
        <lte-col col="7">
            <lte-box title="Server Setting" icon="glyphicon glyphicon-cloud" no-padding>
                <table class="table table-hover">
                    <tr>
                        <th style="width: 10px">#</th>
                        <th style="width: 30%">Task</th>
                        <th>Progress</th>
                    </tr>
                    <tr>
                        <td>1.</td>
                        <td>操作系统</td>
                        <td><span class="label label-primary"><?= PHP_OS ?></span></td>
                    </tr>
                    <tr>
                        <td>2.</td>
                        <td>YII</td>
                        <td><span class="label label-info">2.0.15</span></td></tr>
                    </tr>
                    <tr>
                        <td>3.</td>
                        <td>PHP版本</td>
                        <td><span class="label label-info"><?= PHP_VERSION; ?></span></td>
                    </tr>
                    <tr>
                        <td>4.</td>
                        <td>服务器地址</td>
                        <td><?= $_SERVER['HTTP_HOST']?></td>
                    </tr>
                    <tr>
                        <td>5.</td>
                        <td>访问IP</td>
                        <td><?= $_SERVER['REMOTE_ADDR']?></td>
                    </tr>
                    <tr>
                        <td>6.</td>
                        <td>访问端口</td>
                        <td><?= $_SERVER['SERVER_PORT']?></td>
                    </tr>
                    <tr>
                        <td>7.</td>
                        <td>POST限制</td>
                        <td><span class="label label-success"><?= ini_get('post_max_size')?></span></td>
                    </tr>
                    <tr>
                        <td>8.</td>
                        <td>上传附件限制</td>
                        <td><span class="label label-success"><?= ini_get('upload_max_filesize') ?></span></td>
                    </tr>
                    <tr>
                        <td>9.</td>
                        <td>执行时间限制</td>
                        <td><span class="label label-warning"><?= ini_get('max_execution_time')?>S</span></td>
                    </tr>
                    <tr>
                        <td>10.</td>
                        <td>统计时间</td>
                        <td><?= date("Y-m-d H:i:s",time())?></td>
                    </tr>
                    <tr>
                        <td>11.</td>
                        <td>浏览器</td>
                        <td><?= $_SERVER['HTTP_USER_AGENT']?></td>
                    </tr>
                </table>
            </lte-box>
        </lte-col>

        <lte-col col="5">
            <lte-box title="Gii" icon="glyphicon glyphicon-wrench">
                <?= Html::tag("lte-btn","<i class='glyphicon glyphicon-th-list'></i> Yii Code Generator",[
                    "href"=>Url::to(["/gii"]),
                    "a"=>true,
                    "block"=>true,
                    "type"=>"info",
                     "target"=>"view_window"
                ])?>
                <?= Html::tag("lte-btn","<i class='glyphicon glyphicon-file'></i> Model Generator",[
                    "href"=>Url::to(["/gii/default/view","id"=>"model"]),
                    "a"=>true,
                    "block"=>true,
                    "type"=>"primary",
                    "target"=>"view_window"
                ])?>
                <?= Html::tag("lte-btn","<i class='glyphicon glyphicon-file'></i> CRUD Generator",[
                    "href"=>Url::to(["/gii/default/view","id"=>"crud"]),
                    "a"=>true,
                    "block"=>true,
                    "type"=>"success",
                    "target"=>"view_window"
                ])?>
                <?= Html::tag("lte-btn","<i class='glyphicon glyphicon-file'></i> Controller Generator",[
                    "href"=>Url::to(["/gii/default/view","id"=>"controller"]),
                    "a"=>true,
                    "block"=>true,
                    "type"=>"warning",
                    "target"=>"view_window"
                ])?>
                <?= Html::tag("lte-btn","<i class='glyphicon glyphicon-file'></i> Form Generator",[
                    "href"=>Url::to(["/gii/default/view","id"=>"form"]),
                    "a"=>true,
                    "block"=>true,
                    "type"=>"danger",
                    "target"=>"view_window"
                ])?>
                <?= Html::tag("lte-btn","<i class='glyphicon glyphicon-file'></i> Module Generator",[
                    "href"=>Url::to(["/gii/default/view","id"=>"module"]),
                    "a"=>true,
                    "block"=>true,
                    "type"=>"info",
                    "target"=>"view_window"
                ])?>
                <?= Html::tag("lte-btn","<i class='glyphicon glyphicon-file'></i> Extension Generator",[
                    "href"=>Url::to(["/gii/default/view","id"=>"extension"]),
                    "a"=>true,
                    "block"=>true,
                    "type"=>"primary",
                    "target"=>"view_window"
                ])?>
            </lte-box>
        </lte-col>
    </lte-row>
</div>


<script>
    new Vue({
        el:'#app',
        data:{}
    });
</script>