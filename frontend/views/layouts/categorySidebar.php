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
        <!-- 搜狐联盟广告位 -->
        <iframe id="f" width="350px" height="350px" src= "https://info.lm.tv.sohu.com/c/0000000b4bc8b3b7ce00a7240538bc2530b12d4csk5/29187.do" frameborder="no" border="0" marginwidth="0" marginheight="0" allowtransparency="yes" scrolling="NO"> </iframe>
        <!-- 淘宝tanx -->
        <script type="text/javascript">
            document.write('<a style="display:none!important" id="tanx-a-mm_26539241_33090324_118706297"></a>');
            tanx_s = document.createElement("script");
            tanx_s.type = "text/javascript";
            tanx_s.charset = "gbk";
            tanx_s.id = "tanx-s-mm_26539241_33090324_118706297";
            tanx_s.async = true;
            tanx_s.src = "http://p.tanx.com/ex?i=mm_26539241_33090324_118706297";
            tanx_h = document.getElementsByTagName("head")[0];
            if(tanx_h)tanx_h.insertBefore(tanx_s,tanx_h.firstChild);
        </script>
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
