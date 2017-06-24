<?php
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = '云上搜索,百度网盘搜索,百度云搜索_云上搜索';
?>
<div class="container" style="padding-top:60px;">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h2>云上搜索</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
            <form>
                <div class="input-group custom-search-form">
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
    <!-- /.row -->
</div>
<script type="text/javascript">
    $("#searchButton").click(function(){
        var key = $("#k").val();
        window.location.href="/s-"+encodeURIComponent(key);
        return false;
    });
</script>
<?php echo \Yii::$app->view->renderFile('@frontend/views/layouts/footer.php'); ?>
