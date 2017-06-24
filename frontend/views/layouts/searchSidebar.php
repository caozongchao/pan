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
                <button class="btn btn-info" id="searchButton" type="button">
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
        window.location.href="/s-"+encodeURIComponent(key);
        return false;
    });
</script>
