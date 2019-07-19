<?php
error_reporting(E_ALL&~E_NOTICE);
@set_time_limit(120);
@ini_set('display_errors','On');
@ini_set('pcre.backtrack_limit', 1000000);
date_default_timezone_set('PRC');
header("Content-type: text/html; charset=utf-8");
$id=$_SERVER["REQUEST_URI"];
$url=explode('aric=',$id);
$url=str_replace("%EF%BB%BF","",trim($url[1]));
$lailu=parse_url($url, PHP_URL_HOST);
function get_content($url) {   
	    global $lailu;
        $curl = curl_init();  
		 $useragent = array(
            'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0)',
            'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)',
            'Opera/9.27 (Windows NT 5.2; U; zh-cn)',
            'Opera/8.0 (Macintosh; PPC Mac OS X; U; en)',
		 );	
        curl_setopt($curl, CURLOPT_URL, $url); //设置URL  
        curl_setopt($curl, CURLOPT_HEADER, 1);  //0输出内容；1输出头部信息
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);//允许请求的链接跳转  
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); //数据存到成字符串吧，别给我直接输出到屏幕了  
		curl_setopt($curl, CURLOPT_REFERER, $lailu); 
        curl_setopt($curl, CURLOPT_USERAGENT, $useragent[mt_rand(0,5)]);
        $data = curl_exec($curl); //开始执行啦～  
        $return = curl_getinfo($curl, CURLINFO_HTTP_CODE); //我知道HTTPSTAT码哦～  
		$count =  curl_close($curl); //用完记得关掉他  
		if($return=="200"){
			return $data;  
		}else{
			$data="";
			return $data;  
			}
} 

$nr=get_content($url);

if ($nr) {
    list($header, $body) = explode("\r\n\r\n", $nr, 2);
}
if(strpos($header,"200")==0){
    list($header, $body) = explode("\r\n\r\n", $body, 2);
}
if(strpos($header,"200")==0){
    list($header, $body) = explode("\r\n\r\n", $body, 2);
}



function type($header) {
    if (!empty($header)) {
        $spiderSite = array("html", "plain", "image", "zip", "pdf", "audio", "icon","css", "javascript", "json", "xml", "flash");
        foreach ($spiderSite as $val) {
            $str = strtolower($val);
            if (strpos($header, $str) !== false) {
                return $str;
            }
        }
    } else {
        return false;
    }
}

$shuchu=array("html"=>"Content-Type: text/html; charset=utf-8","plain"=>"Content-Type: text/plain","image"=>"Content-Type: image/jpeg","zip"=>"Content-Type: application/zip","pdf"=>"Content-Type: application/pdf","audio"=>"Content-Type: audio/mpeg","icon"=>"Content-Type: image/x-icon","css"=>"Content-type: text/css","javascript"=>"Content-type: text/javascript ","json"=>"Content-type: application/json","xml"=>"Content-type: text/xml","flash"=>"Content-Type: application/x-shockwave-flash");
$type=type($header);
ob_clean();
header("$shuchu[$type]");//curl输出header
$nr=$body;

$qidong=$type=="html"||$type=="css"||$type=="js"||$type=="plain"||$type=="json"||$type=="xml";

$encode = mb_detect_encoding($nr, array("ASCII","UTF-8","GB2312","GBK","BIG5")); 
if($encode!=="UTF-8"&&$qidong){
$nr=iconv('gbk','utf-8//IGNORE',$nr);
$tihuanshouye = array('gbk'=>'utf-8','gb2312'=>'utf-8','GBK'=>'utf-8','GB2312'=>'utf-8','BIG5'=>'utf-8','big5'=>'utf-8');
$nr=strtr($nr,$tihuanshouye);  
}
echo $nr;
exit();
?>