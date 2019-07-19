<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
header("Content-type: text/html; charset=utf-8");
require_once('../coon.php');
$id=$_GET['id'];
$dui=file_get_contents('dui.txt');
$title=file_get_contents('1.txt');
$yuming=file_get_contents('yuming.txt');
$dui = explode ("\n", $dui );
$title = explode ("\n", $title );
$yuming = explode ("\n", $yuming );
$duixiang=$dui[$id];
$duixiang = explode ("###", $duixiang );
@$yuming=$yuming[$id];
$yuming = str_replace("L","l", trim($yuming));
@$mubiao=$duixiang[0];
@$tihuan=$duixiang[1].",我们";
$title = explode ("###", $title[$id] );
echo " <pre>";
echo $title[0];
echo '<br>';
echo $title[1]."\n";
$geshu = explode (",", $tihuan);
for($i=0;$i<count($geshu);$i++){
$btihuan=$btihuan.$title[0].",";
}
$btihuan=$btihuan.",";
$btihuan = str_replace(",,","", $btihuan);
@$tiaoshi="1";
@$bt=$title[1];
@$gjz=$title[0];
@$ms=$title[2];
@$shouye="0";//是否更新首页 1为更新首页



$nr=@$mubiao."\n".@$tihuan."\n".@$btihuan."\n".@$shouye."\n".@$tiaoshi."\n".@$bt."\n".@$gjz."\n".@$ms."\n".$ag."\n".@$jianti;
echo $nr = str_replace("，", ",", $nr);
$zhizhu_lianxi=fopen('domain/'.@$yuming.'.txt','w');//生成txt文件
			fwrite($zhizhu_lianxi,$nr);
			fclose($zhizhu_lianxi);
$idx=$id+1;
if($yuming==""){
	echo "wan bi";
	exit;
}
echo '<meta  http-equiv="refresh" content = "0.3;url=index.php?id='.$idx.'" >';
?>

