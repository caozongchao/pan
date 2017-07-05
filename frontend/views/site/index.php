<?php
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = '云上搜索,百度网盘搜索,百度云搜索_云上搜索';
?>
<div class="container">
    <div class="row">
        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1"></div>
            <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 text-center">
                <!-- 首页上广告位 -->
                
            </div>
        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1"></div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h2>云上搜索</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1"></div>
        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 text-center">
            <form action="<?=Url::to(['search/index'])?>">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" name="k" id="k" baiduSug="2" placeholder="暂只支持英文和中文搜索">
                    <span class="input-group-btn">
                        <button class="btn btn-info" id="searchButton" type="submit">
                            <i class="fa fa-fw fa-search"></i>
                        </button>
                    </span>
                </div>
                <div style="padding:10px 0px 0px 0px">
                    热门搜索：
                    <a href="/s-%E9%80%9F%E5%BA%A6%E4%B8%8E%E6%BF%80%E6%83%858">速度与激情8</a>&nbsp;&nbsp;
                    <a href="/s-%E6%91%94%E8%B7%A4%E5%90%A7%E7%88%B8%E7%88%B8">摔跤吧爸爸</a>&nbsp;&nbsp;
                    <a href="/s-%E6%A5%9A%E4%B9%94%E4%BC%A0">楚乔传</a>&nbsp;&nbsp;
                    <a href="/s-%E9%BA%BB%E7%83%A6%E5%AE%B6%E6%97%8F">麻烦家族</a>&nbsp;&nbsp;
                    <a href="/s-tvb">tvb</a>&nbsp;&nbsp;
                    <a href="/s-%E6%95%91%E5%83%B5%E6%B8%85%E9%81%93%E5%A4%AB">救僵清道夫</a>&nbsp;&nbsp;
                    <a href="/s-%E6%8B%86%E5%BC%B9%E4%B8%93%E5%AE%B6">拆弹专家</a>
                </div>
            </form>
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1"></div>
    </div>

    <div class="row" style="margin-top:10px;">
        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1"></div>
        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
            <div class="tabbable">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#topFxUser" data-toggle="tab">分享达人</a></li>
                    <!-- <li><a href="#topFsUser" data-toggle="tab">粉丝达人</a></li>
                    <li><a href="#topGzzUser" data-toggle="tab">关注者达人</a></li> -->
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane active" id="topFxUser">
                    <center style="margin-top: 10px;">
                        <?php if ($topFxUsers): ?>
                            <?php foreach ($topFxUsers as $topFxUser): ?>
                                <a href="<?=Url::to(['user/index','id' => $topFxUser->uid])?>"><img src="<?=$topFxUser->avatar_url?>" class="img-circle" width="60" /></a>
                            <?php endforeach ?>
                        <?php endif ?>
                    </center>
                </div>
                <!-- <div class="tab-pane active" id="topFsUser">
                    <center style="margin-top: 10px;">
                        
                    </center>
                </div>
                <div class="tab-pane" id="topGzzUser">
                    <center style="margin-top: 10px;">
                        
                    </center>
                </div> -->
            </div>
            <div class="tabbable" style="margin-top:20px;">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#newVideos" data-toggle="tab">最新视频</a></li>
                    <li><a href="#newImages" data-toggle="tab">最新图片</a></li>
                    <li><a href="#newDocuments" data-toggle="tab">最新文档</a></li>
                    <li><a href="#newMusics" data-toggle="tab">最新音乐</a></li>
                    <li><a href="#newPackages" data-toggle="tab">最新压缩包</a></li>
                    <li><a href="#newSoftwares" data-toggle="tab">最新软件</a></li>
                    <li><a href="#newTorrents" data-toggle="tab">最新种子</a></li>
                    <li><a href="#newOthers" data-toggle="tab">最新其他资源</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="newVideos">
                        <ol>
                            <?php if ($newVideos): ?>
                                <?php foreach ($newVideos as $newVideo): ?>
                                    <li style="padding: 5px;">
                                    <?php if ($newVideo->deleted == 0): ?>
                                        <a href="<?=Url::to(['detail/index','id' => $newVideo->fid])?>" title="<?=$newVideo->title?>"><?=mb_substr($newVideo->title,0,50)?></a>
                                    <?php else: ?>
                                        <b>已失效</b> <del><a href="<?=Url::to(['detail/index','id' => $newVideo->fid])?>" title="<?=$newVideo->title?>"><?=mb_substr($newVideo->title,0,50)?></a></del>
                                    <?php endif ?>
                                    <span class="label label-default" style="margin-left:10px;"><a href="<?=Url::to(['user/index','id' => $newVideo->uid])?>" style="color:#ffffff;"><?=$newVideo->user->user_name?></a></span>
                                    </li>
                                <?php endforeach ?>
                            <?php endif ?>
                        </ol>
                    </div>
                    <div class="tab-pane" id="newImages">
                        <ol>
                            <?php if ($newImages): ?>
                                <?php foreach ($newImages as $newImage): ?>
                                    <li style="padding: 5px;">
                                    <?php if ($newImage->deleted == 0): ?>
                                        <a href="<?=Url::to(['detail/index','id' => $newImage->fid])?>" title="<?=$newImage->title?>"><?=mb_substr($newImage->title,0,50)?></a>
                                    <?php else: ?>
                                        <b>已失效</b> <del><a href="<?=Url::to(['detail/index','id' => $newImage->fid])?>" title="<?=$newImage->title?>"><?=mb_substr($newImage->title,0,50)?></a></del>
                                    <?php endif ?>
                                    <span class="label label-default" style="margin-left:10px;"><a href="<?=Url::to(['user/index','id' => $newImage->uid])?>" style="color:#ffffff;"><?=$newImage->user->user_name?></a></span>
                                    </li>
                                <?php endforeach ?>
                            <?php endif ?>
                        </ol>
                    </div>
                    <div class="tab-pane" id="newDocuments">
                        <ol>
                            <?php if ($newDocuments): ?>
                                <?php foreach ($newDocuments as $newDocument): ?>
                                    <li style="padding: 5px;">
                                    <?php if ($newDocument->deleted == 0): ?>
                                        <a href="<?=Url::to(['detail/index','id' => $newDocument->fid])?>" title="<?=$newDocument->title?>"><?=mb_substr($newDocument->title,0,50)?></a>
                                    <?php else: ?>
                                        <b>已失效</b> <del><a href="<?=Url::to(['detail/index','id' => $newDocument->fid])?>" title="<?=$newDocument->title?>"><?=mb_substr($newDocument->title,0,50)?></a></del>
                                    <?php endif ?>
                                    <span class="label label-default" style="margin-left:10px;"><a href="<?=Url::to(['user/index','id' => $newDocument->uid])?>" style="color:#ffffff;"><?=$newDocument->user->user_name?></a></span>
                                    </li>
                                <?php endforeach ?>
                            <?php endif ?>
                        </ol>
                    </div>
                    <div class="tab-pane" id="newMusics">
                        <ol>
                            <?php if ($newMusics): ?>
                                <?php foreach ($newMusics as $newMusic): ?>
                                    <li style="padding: 5px;">
                                    <?php if ($newMusic->deleted == 0): ?>
                                        <a href="<?=Url::to(['detail/index','id' => $newMusic->fid])?>" title="<?=$newMusic->title?>"><?=mb_substr($newMusic->title,0,50)?></a>
                                    <?php else: ?>
                                        <b>已失效</b> <del><a href="<?=Url::to(['detail/index','id' => $newMusic->fid])?>" title="<?=$newMusic->title?>"><?=mb_substr($newMusic->title,0,50)?></a></del>
                                    <?php endif ?>
                                    <span class="label label-default" style="margin-left:10px;"><a href="<?=Url::to(['user/index','id' => $newMusic->uid])?>" style="color:#ffffff;"><?=$newDocument->user->user_name?></a></span>
                                    </li>
                                <?php endforeach ?>
                            <?php endif ?>
                        </ol>
                    </div>
                    <div class="tab-pane" id="newPackages">
                        <ol>
                            <?php if ($newPackages): ?>
                                <?php foreach ($newPackages as $newPackage): ?>
                                    <li style="padding: 5px;">
                                    <?php if ($newPackage->deleted == 0): ?>
                                        <a href="<?=Url::to(['detail/index','id' => $newPackage->fid])?>" title="<?=$newPackage->title?>"><?=mb_substr($newPackage->title,0,50)?></a>
                                    <?php else: ?>
                                        <b>已失效</b> <del><a href="<?=Url::to(['detail/index','id' => $newPackage->fid])?>" title="<?=$newPackage->title?>"><?=mb_substr($newPackage->title,0,50)?></a></del>
                                    <?php endif ?>
                                    <span class="label label-default" style="margin-left:10px;"><a href="<?=Url::to(['user/index','id' => $newPackage->uid])?>" style="color:#ffffff;"><?=$newDocument->user->user_name?></a></span>
                                    </li>
                                <?php endforeach ?>
                            <?php endif ?>
                        </ol>
                    </div>
                    <div class="tab-pane" id="newSoftwares">
                        <ol>
                            <?php if ($newSoftwares): ?>
                                <?php foreach ($newSoftwares as $newSoftware): ?>
                                    <li style="padding: 5px;">
                                    <?php if ($newSoftware->deleted == 0): ?>
                                        <a href="<?=Url::to(['detail/index','id' => $newSoftware->fid])?>" title="<?=$newSoftware->title?>"><?=mb_substr($newSoftware->title,0,50)?></a>
                                    <?php else: ?>
                                        <b>已失效</b> <del><a href="<?=Url::to(['detail/index','id' => $newSoftware->fid])?>" title="<?=$newSoftware->title?>"><?=mb_substr($newSoftware->title,0,50)?></a></del>
                                    <?php endif ?>
                                    <span class="label label-default" style="margin-left:10px;"><a href="<?=Url::to(['user/index','id' => $newSoftware->uid])?>" style="color:#ffffff;"><?=$newDocument->user->user_name?></a></span>
                                    </li>
                                <?php endforeach ?>
                            <?php endif ?>
                        </ol>
                    </div>
                    <div class="tab-pane" id="newTorrents">
                        <ol>
                            <?php if ($newTorrents): ?>
                                <?php foreach ($newTorrents as $newTorrent): ?>
                                    <li style="padding: 5px;">
                                    <?php if ($newTorrent->deleted == 0): ?>
                                        <a href="<?=Url::to(['detail/index','id' => $newTorrent->fid])?>" title="<?=$newTorrent->title?>"><?=mb_substr($newTorrent->title,0,50)?></a>
                                    <?php else: ?>
                                        <b>已失效</b> <del><a href="<?=Url::to(['detail/index','id' => $newTorrent->fid])?>" title="<?=$newTorrent->title?>"><?=mb_substr($newTorrent->title,0,50)?></a></del>
                                    <?php endif ?>
                                    <span class="label label-default" style="margin-left:10px;"><a href="<?=Url::to(['user/index','id' => $newTorrent->uid])?>" style="color:#ffffff;"><?=$newDocument->user->user_name?></a></span>
                                    </li>
                                <?php endforeach ?>
                            <?php endif ?>
                        </ol>
                    </div>
                    <div class="tab-pane" id="newOthers">
                        <ol>
                            <?php if ($newOthers): ?>
                                <?php foreach ($newOthers as $newOther): ?>
                                    <li style="padding: 5px;">
                                    <?php if ($newOther->deleted == 0): ?>
                                        <a href="<?=Url::to(['detail/index','id' => $newOther->fid])?>" title="<?=$newOther->title?>"><?=mb_substr($newOther->title,0,50)?></a>
                                    <?php else: ?>
                                        <b>已失效</b> <del><a href="<?=Url::to(['detail/index','id' => $newOther->fid])?>" title="<?=$newOther->title?>"><?=mb_substr($newOther->title,0,50)?></a></del>
                                    <?php endif ?>
                                    <span class="label label-default" style="margin-left:10px;"><a href="<?=Url::to(['user/index','id' => $newOther->uid])?>" style="color:#ffffff;"><?=$newDocument->user->user_name?></a></span>
                                    </li>
                                <?php endforeach ?>
                            <?php endif ?>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1"></div>
    </div>
</div>
<script type="text/javascript">
    $("#searchButton").click(function(){
        var key = $("#k").val();
        // var regu = "^[^a-zA-Z0-9\u4e00-\u9fa5]$";
        // var reg = new RegExp(regu);
        // var key = key.replace(reg, '');
        // if (!key) {return false;}
        window.location.href="/s-"+encodeURIComponent(key);
        return false;
    });
</script>
<?php echo \Yii::$app->view->renderFile('@frontend/views/layouts/footer.php'); ?>
