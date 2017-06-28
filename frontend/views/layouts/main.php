<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\Url;

AppAsset::register($this);
rmrevin\yii\fontawesome\AssetBundle::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="云上搜索,百度网盘搜索,百度云搜索,百度网盘资源,百度云资源" />
    <meta name="description" content="云上搜索，是搜索百度网盘资源的利器，收录百度云资源，每天更新各类视频，种子，小说，壁纸，音乐等优质资源。方便的百度网盘搜索，简洁的百度云搜索，尽在云上搜索" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
<style type="text/css">
a{word-break: break-all;word-wrap: break-word;}
</style>
<!-- 百度统计 -->
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?c8ace86c3b6a855063bf104f04a0e440";
  var s = document.getElementsByTagName("script")[0];
  s.parentNode.insertBefore(hm, s);
})();
</script>
<!-- 百度统计 -->
<!-- 百度分享 -->
<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"slide":{"type":"slide","bdImg":"0","bdPos":"right","bdTop":"100"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["qzone","tsina","tqq","renren","weixin"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
<!-- 百度分享 -->
</head>
<body>
<?php $this->beginBody() ?>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?=Yii::$app->homeUrl?>">云上搜索</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="<?=Url::to(['category/index','id' => 0])?>">视频</a></li>
                    <li><a href="<?=Url::to(['category/index','id' => 1])?>">图片</a></li>
                    <li><a href="<?=Url::to(['category/index','id' => 2])?>">文档</a></li>
                    <li><a href="<?=Url::to(['category/index','id' => 3])?>">音乐</a></li>
                    <li><a href="<?=Url::to(['category/index','id' => 4])?>">压缩包</a></li>
                    <li><a href="<?=Url::to(['category/index','id' => 5])?>">软件</a></li>
                    <li><a href="<?=Url::to(['category/index','id' => 6])?>">种子</a></li>
                    <li><a href="<?=Url::to(['category/index','id' => 7])?>">其他</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="javascript:void(0)" data-toggle="modal" data-target=".juanzeng" style="outline:none;">与您相伴</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <?=$content;?>
<?php $this->endBody() ?>
<!-- JiaThis Button BEGIN -->
<script type="text/javascript" >
var jiathis_config={
    siteNum:10,
    sm:"cqq,weixin,tsina,tqq,qzone,tieba,douban,ishare",
    summary:"",
    boldNum:6,
    showClose:true,
    shortUrl:false,
    hideMore:false
}
</script>
<!-- <script type="text/javascript" src="http://v3.jiathis.com/code/jiathis_r.js?btn=r.gif&move=1" charset="utf-8"></script> -->
<!-- JiaThis Button END -->
<div>
    <div class="modal fade juanzeng" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-sm" style="width:560px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="mySmallModalLabel">云上搜索与您相伴，请捐助我。</h4>
                </div>
                <div class="modal-body">
                    <div style="text-align:center;">
                        <div style="display:inline-block;">
                            <center>微信捐赠</center>
                            <img src="/images/wxsq.png">
                        </div>
                        <div style="display:inline-block;margin-left:40px;">
                            <center>支付宝捐赠</center>
                            <img src="/images/zfbsq.png">
                        </div>
                        <div style="font-weight:bold;margin-top:15px;">
                            <center>如需联系请加微信</center>
                            <center><img src="/images/wxmp.jpg" style="width:200px;"></center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 百度搜索提示框 -->
<script charset="gbk" src="http://www.baidu.com/js/opensug.js"></script>
</body>
</html>
<?php $this->endPage() ?>
