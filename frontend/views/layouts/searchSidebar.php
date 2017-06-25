<?php
use yii\helpers\Url;
?>
<div class="col-md-4">
    <div class="well">
        <h4>云上搜索</h4>
        <form>
        <div class="input-group">
            <input type="text" class="form-control" name="k" id="k">
            <span class="input-group-btn">
                <button class="btn btn-info" id="searchButton" type="submit">
                    <i class="fa fa-fw fa-search"></i>
            </button>
            </span>
        </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    $("#searchButton").click(function(){
        var key = $("#k").val();
        var regu = "^[^a-zA-Z0-9\u4e00-\u9fa5]$";
        var reg = new RegExp(regu);
        var rep = key.replace(reg, '');
        if (!rep) {return false;}
        window.location.href="/s-"+encodeURIComponent(rep);
        return false;
    });
</script>
