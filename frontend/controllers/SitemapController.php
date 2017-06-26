<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Url;

class SitemapController extends Controller
{
    public function actionIndex()
    {
        $pageSize = 20000;
        $db = \Yii::$app->db;
        $summaryHandle = fopen('sitemap.xml','w+');
        $summaryBegin = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<sitemap>\n";
        $summaryEnd = "</sitemap>";
        $summaryContent = '';
        $date = date('Y-m-d H:i:s',time());
        $total = $db->createCommand("select count(*) from share_file")->queryScalar();
        $count = ceil($total/$pageSize);
        for ($i = 1; $i <= $count; $i++) {
            $offset = ($i-1) * $pageSize;
            $ids = $db->createCommand("select fid from share_file order by fid desc limit $offset,$pageSize")->queryColumn();
            $summaryContent .= "<loc>http://www.yssousuo.com/sitemap$i.xml</loc>\n";
            $summaryContent .= "<lastmod>$date</lastmod>\n";
            $detailHandle = fopen("sitemap$i.xml",'w+');
            $detailBegin = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<?xml-stylesheet type=\"text/xsl\" href=\"sitemap.xsl\"?>\n<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\" xmlns:mobile=\"http://www.baidu.com/schemas/sitemap-mobile/1/\">\n";
            $detailEnd = "</urlset>";
            $detailContent = '';
            foreach ($ids as $id) {
                $detailContent .= "<url>\n<mobile:mobile type=\"htmladapt\"/>\n<loc>http://www.yssousuo.com/d-$id</loc>\n<priority>0.80</priority>\n<lastmod>$date</lastmod>\n<changefreq>Always</changefreq>\n</url>\n";
            }
            fwrite($detailHandle, $detailBegin.$detailContent.$detailEnd);
            fclose($detailHandle);
        }
        fwrite($summaryHandle, $summaryBegin.$summaryContent.$summaryEnd);
        fclose($summaryHandle);
        echo 'success';
    }
}
?>
