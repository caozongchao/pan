<?php
use yii\helpers\Url;
?>
<!-- Sidebar widgets column -->
<div class="col-md-4">
    <!-- Torrent search well -->
    <div class="well">
        <h4>云上搜索</h4>
        <form action="<?=Url::to(['site/search'])?>">
        <div class="input-group">
            <input type="text" class="form-control" name="k">
            <span class="input-group-btn">
                <button class="btn btn-info" type="submit">
                    <i class="fa fa-fw fa-search"></i>
            </button>
            </span>
        </div>
        </form>
        <!-- /.input-group -->
    </div>
    <!-- Add well -->
    <!-- <div class="well">
        <center>
            <img src="https://placekitten.com/g/320/200" class="img-responsive">
        </center>
    </div> -->
</div><!-- /.sidebar-->
