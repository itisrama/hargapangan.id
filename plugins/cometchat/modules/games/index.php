<?php

/*

CometChat
Copyright (c) 2016 Inscripts
License: https://www.cometchat.com/legal/license

*/

include_once(dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR."modules.php");
include_once(dirname(__FILE__).DIRECTORY_SEPARATOR."config.php");
include_once(dirname(__FILE__).DIRECTORY_SEPARATOR."lang".DIRECTORY_SEPARATOR."en.php");
if (file_exists(dirname(__FILE__).DIRECTORY_SEPARATOR."lang".DIRECTORY_SEPARATOR.$lang.".php")) {
        include_once(dirname(__FILE__).DIRECTORY_SEPARATOR."lang".DIRECTORY_SEPARATOR.$lang.".php");
}

$includeJs = '';
$callbackfn= '';
if(!empty($_REQUEST['callbackfn']) && ($_REQUEST['callbackfn']=='desktop' || $_REQUEST['callbackfn'] == 'mobileapp')){
    $callbackfn='&callbackfn='.$_REQUEST['callbackfn'];
}
if(!empty($_GET['gameLink'])){
    $iframeHeight = $_GET['height']+10;
    $iframeWidth = $_GET['width']+10;
    if($_SERVER['HTTP_USER_AGENT']=='cc_ios'){
        header("location://play.famobi.com/".$_GET['gameLink']."/A-COMETCHAT");exit;
    }
    echo <<<EOD
<!DOCTYPE html>
<html>
    <head>
        <title>{$games_language[100]}</title>
        <meta name="viewport" content="user-scalable=1,width=device-width, initial-scale=1.0" />
        <meta http-equiv = "cache-control" content = "no-cache">
        <meta http-equiv = "pragma" content = "no-cache">
        <meta http-equiv = "expires" content = "-1">
        <meta http-equiv = "content-type" content = "text/html; charset=UTF-8"/>
        <title>CometChat:{$_GET['name']}</title>
        <style>
        html,body,iframe{
        	overflow:auto;
        	width:100%;
        	height:100%;
        	margin:0;
        }
        </style>
    </head>
	<body>
	<iframe src = "//play.famobi.com/{$_GET['gameLink']}/A-COMETCHAT" frameborder = 0></iframe>
    </body>
</html>
EOD;
	exit;
}
if ($sleekScroller == 1) {
	$includeJs = '<script src="../../js.php?type=core&name=scroll" type="text/javascript"></script>';
}
$includeJs .= '<script type="text/javascript">var gamesJson = '.file_get_contents(dirname(__FILE__).DIRECTORY_SEPARATOR.'games.json').';</script>';
echo <<<EOD
<!DOCTYPE html>
<html>
    <head>
        <title>{$games_language[100]}</title>
        <meta name="viewport" content="user-scalable=1,width=device-width, initial-scale=1.0" />
        <meta http-equiv="cache-control" content="no-cache">
        <meta http-equiv="pragma" content="no-cache">
        <meta http-equiv="expires" content="-1">
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
        <link type="text/css" rel="stylesheet" media="all" href="../../css.php?type=module&name=games" />
        <script src="../../js.php?type=core&name=jquery"></script>
        <script>$=jqcc;</script>
        {$includeJs}
        <script src="../../js.php?type=module&name=games{$callbackfn}" type="text/javascript"></script>
        <script>
            $(function(){
                var cometchat_game_search = $("#cometchat_game_search");
                var cometchat_gamescontainer = $('.gamecontainer');
                cometchat_game_search.click(function(){
                    var searchString = $(this).val();

                    if(searchString=='{$games_language[0]}'){
                        cometchat_game_search.val('');
                        cometchat_game_search.addClass('cometchat_search_light');
                    }
                });
                cometchat_game_search.blur(function(){
                    var searchString = $(this).val();
                    if(searchString==''){
                        cometchat_game_search.addClass('cometchat_search_light');
                        cometchat_game_search.val('{$games_language[0]}');
                    }
                });
                cometchat_game_search.keyup(function(){
                    var searchString = $(this).val();
                    if(searchString.length>0&&searchString!='{$games_language[0]}'){
                        cometchat_gamescontainer.find('.gamelist').hide();
                        var searchcount = cometchat_gamescontainer.find('.gamelist > .title:icontains("'+searchString+'")').length;
                        if(searchcount >= 1 ){
                            cometchat_gamescontainer.find('#games').find('.gamelist > .title:icontains("'+searchString+'")').parent().show();
                        }
                        cometchat_game_search.removeClass('cometchat_search_light');
                    }else{
                        cometchat_gamescontainer.find('div.gamelist').show();
                    }
                });
            });
        </script>
    </head>
	<body>
		<div style="width:100%;margin:0 auto;margin-top: 0px;height: 100%;overflow-y: auto;">
			<div id="cometchat_wrapper">
				<div id="topcont">
					<div class="custom-dropdown" id="categories">
						<span class="selected">all games</span>
						<span class="carat"></span>
						<div id="optionList" class="" style="height: 0px;">
                            <ul>
                                <li id="all games" style="border: none;" class="active">all games</li>
                            </ul>
			            </div>
					</div>
                    <div class="cometchat_tabsubtitle" id="cometchat_game_searchbar">
                        <input type="text" name="cometchat_game_search" class="cometchat_search cometchat_search_light" id="cometchat_game_search" value="Search Game"></div>
				    </div>
				<div class="gamecontainer">
					<div id="games"></div>
				</div>
			</div>
		</div>
		<div id="loader"></div>
	</body>
</html>
EOD;
?>