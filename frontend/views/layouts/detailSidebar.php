<?php
use yii\helpers\Url;
use frontend\widgets\KeywordWidget;
use frontend\widgets\TopuserWidget;
use frontend\helpers\CheckMobileHelper;
?>
<link rel="stylesheet" type="text/css" href="/css/animate.css">
<div class="col-md-4">
    <div style="padding:5px; border:1px solid #dddddd; border-radius: 5px; margin-bottom: 5px;">
        <center>
            <p><img src="<?=$data->user->avatar_url?>" class="media-object"/></p>
            <p>分享用户：<?=$data->user->user_name?></p>
            <p>共 <?=$data->user->fetched?> 个分享</p>
            <p><a href="<?=Url::to(['user/index','id' => $data->user->uid])?>" class="btn btn-default">进入主页</a></p>
        </center>
    </div>
    <div class="panel panel-info" style="margin-top:15px;">
        <div class="panel-heading">分享达人</div>
        <center style="padding:5px 0px;background-color: #f5f5f5;"><?php echo TopuserWidget::widget() ?></center>
    </div>
    <div class="panel panel-info">
        <div class="panel-heading">热搜关键词</div>
        <?php echo KeywordWidget::widget() ?>
    </div>
    <center>
        <!-- 广告位 -->
        <?php if (CheckMobileHelper::isMobile()): ?>
            <center><script src="http://wm.lrswl.com/page/s.php?s=244076&w=200&h=200"></script></center>
        <?php else: ?>
            <center><script src="http://wm.lrswl.com/page/s.php?s=244076&w=200&h=200"></script></center>
        <?php endif ?>
    </center>
</div>
<script type="text/javascript">
$(function() {
    $(".animate-box").each(function(index, el) {
        $(this).hover(function(){
            $(this).addClass('shake');
        },function(){
            $(this).removeClass('shake');
        });
    });
});
</script>
