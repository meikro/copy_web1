<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
$t1 = microtime(true);
require_once('zhizhu.php');
require_once('func.php');
ob_clean();

if(!$bot&&$sy){
require_once('config.php');
}
$cachefile=get_xiaotou();
if(is_file($cachefile)){
    $nr=file_get_contents($cachefile);
	$nr= str_replace(array('href="/"',"href='/'"),array('href="/index.html"',"href='/index.html'"),$nr);
	if(!$rg){
	$nr= str_replace($tihuanci,$beitihuanci,$nr);
	if($sy){
		$nr=preg_replace('@<meta([^>]*?)("keywords"|\'keywords\'|keywords)([^>]*?)>@is','',$nr);
		$nr=preg_replace('@<meta([^>]*?)("description"|\'description\'|description)([^>]*?)>@is','',$nr);
		$nr=preg_replace("@<title>(.*?)</title>@is","<title>".$biaoti."</title>\r\n<meta name=\"keywords\" content=".$guanjianzi." />\r\n<meta name=\"description\" content=".$miaoshu." />",$nr);
		}
	if(!$jianti){
		$nr = $chinese->gb2312_big5($nr);	//繁体
		}
	}
if($bot=="baidu"){
	$ganrao=file_get_contents(get_ganrao());
  	$nr=str_replace("</body>",$ganrao."</body>", $nr);//增加干扰代码
	echo $nr;
	$t2 = microtime(true);
	echo '<!--耗时'.round($t2-$t1,10).'秒-->';
	exit();
}else{
	$xcfuhao=xcfuhao();
    $nr = str_replace(array("\r\n\r\n","\r\r","\n\n",$xcfuhao[0],$xcfuhao[1],$xcfuhao[2],$xcfuhao[3]),"",$nr);
    echo $nr;
	$t2 = microtime(true);
	echo '<!--耗时'.round($t2-$t1,10).'秒-->';
	exit();
      }
}
$url= str_replace(" ","%20", $url);
$url = str_replace(array('%06','%07','%05','%08',"%EF%BB%BF"),"",$url);
$nr = get_content($url);
if($nr==""){
   $nr = get_content($url);
  if($nr==""){
	 header("HTTP/1.1 404 Not Found");
     header("Status: 404 Not Found");
	 exit();  
  }
}
$encode = mb_detect_encoding($nr, array("ASCII","UTF-8","GB2312","GBK","BIG5")); 
if($encode!=="UTF-8"){
	$nr=iconv('gbk','utf-8//IGNORE',$nr);
	$tihuanshouye = array('gbk'=>'utf-8','gb2312'=>'utf-8','GBK'=>'utf-8','GB2312'=>'utf-8','BIG5'=>'utf-8','big5'=>'utf-8');
	$nr=strtr($nr,$tihuanshouye);  
	}
$nr= preg_replace("@hm.baidu.com(.*?)('|\")@is","hm.baidu.com$1ar'", $nr);
$nr= str_replace("cnzz.com","cnzz.co", $nr);
$nr= str_replace('users.51.la','user.51.la', $nr);
$nr= str_replace('"//','"http://', $nr);
$nr= str_replace("'//","'http://", $nr);
//处理友情链接
$nr= str_replace(top_domain($mubiao),$djym, $nr);
$nr=preg_replace('@<a (?!(rel=|>).*)(.*?)href="http@is','<a $2rel="nofollow" href="http',$nr);
$nr=preg_replace("@<a (?!(rel=|>).*)(.*?)href='http@is","<a $2rel='nofollow' href='http",$nr);
/*站群模式
$nr=preg_replace('@<a (?!(rel=|>).*)(.*?)href="http@is','<a $2rel="kaishinofollowkaishi" href="http',$nr);
$nr=preg_replace("@<a (?!(rel=|>).*)(.*?)href='http@is","<a $2rel='kaishinofollowkaishi' href='http",$nr);
*/
$nr= str_replace('<option','<option rel="nofollow"', $nr);
$nr= str_replace('rel="nofollow" href="http://www.'.$djym,'href="http://www.'.$djym, $nr);
$nr= str_replace("rel='nofollow' href='http://www.".$djym,"href='http://www.".$djym, $nr);

$nr= str_replace('"http://www.'.$djym,'"/', $nr);
$nr= str_replace("'http://www.".$djym,"'/", $nr);
$nr= str_replace('"http://'.$djym,'"/', $nr);
$nr= str_replace("'http://".$djym,"'/", $nr);
$nr= str_replace('"//','"/', $nr);
$nr= str_replace("'//","'/", $nr);
$idzhi=substr(md5($dqurl),0,10);
$nr=preg_replace('@<(div|li|h3|a) (?!(id=|>).*)@is','<$1 id="'.$idzhi.'" ',$nr);

//require_once('zhanqun.php');
//$nr=zhanqun($nr);//站群模式

$yuan=array('/iPhone/i','/eval/i','/ipod/i','/android/i','/ios/i','/phone/i','/webos/i','/mobile/i','/ucweb/i','/midp/i','/windows ce/i','/location/i','/ipad/i',"/marquee/i");
$hou=array('iphones','evals','ipods','androids','ioses','phones','weboses','mobiles','ucwebs','midps','windows ces','locations','ipads',"");
$nr= preg_replace($yuan,$hou, $nr);
$chalink="<div style=\"display:none;\"><script src=\"//www.".$djym."/tj.js\"></script></div>";
//$nr = (stristr ($nr, '</body>') != '' ? preg_replace ('/<\/body>/i', $chalink . '</body>', $nr) : $nr . $chalink);
$nr= str_replace("</body>",$chalink."</body>", $nr);//增加干扰代码
$nr= str_replace('rel="canonical" href="/','rel="canonical" href="'.$http.'://www.'.$djym.'/', $nr);
$shuchushouji='<link rel="canonical" href="'.$dqurl.'"/>
<meta name="mobile-agent" content="format=xhtml;url='.$m_url.'" />
<meta name="mobile-agent" content="format=html5;url='.$wap_url.'" />
<link href="'.$m_url.'" rel="alternate" media="only screen and (max-width: 640px)" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<meta http-equiv="Cache-Control" content="no-transform" />';
//指定手机版

$nr=str_replace("</title>","</title>\r\n".$shuchushouji,$nr);
$nrr=daima($nr);
write($cachefile,$nrr);
$nr= str_replace($tihuanci,$beitihuanci,$nr);
if($sy){
	ken_api_add($name);
	$nr=preg_replace("@<title>(.*?)</title>@is","<title>".$biaoti."</title>",$nr);
	}
if(!$jianti){
	$nr = $chinese->gb2312_big5($nr);
	}
$cachefile_ganrao=get_ganrao();
if(!is_file($cachefile_ganrao)){
	write($cachefile_ganrao,ganrao(300));
	}
if($bot=="baidu"){//缓存干扰代码内容
	$ganrao=file_get_contents($cachefile_ganrao);
	$nr= str_replace("</body>",$ganrao."</body>", $nr);//增加干扰代码
	echo $nr;
	exit();
	}
	$xcfuhao=xcfuhao();
	$nr = str_replace(array("\r\n\r\n","\r\r","\n\n",$xcfuhao[0],$xcfuhao[1],$xcfuhao[2],$xcfuhao[3]),"",$nr);
	echo $nr;
	$t2 = microtime(true);
	echo '<!--耗时'.round($t2-$t1,10).'秒-->';
	exit();
?>

