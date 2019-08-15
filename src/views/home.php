<?php
class Calendar{
    function getList($year, $month){
        //获取当月共有多少日
        if( $month == 4 || $month == 6 || $month == 9 || $month==11)
            $day = 30;
        else if( $month == 2 )
            $day = (($year%4==0&&$year%100!=0)||$year%400==0) ? 29 : 28;
        else
            $day = 31;

        //获取当月第一日的星期数
        $w = getdate(mktime(0,0,0,$month,1,$year))["wday"];

        //生成日历数组
        $arr = array();
        for($i=1;$i<=$day;$i++){
            array_push($arr,$i);
        }
        if($w>=1&&$w<=6){
            for($m=1;$m<=$w;$m++){
                array_unshift($arr,null);
            }
        }

        //补充余数
        $count = count($arr);
        $remainder = 7 - $count%7;
        for ($i=0;$i<$remainder;$i++){
            array_push($arr,null);
        }

        //返回
        return $arr;
    }
}
class SystemInfo{
    /**
     * 系统变量
     * @var string
     */
    private $rs;

    /**
     * 构造函数
     * SystemInfo constructor.
     */
    public function __construct(){
        //获取某一时刻系统cpu和内存使用情况
        $fp = popen('top -b -n 2 | grep -E "(Cpu|Mem|Task)"',"r");
        $rs = "";
        while(!feof($fp)){ $rs .= fread($fp,1024);}
        pclose($fp);

        //保存到私有变量
        $this->rs = $rs;
    }

    /**
     * 获取CPU使用率
     * @return float|int
     */
    public function getCpuUsed(){
        $sum = 0;
        $count = 0;
        preg_match_all('/%Cpu\(s\)\:(.*)us/U', $this->rs, $matches);
        if(isset($matches[1])){
            foreach ($matches[1] as $value){
                $count++;
                $sum += (double)trim($value);
            }
        }
        return $count ? $sum/$count : 0;
    }

    /**
     * 获取内存使用率
     * @return float|int
     */
    public function getMemUsed(){
        //设置参数
        $total = 0;
        $used = 0;
        $sum = 0;
        $count = 0;
        preg_match_all('/KiB Mem \:(.*)total,(.*)free,(.*)used/U', $this->rs, $matches);

        //获取总内存
        if(isset($matches[1])){
            foreach ($matches[1] as $value){
                $count ++;
                $sum += (int)trim($value);
            }
            $total = $count ? $sum/$count : 0;
        }

        //获取已经使用内存
        if(isset($matches[3])){
            foreach ($matches[3] as $value){
                $count ++;
                $sum += (int)trim($value);
            }
            $used = $count ? $sum/$count : 0;
        }

        return $total ? round($used/$total,2) * 100 : 0;
    }

    /**
     * 获取硬盘使用率
     * @return float|int
     */
    public function getHdUsed(){
        $dt = round(@disk_total_space(".")/(1024*1024*1024),3); //总
        $df = round(@disk_free_space(".")/(1024*1024*1024),3); //可用
        $du = $dt-$df; //已用
        $hd = (floatval($dt)!=0)?round($du/$dt*100,2):0;
        return $hd;
    }

    /**
     * 获取进程总数量
     * @return float|int
     */
    public function getTaskCount(){
        $sum = 0;
        $count = 0;
        preg_match_all('/Tasks\:(.*)total/U', $this->rs, $matches);
        if(isset($matches[1])){
            foreach ($matches[1] as $value){
                $count++;
                $sum += (int)trim($value);
            }
        }
        return $count ? $sum/$count : 0;
    }
}
$systemInfo = new SystemInfo();
$calendar = new Calendar();
$time = getdate();

$this->title = '仪表盘';
$this->params['small'] = 'Dashboard';
?>
<style>
    .system-item{
        display: flex;
        min-height: 120px;
        border: 1px solid #ECF0F5;
    }
    .system-item .title{
        width: 68px;
        background-color: #3c8dbc;
        color: white;
        font-weight: bold;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .system-item .data{
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    .system-item .data .count{
        font-size: 24px;
        padding: 12px 0px;
    }
    .circle-progressbar{
        text-align: center;
    }
    .calendar{
        background-color: #00a65a;
    }
    .calendar table{
        width: 100%;
        color: white;
        font-weight: bold;
    }
    .calendar th, .calendar td{
        height: 36px;
        width: 14.28%;
        cursor: pointer;
        text-align: center;
        border-radius: 6px;
    }
    .calendar th{
        height: 46px;
    }
    .calendar td:hover{
        background: rgba(0,0,0,0.3);
    }
    .calendar td.active{
        height: 36px;
        background: rgba(0,0,0,0.5);
    }
</style>
<div id="app">
    <?php if(isset($box) && is_array($box)):?>
        <lte-row>
            <lte-col col="12">
                <lte-box title="系统：<?= PHP_OS ?>">
                    <div class="row">
                        <?php foreach ($box as $item):?>
                            <div class="col-md-3">
                                <div class="system-item">
                                    <div class="title"><?=isset($item["title"])?$item["title"]:null?></div>
                                    <div class="data">
                                        <div class="count"><?=isset($item["text"])?$item["text"]:null?></div>
                                        <div class="action">
                                            <a href="<?=isset($item["btn1_url"])?$item["btn1_url"]:"#"?>"><?=isset($item["btn1_text"])?$item["btn1_text"]:null?></a> |
                                            <a href="<?=isset($item["btn2_url"])?$item["btn2_url"]:"#"?>"><?=isset($item["btn2_text"])?$item["btn2_text"]:null?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach;?>
                    </div>
                </lte-box>
            </lte-col>
        </lte-row>
    <?php endif;?>
    <lte-row>
        <lte-col col="12">
            <lte-box title="服务器状态">
                <div class="row">
                    <div class="col-md-2">
                        <div class="circle-progressbar">
                            <canvas id="circle-cpu" width="200" height="200"></canvas>
                            <div>CPU使用率</div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="circle-progressbar">
                            <canvas id="circle-mem" width="200" height="200"></canvas>
                            <div>内存使用率</div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="circle-progressbar">
                            <canvas id="circle-hd" width="200" height="200"></canvas>
                            <div>硬盘使用率</div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="circle-progressbar">
                            <canvas id="circle-task" width="200" height="200"></canvas>
                            <div>进程运行数</div>
                        </div>
                    </div>
                </div>
            </lte-box>
        </lte-col>
    </lte-row>

    <lte-row>
        <lte-col col="6">
            <lte-box title="网站状态" no-padding>
                <table class="table table-hover">
                    <tr>
                        <th style="width: 10px">#</th>
                        <th style="width: 30%">Title</th>
                        <th>Progress</th>
                    </tr>
                    <tr>
                        <td>1.</td>
                        <td>PHP版本</td>
                        <td><span class="label label-info"><?= PHP_VERSION; ?></span></td>
                    </tr>
                    <tr>
                        <td>2.</td>
                        <td>服务器地址</td>
                        <td><?= $_SERVER['HTTP_HOST']?></td>
                    </tr>
                    <tr>
                        <td>3.</td>
                        <td>访问IP</td>
                        <td><?= $_SERVER['REMOTE_ADDR']?></td>
                    </tr>
                    <tr>
                        <td>4.</td>
                        <td>访问端口</td>
                        <td><?= $_SERVER['SERVER_PORT']?></td>
                    </tr>
                    <tr>
                        <td>5.</td>
                        <td>POST限制</td>
                        <td><span class="label label-success"><?= ini_get('post_max_size')?></span></td>
                    </tr>
                    <tr>
                        <td>6.</td>
                        <td>上传附件限制</td>
                        <td><span class="label label-success"><?= ini_get('upload_max_filesize') ?></span></td>
                    </tr>
                    <tr>
                        <td>7.</td>
                        <td>执行时间限制</td>
                        <td><span class="label label-warning"><?= ini_get('max_execution_time')?>S</span></td>
                    </tr>
                    <tr>
                        <td>8.</td>
                        <td>统计时间</td>
                        <td><?= date("Y-m-d H:i:s",time())?></td>
                    </tr>
                    <tr>
                        <td>9.</td>
                        <td>浏览器</td>
                        <td><?= $_SERVER['HTTP_USER_AGENT']?></td>
                    </tr>
                </table>
            </lte-box>
        </lte-col>
        <lte-col col="6">
            <lte-box title="日历" type="success" no-padding>
                <div class="calendar">
                    <table>
                        <thead>
                        <tr>
                            <th>SU</th><th>MO</th><th>TU</th><th>WE</th><th>TH</th><th>FR</th><th>SA</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($calendar->getList($time["year"],$time["mon"]) as $index => $day):?>
                            <?php if(($index)%7 === 0):?>
                                <tr>
                            <?php endif;?>
                            <?php if($day === $time["mday"]):?>
                                <td class="active"><?=$day?></td>
                            <?php else:?>
                                <td><?=$day?></td>
                            <?php endif;?>
                            <?php if(($index)%7 === 6):?>
                                </tr>
                            <?php endif;?>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
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
<script>
    //初始化全部进度条
    initCircleProgressbar('circle-cpu',<?=$systemInfo->getCpuUsed()?>);
    initCircleProgressbar('circle-mem',<?=$systemInfo->getMemUsed()?>);
    initCircleProgressbar('circle-hd',<?=$systemInfo->getHdUsed()?>);
    initCircleProgressbar('circle-task',<?=$systemInfo->getTaskCount()?>);

    //初始化圆形进度条方法
    function initCircleProgressbar(id,process){
        //参数
        var canvas = document.getElementById(id);
        var context = canvas.getContext('2d');

        // 画外圆
        context.beginPath();
        context.arc(100, 100, 80, 0, Math.PI*2);
        context.closePath();
        context.fillStyle = '#aaa';
        context.fill();
        drawCricle(context, process);

        //画圆函数
        function drawCricle(ctx, percent){
            // 进度环
            ctx.beginPath();
            ctx.moveTo(100, 100);
            ctx.arc(100, 100, 80, Math.PI * 1.5, Math.PI * (1.5 + 2 * percent / 100 ));
            ctx.closePath();
            ctx.fillStyle = '#3c8dbc';
            ctx.fill();

            // 内圆
            ctx.beginPath();
            ctx.arc(100, 100, 70, 0, Math.PI * 2);
            ctx.closePath();
            ctx.fillStyle = 'white';
            ctx.fill();

            // 填充文字
            ctx.font= "bold 30px microsoft yahei";
            ctx.fillStyle = "black";
            ctx.textAlign = "center";
            ctx.textBaseline = 'middle';
            ctx.moveTo(100, 100);
            ctx.fillText(process + '%', 100, 100);
        }
    }
</script>