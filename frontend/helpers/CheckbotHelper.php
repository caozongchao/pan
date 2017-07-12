<?php
namespace frontend\helpers;

use Yii;

class CheckbotHelper{

    /**
     * [checkRobot description]
     * @Author czc
     *  if(check1()){
            echo '机器人爬虫';
        }else{
            echo '人';
        }
     */
    public static function check1($useragent=''){
        static $kw_spiders = array('bot', 'crawl', 'spider' ,'slurp', 'sohu-search', 'lycos', 'robozilla');
        static $kw_browsers = array('msie', 'netscape', 'opera', 'konqueror', 'mozilla');

        $useragent = strtolower(empty($useragent) ? $_SERVER['HTTP_USER_AGENT'] : $useragent);
        if(strpos($useragent, 'http://') === false && $this->dstrpos($useragent, $kw_browsers)) return false;
        if($this->dstrpos($useragent, $kw_spiders)) return true;
        return false;
    }

    public function dstrpos($string, $arr, $returnvalue = false) {
        if(empty($string)) return false;
        foreach((array)$arr as $v) {
            if(strpos($string, $v) !== false) {
                $return = $returnvalue ? $v : true;
                return $return;
            }
        }
        return false;
    }

    public static function check2()
    {
        $useragent = addslashes(strtolower($_SERVER['HTTP_USER_AGENT']));
        if (strpos($useragent, 'googlebot')!== false){$bot = 'Google';}
        elseif (strpos($useragent,'mediapartners-google') !== false){$bot = 'Google Adsense';}
        elseif (strpos($useragent,'baiduspider') !== false){$bot = 'Baidu';}
        elseif (strpos($useragent,'sogou spider') !== false){$bot = 'Sogou';}
        elseif (strpos($useragent,'sogou web') !== false){$bot = 'Sogou web';}
        elseif (strpos($useragent,'sosospider') !== false){$bot = 'SOSO';}
        elseif (strpos($useragent,'360spider') !== false){$bot = '360Spider';}
        elseif (strpos($useragent,'yahoo') !== false){$bot = 'Yahoo';}
        elseif (strpos($useragent,'msn') !== false){$bot = 'MSN';}
        elseif (strpos($useragent,'msnbot') !== false){$bot = 'msnbot';}
        elseif (strpos($useragent,'sohu') !== false){$bot = 'Sohu';}
        elseif (strpos($useragent,'yodaoBot') !== false){$bot = 'Yodao';}
        elseif (strpos($useragent,'twiceler') !== false){$bot = 'Twiceler';}
        elseif (strpos($useragent,'ia_archiver') !== false){$bot = 'Alexa_';}
        elseif (strpos($useragent,'iaarchiver') !== false){$bot = 'Alexa';}
        elseif (strpos($useragent,'slurp') !== false){$bot = '雅虎';}
        elseif (strpos($useragent,'bot') !== false){$bot = '其它蜘蛛';}
        if(isset($bot)){
            return true;
        }
    }

    public static function check3()
    {
        $agent= strtolower($_SERVER['HTTP_USER_AGENT']);
        if (!empty($agent)) {
            $spiderSite= array(
                "TencentTraveler",
                "Baiduspider+",
                "BaiduGame",
                "Googlebot",
                "msnbot",
                "Sosospider+",
                "Sogou web spider",
                "ia_archiver",
                "Yahoo! Slurp",
                "YoudaoBot",
                "Yahoo Slurp",
                "MSNBot",
                "Java (Often spam bot)",
                "BaiDuSpider",
                "Voila",
                "Yandexbot",
                "BSpider",
                "twiceler",
                "Sogou Spider",
                "Speedy Spider",
                "Google AdSense",
                "Heritrix",
                "Python-urllib",
                "Alexa (IA Archiver)",
                "Ask",
                "Exabot",
                "Custo",
                "OutfoxBot/YodaoBot",
                "yacy",
                "SurveyBot",
                "legs",
                "lwp-trivial",
                "Nutch",
                "StackRambler",
                "The web archive (IA Archiver)",
                "Perl tool",
                "MJ12bot",
                "Netcraft",
                "MSIECrawler",
                "WGet tools",
                "larbin",
                "Fish search",
            );
            foreach($spiderSite as $val) {
                $str = strtolower($val);
                if (strpos($agent, $str) !== false) {
                    return true;
                }
            }
        } else {
            return false;
        }
    }
}
