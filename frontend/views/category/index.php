<?php
use yii\widgets\LinkPager;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
use frontend\helpers\FormatSizeHelper;
use frontend\helpers\ColorHelper;
$this->title = $categoryName.'目录_云上搜索';
?>
<div class="container" style="padding-top:60px;">
    <div class="row">
        <div class="col-lg-8">
            <div class="btn-group">
                <?php foreach ($categorySecondLevel as $value): ?>
                    <?php if (count($categorySecondLevel) == 1): ?>
                        <button type="button" class="btn btn-default" disabled="disabled"><b><?=$value?></b></button>
                    <?php else: ?>
                        <a href="<?=Url::to(['category/second','id' => $id,'second' => $value])?>" class="btn btn-default"><b><?=$value?></b></a>
                    <?php endif?>
                <?php endforeach ?>
            </div>
            <hr>
            <div class="table-responsive">
                <ul class="media-list">
                    <?php foreach ($datas as $key => $value): ?>
                        <div class="media well">
                            <a href="<?=Url::to(['user/index','id' => $value->user->uid])?>" class="pull-left">
                                <img src="<?=$value->user->avatar_url?>" class="media-object" style="width:60px;" />
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">
                                    <a href="<?=Url::to(['detail/index','id' => $value->fid])?>"><?=$value->title?></a>
                                    <span class="badge" style="background-color: #99CC33">
                                        <?php if ($value->isdir): ?>
                                            目录
                                        <?php else: ?>
                                            文件
                                        <?php endif ?>
                                    </span>
                                </h4>
                                资源大小：<span class="badge" style="background-color: #99CCFF"><?=FormatSizeHelper::formatBytes($value->size)?></span><br />
                                分享日期：<span class="badge" style="background-color: #FF9999"><?=date('Y-m-d H:i:s',$value->create_time)?></span>
                            </div>
                            <div class="media-right" >
                                <a class="btn btn-default" href="#" style="width: 45px;height: 48px;padding: 0;line-height: 26px;font-weight: 500;color: #999;display: block;text-align: center; text-shadow: 0 1px 0 #fff; background-image: linear-gradient(to bottom, #fff 0%, #e0e0e0 100%)">
                                    <h4 style="font-weight: normal; margin: 0; line-height: 20px; background: #ddd;">浏览</h4><?=$value->click?>
                                </a>
                            </div>
                        </div>
                    <?php endforeach ?>
                </ul>
                <nav>
                    <center>
                        <?php
                            echo LinkPager::widget([
                                'pagination' => $pagination,
                            ]);
                        ?>
                    </center>
                </nav>

            </div>
        </div>
        <?php echo \Yii::$app->view->renderFile('@frontend/views/layouts/sidebar.php'); ?>
    </div>
</div>
<?php echo \Yii::$app->view->renderFile('@frontend/views/layouts/footerContent.php'); ?>
