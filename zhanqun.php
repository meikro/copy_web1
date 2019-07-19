<?php

function ken_api_get(){
		global $djym,$id;
		$remote = "http://173.82.82.122:22055/?getlink=1&y=".$djym.$id;
		$rst = aric_content($remote);
		return json_decode($rst);
		}

		$linklist = ken_api_get();
function fanlian(){
	    global $linklist;
		$count=count($linklist)-1;
		$id = mt_rand(0,$count);
		$body[$id]=$linklist[$id];
		$body[$id] = str_replace(array("\r\n", "\r", "\n"), "", $body[$id]);
	return $body[$id];
}
function zhanqun($nr){
	$neirong=explode('shinofol',$nr);
	$geshu=count($neirong);
	for($i=0;$i<$geshu;$i++)
		{
	$neirong[$i]= preg_replace('@lowkaishi"(.*?)href="http://(.*?)"@is','$1href="http://www.'.fanlian().'"', $neirong[$i]);
    $neirong[$i]= preg_replace("@lowkaishi'(.*?)href='http://(.*?)'@is","$1href='http://www.".fanlian()."'", $neirong[$i]);
	@$shuchu=$shuchu.$neirong[$i];
	$nr=$shuchu;
	}
		$nr = str_replace(array('rel="kai',"rel='kai","lowkaishi'",'lowkaishi"'), "", $nr);
	return $nr;
}