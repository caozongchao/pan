<?php
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = '磁力搜索-bt搜索-磁力链接-迅雷下载_水熊BT';
?>
<div class="container" style="padding-top:60px;">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h2>云上搜索</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
            <form action="<?=Url::to(['site/search'])?>">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" name="k">
                    <span class="input-group-btn">
                        <button class="btn btn-info" type="submit">
                            <i class="fa fa-fw fa-search"></i>
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </div>
    <!-- /.row -->
</div>
<?php echo \Yii::$app->view->renderFile('@frontend/views/layouts/footer.php'); ?>
