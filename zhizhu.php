<?php
error_reporting(0);
set_time_limit(0);
function ye_spider() {
    $agent = strtolower($_SERVER['HTTP_USER_AGENT']);
    if (!empty($agent)) {
        $spiderSite = array("google", "mj12bot","megaindex","dotbot","semrushbot","blexbot","alphabot");
        foreach ($spiderSite as $val) {
            $str = strtolower($val);
            if (strpos($agent, $str) !== false) {
                header("HTTP/1.1 404 Not Found");
				header("Status: 404 Not Found");
			exit();
            }
        }
    } else {
        return false;
    }
}
echo ye_spider();
function zhizhu() {
    $agent = strtolower($_SERVER['HTTP_USER_AGENT']);
    if (!empty($agent)) {
        $spiderSite = array("baidu", "sogou", "360", "yisou", "bing");
        foreach ($spiderSite as $val) {
            $str = strtolower($val);
            if (strpos($agent, $str) !== false) {
                return $str;
            }
        }
    } else {
        return false;
    }
}
function getIp() {
    if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
        $cip = $_SERVER["HTTP_CLIENT_IP"];
    } elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
        $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
    } elseif (!empty($_SERVER["REMOTE_ADDR"])) {
        $cip = $_SERVER["REMOTE_ADDR"];
    } else {
        $cip = '';
    }
    preg_match("/[\d\.]{7,15}/", $cip, $cips);
    $cip = isset($cips[0]) ? $cips[0] : 'unknown';
    unset($cips);
    return $cip;
}
$bot=zhizhu();
$ip=getIp();
$s_rq=date('Y-m-d');
$l_xipx=explode('.',$ip);
$l_xip=$l_xipx[0].'.'.$l_xipx[1].'.'.$l_xipx[2];
if(!$bot){
	$rq_lj='zhizhu/'.$s_rq;
	if (!file_exists($rq_lj)){mkdir($rq_lj);}
	$zhizhu_lj=$rq_lj.'/'.$l_xip.'.html';
	if(file_exists($zhizhu_lj)){
		$zhizhu_nr=file_get_contents($zhizhu_lj);
		if($zhizhu_nr==$cishu){
			header("HTTP/1.1 404 Not Found");
			header("Status: 404 Not Found");
			exit();
			}else{
				$zhizhu_nr=@$zhizhu_nr+1;
				$zhizhu_x=fopen($zhizhu_lj,'w');
				fwrite($zhizhu_x,$zhizhu_nr);
				fclose($zhizhu_x);
				}
				}else{
					$zhizhu_nr=@$zhizhu_nr+1;
					$zhizhu_x=fopen($zhizhu_lj,'w');
					fwrite($zhizhu_x,$zhizhu_nr);
					fclose($zhizhu_x);
					}
		}
