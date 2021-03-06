<?php
/*

CometChat
Copyright (c) 2016 Inscripts
License: https://www.cometchat.com/legal/license

*/


if(!empty($_REQUEST['basedata'])) {
	include_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'cometchat_init.php');
	$_SESSION['basedata']=$_REQUEST['basedata'];
	setcookie($cookiePrefix."data", $_REQUEST['basedata'], 0, "/");
}
$callbackfn='';
if(!empty($_REQUEST['callbackfn'])) {
	$callbackfn = "&callbackfn=".$_REQUEST['callbackfn'];
}
$id = 0;
if(!empty($_REQUEST['user'])){
	$id = $_REQUEST['user'];
}


if(!empty($_REQUEST['chatroomsonly'])) {
	$chatroomsonly = "&chatroomsonly=1";
} else {
	$chatroomsonly = "&chatroomsonly=0";
}

if(!empty($_REQUEST['crid'])) {
	$chatroomid = "&chatroomid=".$_REQUEST['crid'];
} else {
	$chatroomid = "&chatroomid=0";
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="user-scalable=0,width=device-width, minimum-scale=1.0, maximum-scale=1.0, initial-scale=1.0" />
	<meta http-equiv="Content-Type" content="text/html" charset="UTF-8"/>
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<link rel="shortcut icon" type="image/png" href="favicon32.ico">
	<title>CometChat</title>
	<script type="text/javascript">
		var embeddedchatroomid = <?php echo (!empty($_REQUEST['crid']) ? $_REQUEST['crid'] : '0').';'; ?>
		var chatroomsonly = <?php echo (!empty($_REQUEST['chatroomsonly']) ? '1' : '0').';'; ?>
	</script>
	<link type="text/css" href="./cometchatcss.php?cc_theme=synergy<?php echo $chatroomid; ?><?php echo $chatroomsonly; ?><?php echo $callbackfn;?>" rel="stylesheet" charset="utf-8">
	<script type="text/javascript" src="./cometchatjs.php?cc_theme=synergy<?php echo $chatroomid; ?><?php echo $chatroomsonly; ?><?php echo $callbackfn;?>" charset="utf-8"></script>
	<script type="text/javascript" src="./js.php?type=core&name=jsapi"></script>
	<script type="text/javascript">
		jqcc(document).ready(function(){
			if (embeddedchatroomid != 0 && embeddedchatroomid !='null' && typeof(embeddedchatroomid) != "undefined" && typeof(jqcc.cometchat.chatroomHeartbeat) == "function") {
				var id = '1^'+embeddedchatroomid;
				jqcc.cometchat.chatroomHeartbeat(id);
			}
		});
		google.load("elements", "1", {
            packages: "transliteration"
        });
	
		document.addEventListener("dragover",function(e){
		   e = e || event;
		   e.preventDefault();
		},false);
		document.addEventListener("drop",function(e){
			e = e || event;
			e.preventDefault();
		},false);
		
		var uid = '<?php echo $id; ?>';
		if(uid > 0){
			var controlparameters = {"type":"core", "name":"cometchat", "method":"chatWith", "params":{"uid":uid, "synergy":"1"}};
	        controlparameters = JSON.stringify(controlparameters);
	        parent.postMessage('CC^CONTROL_'+controlparameters,'*');
	    }

	</script>
</head>
<body style="overflow: hidden;">
</body>
</html>