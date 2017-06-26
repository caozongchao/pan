<?php
use frontend\helpers\FormatSizeHelper;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;

$this->title = $data->title.'_云上搜索';
?>
<div class="container" style="padding-top:60px;">
    <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <!-- <div class="col-lg-6">
                            <center>
                                <img src="http://placehold.it/100x145" class="img-responsive">
                            </center>
                        </div> -->
                        <div class="col-lg-10">
                            <dl class="dl-horizontal">
                                <dt>资源名称</dt>
                                <dd><?=HtmlPurifier::process($data->title)?></dd>
                                <dt>大小</dt>
                                <dd><span class="badge" style="background-color: #99CCFF"><?=FormatSizeHelper::formatBytes($data->size)?></span></dd>
                                <dt>收录时间</dt>
                                <dd><span class="badge" style="background-color: #FFCC99"><?=date('Y-m-d H:i:s',$data->create_time)?></span></dd>
                                <dt>浏览</dt>
                                <dd><span class="badge" style="background-color: #99CC33"><?=$data->click?></span></dd>
                                <dt>文件类型</dt>
                                <dd>
                                    <span class="badge" style="background-color: #99CC33">
                                        <?php if ($data->isdir): ?>
                                            目录
                                        <?php else: ?>
                                            文件
                                        <?php endif ?>
                                    </span>
                                </dd>
                                <dt>分享用户</dt>
                                <dd><a href="<?=Url::to(['user/index','id' => $data->user->uid])?>"><?=$data->user->user_name?></a></dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <center>
                        <ul class="list-inline">
                            <li>
                                <i class="fa fa-download"></i>
                                <?php if ($data->shorturl): ?>
                                    <a href="http://pan.baidu.com/s/<?=$data->shorturl?>" target="_blank">点击进入百度网盘查看</a>
                                <?php else: ?>
                                    <a href="http://pan.baidu.com/share/link?shareid=<?=$data->shareid?>&uk=<?=$data->uk?>" target="_blank">点击进入百度网盘查看</a>
                                <?php endif ?>
                            </li>
                        </ul>
                    </center>
                </div>
            </div>
            <div class="panel panel-info">
                <div class="panel-heading">
                    <?=HtmlPurifier::process($data->title)?>的相关搜索：
                </div>
                <div class="panel-body">
                    <?php foreach ($keys as $key): ?>
                        <h3 class="pull-left"><span class="label label-success"><a href="<?=Url::to(['search/index','k' => $key])?>" target="_blank" style="color:#ffffff;"><?=$key?></a></span></h3>
                    <?php endforeach ?>
                </div>
            </div>
            <div class="panel panel-info">
                <div class="panel-heading">
                    <?=HtmlPurifier::process($data->title)?>的同类型资源：
                </div>
                <div class="list-group">
                    <?php foreach ($relateShares as $relateShare): ?>
                        <a href="<?=Url::to(['detail/index','id' => $relateShare->fid])?>" target="_blank" class="list-group-item"><?=$relateShare->title?></a>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
        <?php echo \Yii::$app->view->renderFile('@frontend/views/layouts/detailSidebar.php',['data' => $data,'userNewShares' => $userNewShares]); ?>
    </div>
</div>
<?php echo \Yii::$app->view->renderFile('@frontend/views/layouts/contentFooter.php'); ?>
