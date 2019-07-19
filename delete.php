<?php
/*
 * 
 * 删除指定目录中的所有目录及文件（或者指定文件）
 * 可扩展增加一些选项（如是否删除原目录等）
 * 删除文件敏感操作谨慎使用
 * @param $dir 目录路径
 * @param array $file_type指定文件类型
 */
require_once('coon.php');
 header("Content-type: text/html; charset=utf-8");
function delFile($dir,$file_type='') { 
  if(is_dir($dir)){
    $files = scandir($dir);
 //打开目录 //列出目录中的所有文件并去掉 . 和 .. 
    foreach($files as $filename){
      if($filename!='.' && $filename!='..'){
        if(!is_dir($dir.'/'.$filename)){
          if(empty($file_type)){
            unlink($dir.'/'.$filename);
          }else{
            if(is_array($file_type)){
              //正则匹配指定文件
              if(preg_match($file_type[0],$filename)){
                unlink($dir.'/'.$filename);
              }
            }else{
              //指定包含某些字符串的文件
              if(false!=stristr($filename,$file_type)){
                unlink($dir.'/'.$filename);
              }
            }
          }
        }else{ 
          delFile($dir.'/'.$filename);
          rmdir($dir.'/'.$filename);
        } 
      }
    }
  }else{
    if(file_exists($dir)) unlink($dir);
  } 
}
//delFile(dirname(__FILE__),'html');



@$mima=$_POST['mima'];
@$yuming=$_POST['yuming'];
$mima = str_replace(array("\r\n", "\r", "\n","  "," "), "", $mima);
$yuming = str_replace(array("\r\n", "\r", "\n","  "," "), "", $yuming);


$data='data/domain/'.$yuming.'.txt';
$yuan="cachefile_yuan/".$yuming."/";





echo "<center>";
if($mima==$mimas){
if(is_file($data)){
unlink ($data); 
echo $data."删除完成<br>";
}else{
	echo $data."文件不存在<br>";
}

if(is_dir($yuan)){
 echo delFile($yuan);
 echo $yuan."删除完成<br>";
}else{
	echo $yuan."文件不存在<br>";
}
}else{
	echo "请填写正确密码";
}
echo "</center>";
?>

<form action="" style="text-align:center;" method="post">
<p>密码：<textarea rows="1" cols="120" name="mima" ><?php echo $mima;?></textarea></p>
<p>建站域名：<textarea rows="1" cols="120" name="yuming" ><?php echo $yuming;?></textarea></p>
<input type="submit" value="提交">
</form>