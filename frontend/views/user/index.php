<?php
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
use frontend\helpers\FormatSizeHelper;
use frontend\helpers\ColorHelper;
use yii\widgets\LinkPager;

$this->title = $user->user_name.'分享的网盘资源_云上搜索';
?>
<div class="container">
    <div class="row">
        <?php echo \Yii::$app->view->renderFile('@frontend/views/layouts/userSidebar.php',['user' => $user,'userHotShares' => $userHotShares]); ?>
        <div class="col-lg-9">
            <h4><?=$user->user_name?> 分享的资源列表：</h4>
            <hr>
            <div class="table-responsive">
                <ul class="media-list">
                    <?php foreach ($datas as $key => $value): ?>
                        <div class="media well">
                            <div class="media-body">
                                <h4 class="media-heading">
                                    <?php if ($value->deleted == 0): ?>
                                        <a href="<?=Url::to(['detail/index','id' => $value->fid])?>"><?=$value->title?></a>
                                    <?php else: ?>
                                        <b>已失效</b> <del><a href="<?=Url::to(['detail/index','id' => $value->fid])?>"><?=$value->title?></a></del>
                                    <?php endif?>
                                    <span class="badge" style="background-color: #99CC33">
                                        <?php if ($value->isdir): ?>
                                            目录
                                        <?php else: ?>
                                            文件
                                        <?php endif ?>
                                    </span>
                                </h4>
                                资源大小：<span class="badge" style="background-color: #99CCFF"><?=FormatSizeHelper::formatBytes($value->size)?></span><br />
                                收录日期：<span class="badge" style="background-color: #FF9999"><?=date('Y-m-d H:i:s',$value->create_time)?></span>&nbsp;&nbsp;
                                来源类型：<span class="badge" style="background-color: #FF9999">百度网盘资源</span>
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
                            $linkPager = LinkPager::widget([
                                'pagination'     => $pagination,
                                'firstPageLabel' => '<<',
                                'lastPageLabel'  => '>>',
                                'prevPageLabel'  => '<',
                                'nextPageLabel'  => '>',
                                'maxButtonCount' => 6
                            ]);
                            $linkPager = preg_replace('/href="(.*)\?(.*)p=(\d+)(.*)"/', "href='$1-$3'", $linkPager);
                            echo $linkPager;
                        ?>
                    </center>
                </nav>

            </div>
        </div>
    </div>
</div>
<?php echo \Yii::$app->view->renderFile('@frontend/views/layouts/contentFooter.php'); ?>
