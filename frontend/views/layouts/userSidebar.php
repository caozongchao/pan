<?php
use yii\helpers\Url;
?>
<div class="col-md-3">
    <div style="padding:5px; border:1px solid #dddddd; border-radius: 5px; margin-bottom: 5px;">
        <center>
            <p><img src="<?=$user->avatar_url?>" class="media-object"/></p>
            <p>分享用户：<?=$user->user_name?></p>
            <p>共 <?=$user->fetched?> 个分享</p>
        </center>
    </div>
    <div class="panel panel-info">
        <div class="panel-heading">Ta 分享的热门资源：</div>
        <div class="list-group">
            <?php if ($userHotShares): ?>
                <?php foreach ($userHotShares as $userHotShare): ?>
                    <?php if ($userHotShare->deleted == 0): ?>
                        <a href="<?=Url::to(['detail/index','id' => $userHotShare->fid])?>" target="_blank" class="list-group-item"><?=$userHotShare->title?></a>
                    <?php else: ?>
                        <del><a href="<?=Url::to(['detail/index','id' => $userHotShare->fid])?>" target="_blank" class="list-group-item"><?=$userHotShare->title?></a></del>
                    <?php endif?>
                <?php endforeach ?>
            <?php endif ?>
        </div>
    </div>
    <!-- <div class="well">
        <center>
            <img src="https://placekitten.com/g/320/200" class="img-responsive">
        </center>
    </div> -->
</div>
