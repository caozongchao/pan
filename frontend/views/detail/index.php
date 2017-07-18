<?php
use frontend\helpers\FormatSizeHelper;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
use frontend\helpers\ColorHelper;
use yii\widgets\Breadcrumbs;
use frontend\helpers\CheckMobileHelper;

$this->title = $data->title.'_云上搜索';
$this->params['breadcrumbs'][] = ['label' => $data->title];
?>
<div class="container">
    <div class="row">
        <?php echo \Yii::$app->view->renderFile('@frontend/views/layouts/detailSidebar.php',['data' => $data,'userNewShares' => $userNewShares]); ?>
        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <dl class="dl-horizontal">
                                <dt>资源名称</dt>
                                <dd>
                                    <?php if ($data->deleted == 0): ?>
                                        <?=HtmlPurifier::process($data->title)?>
                                    <?php else: ?>
                                        <b>已失效</b> <del><?=HtmlPurifier::process($data->title)?></del>
                                    <?php endif?>
                                </dd>
                                <dt>大小</dt>
                                <dd><span class="badge" style="background-color: #99CCFF"><?=FormatSizeHelper::formatBytes($data->size)?></span></dd>
                                <dt>收录时间</dt>
                                <dd><span class="badge" style="background-color: #FFCC99"><?=date('Y-m-d H:i:s',$data->create_time)?></span></dd>
                                <dt>分享时间</dt>
                                <dd><span class="badge" style="background-color: #FFCC99"><?=date('Y-m-d H:i:s',$data->feed_time)?></span></dd>
                                <dt>浏览</dt>
                                <dd><span class="badge" style="background-color: #99CC33"><?=$data->click?></span></dd>
                                <dt>类型</dt>
                                <dd>
                                    <?php if ($data->isdir): ?>
                                        <span class="fa fa-folder"></span>
                                    <?php else: ?>
                                        <span class="fa fa-file"></span>
                                    <?php endif ?>
                                </dd>
                                <dt>分享用户</dt>
                                <dd><a href="<?=Url::to(['user/index','id' => $data->user->uid])?>"><?=$data->user->user_name?></a></dd>
                                <dt>相关关键词</dt>
                                <dd>
                                    <?php if ($keys): ?>
                                        <?php foreach ($keys as $key): ?>
                                            <span class="label label-success"><a href="<?=Url::to(['search/index','k' => $key])?>" target="_blank" style="color:#ffffff;"><?=$key?></a></span>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <?php if ($data->deleted == 0): ?>
                    <div class="panel-footer">
                        <center>
                            <ul class="list-inline" style="margin-bottom: 0px;">
                                <li>
                                    <a href="javascript:void(0)" data-toggle="modal" data-target=".juanzeng" style="outline:none;font-size:18px;" rel="nofollow">点击进入百度网盘查看</a>
                                </li>
                            </ul>
                        </center>
                    </div>
                <?php endif ?>
            </div>
            <!-- 广告位 -->
            <?php if (CheckMobileHelper::isMobile()): ?>
                <center></center>
            <?php else: ?>
                <center></center>
            <?php endif ?>
            <div class="tabbable tabs-left" style="margin-top:20px;">
                <ul class="nav nav-tabs">
                    <?php $index = 0;?>
                    <?php foreach ($tmpKeys as $value): ?>
                        <?php if ($index == 0): ?>
                            <li class="active"><a href="#tabContent_<?=$index?>" data-toggle="tab"><?=$value?></a></li>
                        <?php else: ?>
                            <li><a href="#tabContent_<?=$index?>" data-toggle="tab"><?=$value?></a></li>
                        <?php endif?>
                        <?php $index++;?>
                    <?php endforeach ?>
                    <li><a href="#tabContent_ext" data-toggle="tab">同类型资源</a></li>
                </ul>
                <div class="tab-content">
                    <?php $index = 0;?>
                    <?php foreach ($relateShares as $key => $relateShare): ?>
                        <?php if ($index == 0): ?>
                            <div class="tab-pane active" id="tabContent_<?=$index?>">
                        <?php else: ?>
                            <div class="tab-pane" id="tabContent_<?=$index?>">
                        <?php endif?>
                            <ol>
                                <?php if ($relateShare): ?>
                                    <?php foreach ($relateShare as $relate): ?>
                                        <li style="padding: 5px;">
                                        <?php if ($relate->deleted == 0): ?>
                                            <a href="<?=Url::to(['detail/index','id' => $relate->fid])?>" title="<?=$relate->title?>"><?=ColorHelper::red(mb_substr($relate->title,0,70),$key,14)?></a>
                                        <?php else: ?>
                                            <b>已失效</b> <del><a href="<?=Url::to(['detail/index','id' => $relate->fid])?>" title="<?=$relate->title?>"><?=ColorHelper::red(mb_substr($relate->title,0,70),$key,14)?></a></del>
                                        <?php endif ?>
                                        <span class="label label-default" style="margin-left:10px;"><a href="<?=Url::to(['user/index','id' => $relate->uid])?>" style="color:#ffffff;"><?=$relate->user->user_name?></a></span>
                                        </li>
                                    <?php endforeach ?>
                                <?php else: ?>
                                    <div class="alert alert-danger" style="margin-top:10px;">
                                        该关键字暂无资源
                                    </div>
                                <?php endif?>
                            </ol>
                        </div>
                    <?php $index++;?>
                    <?php endforeach ?>
                    <div class="tab-pane" id="tabContent_ext">
                        <ol>
                            <?php if ($relateShares['同类型资源']): ?>
                                <?php foreach ($relateShares['同类型资源'] as $relate): ?>
                                    <li style="padding: 5px;">
                                    <?php if ($relate->deleted == 0): ?>
                                        <a href="<?=Url::to(['detail/index','id' => $relate->fid])?>" title="<?=$relate->title?>"><?=mb_substr($relate->title,0,70)?></a>
                                    <?php else: ?>
                                        <b>已失效</b> <del><a href="<?=Url::to(['detail/index','id' => $relate->fid])?>" title="<?=$relate->title?>"><?=mb_substr($relate->title,0,70)?></a></del>
                                    <?php endif ?>
                                    <span class="label label-default" style="margin-left:10px;"><a href="<?=Url::to(['user/index','id' => $relate->uid])?>" style="color:#ffffff;"><?=$relate->user->user_name?></a></span>
                                    </li>
                                <?php endforeach ?>
                            <?php endif ?>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo \Yii::$app->view->renderFile('@frontend/views/layouts/contentFooter.php'); ?>
<div>
    <div class="modal fade juanzeng" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="mySmallModalLabel">对您如有帮助，请打赏我</h4>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <div>
                            <img src="/images/wxsq.png" width="130">
                            <center>微信捐赠</center>
                        </div>
                        <div>
                            <img src="/images/zfbsq.png" width="130">
                            <center>支付宝捐赠</center>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-right">
                    <small>若资源失效，烦请联系我标注，谢谢</small>（
                    <?php if ($data->shorturl): ?>
                        <!-- <i class="fa fa-download"></i> -->
                        <a href="http://pan.baidu.com/s/<?=$data->shorturl?>" rel="nofollow" target="_blank" style="font-size:16px" >跳转</a>
                    <?php else: ?>
                        <!-- <i class="fa fa-download"></i> -->
                        <a href="http://pan.baidu.com/share/link?shareid=<?=$data->shareid?>&uk=<?=$data->uk?>" rel="nofollow" target="_blank" style="font-size:18px;" >跳转</a>
                    <?php endif ?>）
                </div>
            </div>
        </div>
    </div>
</div>

