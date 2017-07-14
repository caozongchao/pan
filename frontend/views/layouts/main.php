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
    <meta http-equiv="Cache-Control" content="no-transform " />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
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
                    <li><a href="#" id="contactMe" data-container="body" data-toggle="popover" data-placement="bottom" tabindex="0" role="button" style="outline:none;">联系我</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container" style="padding-top:60px;">
        <div class="row">
            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1"></div>
                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 text-center">
                    <!-- 广告位 -->
                </div>
            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1"></div>
        </div>
    </div>
    <?//= Alert::widget() ?>
    <?=$content;?>
<?php $this->endBody() ?>

<!-- 百度搜索提示框 -->
<script charset="gbk" src="http://www.baidu.com/js/opensug.js"></script>
<!-- 移动端admin5广告位 -->
<script src='http://slb.jiehantai.com/46573'></script>

<!-- 百度自动推送 -->
<script>
(function(){
    var bp = document.createElement('script');
    var curProtocol = window.location.protocol.split(':')[0];
    if (curProtocol === 'https') {
        bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';
    }
    else {
        bp.src = 'http://push.zhanzhang.baidu.com/push.js';
    }
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(bp, s);
})();
</script>

<!-- 360自动推送 -->
<script>
(function(){
   var src = (document.location.protocol == "http:") ? "http://js.passport.qihucdn.com/11.0.1.js?61624e2947e96a705a2bd91995de60af":"https://jspassport.ssl.qhimg.com/11.0.1.js?61624e2947e96a705a2bd91995de60af";
   document.write('<script src="' + src + '" id="sozz"><\/script>');
})();
</script>

<!-- 右上角联系我js代码 -->
<script type="text/javascript">
$(function () { $("[data-toggle='popover']").popover(); });
$('#contactMe').popover({
    trigger : 'click',//鼠标以上时触发弹出提示框
    html:true,//开启html 为true的话，data-content里就能放html代码了
    content:'<center>微信<br /><img src="/images/wxmp.jpg" width="150"></center>'
});
</script>
</body>
</html>
<?php $this->endPage() ?>
