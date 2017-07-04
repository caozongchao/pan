<?php
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
use frontend\helpers\FormatSizeHelper;
use frontend\helpers\ColorHelper;
use yii\widgets\LinkPager;

$this->title = HtmlPurifier::process($k).'搜索结果_云上搜索';
?>
<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <!-- 广告位 -->
            
            <h3>"<?=HtmlPurifier::process($k)?>"<small> 的搜索结果，<small>搜索引擎：<?=$type?></small></small></h3>
            <ul class="nav nav-pills">
                <?php foreach ([0 => '视频',1=> '图片',2=> '文档',3 => '音乐',4 => '压缩包',5 => '软件',6 => '种子',7 => '其他'] as $key => $value): ?>
                    <?php if ($category == $key): ?>
                        <li class="active"><a class="disabled"><?=$value?></a></li>
                    <?php else: ?>
                        <li><a href="<?=Url::to(['search/category','c' => $key,'k' => $k])?>"><?=$value?></a></li>
                    <?php endif?>
                <?php endforeach ?>
            </ul>
            <ul class="nav nav-pills">
                <?php if ($categorySecondLevel): ?>
                    <?php foreach ($categorySecondLevel as $key => $value): ?>
                        <?php if (count($categorySecondLevel) == 1): ?>
                            <li class="active"><a class="disabled"><?=$value?></a></li>
                        <?php else: ?>
                            <?php if ($value == $second): ?>
                                <li class="active"><a class="disabled"><?=$value?></a></li>
                            <?php else: ?>
                                <li><a href="<?=Url::to(['search/second','c' => $category,'k' => $k,'s' => $value])?>"><?=$value?></a></li>
                            <?php endif ?>
                        <?php endif?>
                    <?php endforeach ?>
                <?php endif ?>
            </ul>
            <hr>
            <div class="table-responsive">
                <ul class="media-list">
                    <?php if ($datas): ?>
                        <?php foreach ($datas as $key => $value): ?>
                        <?php if ($key == 10): ?>
                            <!-- 广告位 -->
                            
                        <?php endif ?>
                        <div class="media well">
                            <a href="<?=Url::to(['user/index','id' => $value->user->uid])?>" class="pull-left">
                                <img src="<?=$value->user->avatar_url?>" class="media-object" style="width:60px;" />
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">
                                    <?php if ($value->deleted == 0): ?>
                                        <a href="<?=Url::to(['detail/index','id' => $value->fid])?>"><?=ColorHelper::red($value->title,$k)?></a>
                                    <?php else: ?>
                                        <b>已失效</b> <del><a href="<?=Url::to(['detail/index','id' => $value->fid])?>"><?=ColorHelper::red($value->title,$k)?></a></del>
                                    <?php endif ?>
                                    <span class="badge" style="background-color: #99CC33">
                                        <?php if ($value->isdir): ?>
                                            目录
                                        <?php else: ?>
                                            文件
                                        <?php endif ?>
                                    </span>
                                </h4>
                                资源大小：<span class="badge" style="background-color: #99CCFF"><?=FormatSizeHelper::formatBytes($value->size)?></span><br />
                                收录日期：<span class="badge" style="background-color: #DD9990"><?=date('Y-m-d H:i:s',$value->create_time)?></span>&nbsp;&nbsp;
                                来源类型：<span class="badge" style="background-color: #FF9999">百度网盘资源</span>
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
                        <?php if (isset($pagination)): ?>
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
                        <?php endif ?>
                    </center>
                </nav>
            </div>
        </div>
        <?php echo \Yii::$app->view->renderFile('@frontend/views/layouts/searchSidebar.php'); ?>
    </div>
</div>
<?php echo \Yii::$app->view->renderFile('@frontend/views/layouts/contentFooter.php'); ?>
