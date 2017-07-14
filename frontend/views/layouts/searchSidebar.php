<?php
use yii\helpers\Url;
use frontend\helpers\CheckMobileHelper;
?>
<div class="col-md-4">
    <div class="well">
        <h4>云上搜索</h4>
        <form action="<?=Url::to(['search/index'])?>">
        <div class="input-group">
            <input type="text" class="form-control" name="k" id="k" baiduSug="2" placeholder="暂只支持英文和中文搜索">
            <span class="input-group-btn">
                <button class="btn btn-info" id="searchButton" type="submit">
                    <i class="fa fa-fw fa-search"></i>
            </button>
            </span>
        </div>
        </form>
    </div>
</div>
<div class="col-md-4">
    <center>
        <!-- 广告位 -->
        <img src="/images/ggwzz.png" class="img-responsive">
        <br />
        <!-- 广告位 -->
        <?php if (CheckMobileHelper::isMobile()): ?>
            <center><script id="138wap_ad" src='http://wap.138lm.com/code/mobile/wap_cpc.php?uw=2&u=116227'></script></center>
        <?php else: ?>
            <center><iframe height='100' width='320' frameborder='no' scrolling='no' src= 'http://ue.ueadlian.com/code/adview_pic.php?r=1&c=7&w=320&h=100&b=FFFFCC&s=818181&bg=FFFFFF&p=FFFFFF&u=116227&at=p0&tt=t1'></iframe></center>
        <?php endif ?>
    </center>
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
