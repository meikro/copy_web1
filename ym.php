<?php
header("Content-type: text/html; charset=utf-8");
require_once('coon.php');
@$biaoti=$_POST['biaoti'];
@$guanjianzi=$_POST['guanjianzi'];
@$miaoshu=$_POST['miaoshu'];
@$mubiao=$_POST['mubiao'];
@$yuming=$_POST['yuming'];
@$mubiaogjz=$_POST['mubiaogjz'];
$mubiao = str_replace(array("\r\n", "\r", "\n"), "", trim($mubiao));
$yuming = str_replace(array("\r\n", "\r", "\n"), "", trim($yuming));
$yuming = str_replace("L","l", trim($yuming));
$mubiaogjz = str_replace(array("\r\n", "\r", "\n"), "", trim($mubiaogjz));
$guanjianzi = str_replace(array("\r\n", "\r", "\n"), "", trim($guanjianzi));
$biaoti = str_replace(array("\r\n", "\r", "\n"), "", trim($biaoti));
$miaoshu = str_replace(array("\r\n", "\r", "\n"), "", trim($miaoshu));
$mubiaogjz = str_replace("，", ",", $mubiaogjz.",我们");
$mubiaogjza = explode(",", $mubiaogjz);
$gjzshu=count($mubiaogjza);
for($i=0;$i<$gjzshu;$i++){
	$gjz=$gjz.$guanjianzi.",";
}
$guanjianzix=$gjz.",";
$guanjianzix = str_replace(",,","", $guanjianzix);
$tiaoshi="0"; //0调试效果，不生成html换成
$gengxin="1";//0为跟随目标值更新首页
$lujing='data/domain/'.$yuming.'.txt';
$neirong=$mubiao."\n".$mubiaogjz."\n".$guanjianzix."\n".$tiaoshi."\n".$gengxin."\n".$biaoti."\n".$guanjianzi."\n".$miaoshu."\n".$ag."\n".$jianti;
if(!is_file($lujing)){
	$zhizhu_lianxi=fopen($lujing,'w');//生成txt文件
			fwrite($zhizhu_lianxi,$neirong);
			fclose($zhizhu_lianxi);
}else{
  echo "已经存在，请访问data/domain/目前修改";
}
?>
<xmp >
<?php echo $neirong;?>
</xmp>

<form action="" style="text-align:center;" method="post">
<p>目标：<textarea rows="1" cols="120" name="mubiao" ><?php echo $mubiao;?></textarea></p>
<p>目标关键字：<textarea rows="1" cols="120" name="mubiaogjz" ><?php echo $mubiaogjz;?></textarea></p>
<p><br></p>
<p>建站域名：<textarea rows="1" cols="120" name="yuming" ><?php echo $yuming;?></textarea></p>
<p>标题：<textarea rows="1" cols="120" name="biaoti" ><?php echo $biaoti;?></textarea></p>
<p>关键字：<textarea rows="1" cols="120" name="guanjianzi" ><?php echo $guanjianzi;?></textarea></p>
<p>描述：<textarea rows="10" cols="120" name="miaoshu" ><?php echo $miaoshu;?></textarea></p>
<input type="submit" value="提交">
</form>
