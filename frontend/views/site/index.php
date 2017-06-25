<?php
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = '云上搜索,百度网盘搜索,百度云搜索_云上搜索';
?>
<div class="container" style="padding-top:60px;">
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
                    <input type="text" class="form-control" name="k" id="k">
                    <span class="input-group-btn">
                        <button class="btn btn-info" id="searchButton" type="submit">
                            <i class="fa fa-fw fa-search"></i>
                        </button>
                    </span>
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
                            <?php foreach ($newVideos as $newVideo): ?>
                                <li style="padding: 5px;"><a href="<?=Url::to(['detail/index','id' => $newVideo->fid])?>" title="<?=$newVideo->title?>"><?=mb_substr($newVideo->title,0,60)?></a><span class="label label-default" style="margin-left:10px;"><a href="<?=Url::to(['user/index','id' => $newVideo->uid])?>" style="color:#ffffff;"><?=$newVideo->user->user_name?></a></span>
                                    <span class="badge" style="background-color: #999999;margin-left: 10px;">
                                        <?php if ($newVideo->isdir): ?>
                                            目录
                                        <?php else: ?>
                                            文件
                                        <?php endif ?>
                                    </span>
                                </li>
                            <?php endforeach ?>
                        </ol>
                    </div>
                    <div class="tab-pane" id="newImages">
                        <ol>
                            <?php foreach ($newImages as $newImage): ?>
                                <li style="padding: 5px;"><a href="<?=Url::to(['detail/index','id' => $newImage->fid])?>" title="<?=$newImage->title?>"><?=mb_substr($newImage->title,0,60)?></a><span class="label label-default" style="margin-left:10px;"><a href="<?=Url::to(['user/index','id' => $newImage->uid])?>" style="color:#ffffff;"><?=$newImage->user->user_name?></a></span>
                                    <span class="badge" style="background-color: #999999;margin-left: 10px;">
                                        <?php if ($newImage->isdir): ?>
                                            目录
                                        <?php else: ?>
                                            文件
                                        <?php endif ?>
                                    </span>
                                </li>
                            <?php endforeach ?>
                        </ol>
                    </div>
                    <div class="tab-pane" id="newDocuments">
                        <ol>
                            <?php foreach ($newDocuments as $newDocument): ?>
                                <li style="padding: 5px;"><a href="<?=Url::to(['detail/index','id' => $newDocument->fid])?>" title="<?=$newDocument->title?>"><?=mb_substr($newDocument->title,0,60)?></a><span class="label label-default" style="margin-left:10px;"><a href="<?=Url::to(['user/index','id' => $newDocument->uid])?>" style="color:#ffffff;"><?=$newDocument->user->user_name?></a></span>
                                <span class="badge" style="background-color: #999999;margin-left: 10px;">
                                        <?php if ($newDocument->isdir): ?>
                                            目录
                                        <?php else: ?>
                                            文件
                                        <?php endif ?>
                                    </span>
                                </li>
                            <?php endforeach ?>
                        </ol>
                    </div>
                    <div class="tab-pane" id="newMusics">
                        <ol>
                            <?php foreach ($newMusics as $newMusic): ?>
                                <li style="padding: 5px;"><a href="<?=Url::to(['detail/index','id' => $newMusic->fid])?>" title="<?=$newMusic->title?>"><?=mb_substr($newMusic->title,0,60)?></a><span class="label label-default" style="margin-left:10px;"><a href="<?=Url::to(['user/index','id' => $newMusic->uid])?>" style="color:#ffffff;"><?=$newDocument->user->user_name?></a></span>
                                    <span class="badge" style="background-color: #999999;margin-left: 10px;">
                                        <?php if ($newMusic->isdir): ?>
                                            目录
                                        <?php else: ?>
                                            文件
                                        <?php endif ?>
                                    </span>
                                </li>
                            <?php endforeach ?>
                        </ol>
                    </div>
                    <div class="tab-pane" id="newPackages">
                        <ol>
                            <?php foreach ($newPackages as $newPackage): ?>
                                <li style="padding: 5px;"><a href="<?=Url::to(['detail/index','id' => $newPackage->fid])?>" title="<?=$newPackage->title?>"><?=mb_substr($newPackage->title,0,60)?></a><span class="label label-default" style="margin-left:10px;"><a href="<?=Url::to(['user/index','id' => $newPackage->uid])?>" style="color:#ffffff;"><?=$newDocument->user->user_name?></a></span>
                                <span class="badge" style="background-color: #999999;margin-left: 10px;">
                                    <?php if ($newPackage->isdir): ?>
                                        目录
                                    <?php else: ?>
                                        文件
                                    <?php endif ?>
                                </span>
                                </li>
                            <?php endforeach ?>
                        </ol>
                    </div>
                    <div class="tab-pane" id="newSoftwares">
                        <ol>
                            <?php foreach ($newSoftwares as $newSoftware): ?>
                                <li style="padding: 5px;"><a href="<?=Url::to(['detail/index','id' => $newSoftware->fid])?>" title="<?=$newSoftware->title?>"><?=mb_substr($newSoftware->title,0,60)?></a><span class="label label-default" style="margin-left:10px;"><a href="<?=Url::to(['user/index','id' => $newSoftware->uid])?>" style="color:#ffffff;"><?=$newDocument->user->user_name?></a></span>
                                <span class="badge" style="background-color: #999999;margin-left: 10px;">
                                    <?php if ($newSoftware->isdir): ?>
                                        目录
                                    <?php else: ?>
                                        文件
                                    <?php endif ?>
                                </span>
                                </li>
                            <?php endforeach ?>
                        </ol>
                    </div>
                    <div class="tab-pane" id="newTorrents">
                        <ol>
                            <?php foreach ($newTorrents as $newTorrent): ?>
                                <li style="padding: 5px;"><a href="<?=Url::to(['detail/index','id' => $newTorrent->fid])?>" title="<?=$newTorrent->title?>"><?=mb_substr($newTorrent->title,0,60)?></a><span class="label label-default" style="margin-left:10px;"><a href="<?=Url::to(['user/index','id' => $newTorrent->uid])?>" style="color:#ffffff;"><?=$newDocument->user->user_name?></a></span>
                                <span class="badge" style="background-color: #999999;margin-left: 10px;">
                                    <?php if ($newTorrent->isdir): ?>
                                        目录
                                    <?php else: ?>
                                        文件
                                    <?php endif ?>
                                </span>
                                </li>
                            <?php endforeach ?>
                        </ol>
                    </div>
                    <div class="tab-pane" id="newOthers">
                        <ol>
                            <?php foreach ($newOthers as $newOther): ?>
                                <li style="padding: 5px;"><a href="<?=Url::to(['detail/index','id' => $newOther->fid])?>" title="<?=$newOther->title?>"><?=mb_substr($newOther->title,0,60)?></a><span class="label label-default" style="margin-left:10px;"><a href="<?=Url::to(['user/index','id' => $newOther->uid])?>" style="color:#ffffff;"><?=$newDocument->user->user_name?></a></span>
                                    <span class="badge" style="background-color: #999999;margin-left: 10px;">
                                        <?php if ($newOther->isdir): ?>
                                            目录
                                        <?php else: ?>
                                            文件
                                        <?php endif ?>
                                    </span>
                                </li>
                            <?php endforeach ?>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1"></div>
    </div>

</div>
<script type="text/javascript">
    // $("#searchButton").click(function(){
    //     var key = $("#k").val();
    //     // var regu = "^[^a-zA-Z0-9\u4e00-\u9fa5]$";
    //     // var reg = new RegExp(regu);
    //     // var key = key.replace(reg, '');
    //     // if (!key) {return false;}
    //     window.location.href="/s-"+encodeURIComponent(key);
    //     return false;
    // });
</script>
<?php echo \Yii::$app->view->renderFile('@frontend/views/layouts/footer.php'); ?>
