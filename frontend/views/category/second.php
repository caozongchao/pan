<?php
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
use frontend\helpers\FormatSizeHelper;
use frontend\helpers\CheckMobileHelper;
use frontend\helpers\ColorHelper;
use yii\widgets\LinkPager;
use yii\widgets\Breadcrumbs;

$this->title = $categoryName.$second.'资源目录_云上搜索';
$this->title = $categoryName.'资源目录_云上搜索';
$this->params['breadcrumbs'][] = ['label' => $categoryName,'url' => [Url::to(['category/index','id' => $id])]];
$this->params['breadcrumbs'][] = ['label' => $second];
?>
<div class="container">
    <div class="row">
        <?php echo \Yii::$app->view->renderFile('@frontend/views/layouts/categorySidebar.php',['top10' => $top10]); ?>
        <div class="col-lg-8">
            <!-- 广告位 -->
            <?php if (CheckMobileHelper::isMobile()): ?>
                <center></center>
            <?php else: ?>
                <center></center>
            <?php endif ?>
            <?= Breadcrumbs::widget([
                'homeLink'=>[
                    'label' => '首页',
                    'url' => Yii::$app->homeUrl
                ],
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <ul class="nav nav-pills">
                <?php foreach ($categorySecondLevel as $value): ?>
                    <?php if (count($categorySecondLevel) == 1): ?>
                        <li class="active"><a class="disabled"><?=$value?></a></li>
                    <?php else: ?>
                        <?php if ($value == $second): ?>
                            <li class="active"><a class="disabled"><?=$value?></a></li>
                        <?php else: ?>
                            <li><a href="<?=Url::to(['category/second','id' => $id,'second' => $value])?>"><?=$value?></a></li>
                        <?php endif ?>
                    <?php endif?>
                <?php endforeach ?>
            </ul>
            <hr>
            <div class="table-responsive">
                <ul class="media-list">
                    <?php if ($datas): ?>
                        <?php foreach ($datas as $key => $value): ?>
                            <?php if ($key == 10): ?>
                                <!-- 广告位 -->
                                <center></center>
                            <?php endif ?>
                            <div class="media well">
                                <a href="<?=Url::to(['user/index','id' => $value->user->uid])?>" class="pull-left">
                                    <img src="<?=$value->user->avatar_url?>" class="media-object" style="width:60px;" />
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading">
                                        <?php if ($value->isdir): ?>
                                            <span class="fa fa-folder" style="color: #99CC33"></span>
                                        <?php else: ?>
                                            <span class="fa fa-file" style="color: #99CC33"></span>
                                        <?php endif ?>
                                        <?php if ($value->deleted == 0): ?>
                                            <a href="<?=Url::to(['detail/index','id' => $value->fid])?>"><?=$value->title?></a>
                                        <?php else: ?>
                                            <b>已失效</b> <del><a href="<?=Url::to(['detail/index','id' => $value->fid])?>"><?=$value->title?></a></del>
                                        <?php endif ?>
                                    </h4>
                                    资源大小：<span class="badge" style="background-color: #99CCFF"><?=FormatSizeHelper::formatBytes($value->size)?></span><br />
                                    本站收录日期：<span class="badge" style="background-color: #FF9999"><?=date('Y-m-d H:i:s',$value->create_time)?></span>&nbsp;&nbsp;
                                    来源类型：<span class="badge" style="background-color: #FF9999">百度云资源</span>
                                </div>
                                <div class="media-right" >
                                    <a class="btn btn-default" href="#" style="width: 45px;height: 48px;padding: 0;line-height: 26px;font-weight: 500;color: #999;display: block;text-align: center; text-shadow: 0 1px 0 #fff; background-image: linear-gradient(to bottom, #fff 0%, #e0e0e0 100%)">
                                        <h4 style="font-weight: normal; margin: 0; line-height: 20px; background: #ddd;">浏览</h4><?=$value->click?>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach ?>
                    <?php else: ?>
                        <div class="alert alert-danger">
                            <h4>提示!</h4>
                            <strong>暂无!</strong> 相关资源，请联系管理员或稍后搜索尝试。
                        </div>
                    <?php endif ?>
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
