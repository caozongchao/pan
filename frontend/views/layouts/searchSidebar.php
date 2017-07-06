<?php
use yii\helpers\Url;
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
        <iframe id="f" width="350px" height="350px" src= "https://info.lm.tv.sohu.com/c/0000000b4bc8b3b7ce00a7240538bc2530b12d4csk5/29187.do" frameborder="no" border="0" marginwidth="0" marginheight="0" allowtransparency="yes" scrolling="NO"> </iframe>
        <script src="http://wm.lrswl.com/page/s.php?s=242553&w=250&h=250"></script>
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
