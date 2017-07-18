<?php
use yii\helpers\Url;
use frontend\helpers\CheckMobileHelper;

?>
<div class="container">
    <div class="row">
        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1"></div>
            <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 text-center">
                <!-- pc端cpv广告位 -->
                <?php if (CheckMobileHelper::isMobile()): ?>
                    <center></center>
                <?php else: ?>
                    <center><script src="http://wm.lrswl.com/page/s.php?s=243886&w=950&h=90"></script></center>
                <?php endif ?>
            </div>
        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1"></div>
    </div>
</div>
<hr>
<div class="container">
    <div class="row">
        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
            <center>
                <p>本站仅提供百度网盘资源搜索，只抓取百度网盘的链接而不保存任何资源.</p>
                <p>本站所有资源均来自互联网，只负责技术收集和整理，均不承担任何法律责任。</p>
                <p>如有侵权违规等其它行为请通过右上角方式联系我。 </p>
            </center>
        </div>
        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
    </div>
</div>
