<?php
use yii\helpers\Url;
?>
<div class="col-md-4">
    <div style="padding:5px; border:1px solid #dddddd; border-radius: 5px; margin-bottom: 5px;">
        <center>
            <p><img src="<?=$data->user->avatar_url?>" class="media-object"/></p>
            <p>分享用户：<?=$data->user->user_name?></p>
            <p><a href="<?=Url::to(['user/index','id' => $data->user->uid])?>" class="btn btn-default">进入主页</a></p>
        </center>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">Ta 分享的最新资源：</div>
        <div class="list-group">
            <?php foreach ($userShares as $userShare): ?>
                <?php if ($userShare->shorturl): ?>
                    <a href="http://pan.baidu.com/s/<?=$userShare->shorturl?>" target="_blank" class="list-group-item"><?=$userShare->title?></a>
                <?php else: ?>
                    <a href="http://pan.baidu.com/share/link?shareid=<?=$userShare->shareid?>&uk=<?=$userShare->uk?>?>" target="_blank" class="list-group-item"><?=$userShare->title?></a>
                <?php endif ?>
            <?php endforeach ?>
        </div>
    </div>
    <!-- <div class="well">
        <center>
            <img src="https://placekitten.com/g/320/200" class="img-responsive">
        </center>
    </div> -->
</div>
