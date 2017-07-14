<?php
use yii\helpers\Url;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
$this->title = $topicName.'专题_云上搜索';
?>
<style type="text/css">
.show{display: block;background: #ffffff;position: relative;overflow: hidden;-webkit-border-radius: 5px;-moz-border-radius: 5px;-ms-border-radius: 5px;border-radius: 5px;-webkit-box-shadow: 0 0.15em 0.15em 0 rgba(0, 0, 0, 0.3);-moz-box-shadow: 0 0.15em 0.15em 0 rgba(0, 0, 0, 0.3);-ms-box-shadow: 0 0.15em 0.15em 0 rgba(0, 0, 0, 0.3);-o-box-shadow: 0 0.15em 0.15em 0 rgba(0, 0, 0, 0.3);box-shadow: 0 0.15em 0.15em 0 rgba(0, 0, 0, 0.3);margin-bottom: 30px;border-bottom: none;bottom: 0;-webkit-transition: all 0.3s ease;-moz-transition: all 0.3s ease;-ms-transition: all 0.3s ease;-o-transition: all 0.3s ease;transition: all 0.3s ease; color:#8b969c;}
.show a{text-decoration: none;}
</style>
<link rel="stylesheet" type="text/css" href="/css/animate.css">
<div class="container">
    <div class="row">
        <?php foreach ($datas as $data): ?>
            <div class="piece col-xs-3 col-sm-3 col-md-3 col-lg-3 animate-box fadeInDown animated">
                <?php
                    switch ($type) {
                        case '0':
                        case '1':
                            echo '<a href="/sd-0-'.urlencode($data->title).'" class="show">
                                <div class="text-center">
                                    <h4>'.$data->title.'</h4>
                                </div>
                            </a>';
                            break;
                        case '3':
                            echo '<a href="/sd-2-'.urlencode($data->title).'" class="show" >
                                <div class="text-center">
                                    <h4>'.$data->title.'</h4>
                                </div>
                            </a>';
                            break;
                    }
                ?>
            </div>
        <?php endforeach ?>
        <nav class="clearfix visible-x">
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
<script type="text/javascript">
$(function() {
    $(".piece").each(function(index, el) {
        $(this).hover(function(){
            $(this).removeClass('fadeInDown');
            $(this).addClass('rubberBand');
            $(this).find('h4').css("color","#57cecd");
        },function(){
            $(this).removeClass('rubberBand');
            $(this).find('h4').css("color","#8b969c");
        });
    });
});
</script>