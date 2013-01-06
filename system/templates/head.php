<?php defined('ALLOW_INCLUDE') or die('No direct access allowed.');              

?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?=htmlspecialchars(ucwords($header['page_name']))?> - 7~11 TF2 Item Logger</title>        
    
    <meta name='keywords' content='<?=htmlspecialchars($header['meta_tags'])?>' />
    <meta name='description' content='<?=htmlspecialchars($header['meta_description'])?>' />
    
    <link rel='shortcut icon' type='image/x-icon' href='assets/favicon.ico' />                   
    <link rel='stylesheet' type='text/css' href='assets/css/main.css' />
    
    <script type='text/javascript' src='assets/js/jquery.js'></script>
    <script type='text/javascript' src='assets/js/itemlogger.js'></script>   
    
	<script type="text/javascript">

      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-16126282-8']);
      _gaq.push(['_trackPageview']);
    
      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();
    
    </script>
</head>
<body>
        <!--[if lt IE 8]>  <div style='border: 1px solid #F7941D; background: #FEEFDA; text-align: center; clear: both; height: 75px; position: relative;'>    <div style='position: absolute; right: 3px; top: 3px; font-family: courier new; font-weight: bold;'><a href='#' onclick='javascript:this.parentNode.parentNode.style.display="none"; return false;'><img src='http://www.ie6nomore.com/files/theme/ie6nomore-cornerx.jpg' style='border: none;' alt='Close this notice'/></a></div>    <div style='width: 640px; margin: 0 auto; text-align: left; padding: 0; overflow: hidden; color: black;'>      <div style='width: 75px; float: left;'><img src='http://www.ie6nomore.com/files/theme/ie6nomore-warning.jpg' alt='Warning!'/></div>      <div style='width: 275px; float: left; font-family: Arial, sans-serif;'>        <div style='font-size: 14px; font-weight: bold; margin-top: 12px;'>You are using an outdated browser</div>        <div style='font-size: 12px; margin-top: 6px; line-height: 12px;'>For a better experience using this site, please upgrade to a modern web browser.</div>      </div>      <div style='width: 75px; float: left;'><a href='http://www.firefox.com' target='_blank'><img src='http://www.ie6nomore.com/files/theme/ie6nomore-firefox.jpg' style='border: none;' alt='Get Firefox 3.5'/></a></div>      <div style='width: 75px; float: left;'><a href='http://www.browserforthebetter.com/download.html' target='_blank'><img src='http://www.ie6nomore.com/files/theme/ie6nomore-ie8.jpg' style='border: none;' alt='Get Internet Explorer 8'/></a></div>      <div style='width: 73px; float: left;'><a href='http://www.apple.com/safari/download/' target='_blank'><img src='http://www.ie6nomore.com/files/theme/ie6nomore-safari.jpg' style='border: none;' alt='Get Safari 4'/></a></div>      <div style='float: left;'><a href='http://www.google.com/chrome' target='_blank'><img src='http://www.ie6nomore.com/files/theme/ie6nomore-chrome.jpg' style='border: none;' alt='Get Google Chrome'/></a></div>    </div>  </div>  <![endif]-->
        <div id="header">
            <div class="wrap">
                <div class="sitehead">
                    <h1> <span id="title"><a href="/">7~11 TF2 ItemLogger</a></span></h1>
                </div>
                
                <div id="tabs">
                    <a href='?page=drops' class='tab<?=$page == 'drops' ? 'active' : ''?>'>Drops</a>
                    <a href='http://www.711clan.net' class='tab'>Home</a>
                    <a href='http://www.711clan.org' class='tab'>Forums</a>
                    <a href='http://www.sourcebans.711clan.net' class='tab'>SourceBans</a>
                    <a href='http://www.hlstatsx.711clan.net' class='tab'>HLStatsX</a>
                    <!--<a href='?page=players' class='tab<?=$page == 'players' || $page == 'player' ? 'active' : ''?>'>Players</a>  
                    <a href='?page=servers' class='tab<?=$page == 'servers' || $page == 'server' ? 'active' : ''?>'>Servers</a>
                    <a href='?page=items' class='tab<?=$page == 'items' || $page == 'item' ? 'active' : ''?>'>Items</a>  
                    -->
                </div>
            </div>
        </div>