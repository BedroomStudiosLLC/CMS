<?php
	try
	{
		require_once($_SERVER['DOCUMENT_ROOT'] . '/CMS/Connections/DatabaseConnection.php');
		require_once($_SERVER['DOCUMENT_ROOT'] . '/CMS/HelperClasses/JSONHandler.php');
		require_once($_SERVER['DOCUMENT_ROOT'] . '/CMS/HelperClasses/LogHandler.php');
		
		if (JSONHandler::GetConfigElement($_SERVER['DOCUMENT_ROOT'].'/CMS/Config/JSONConfig.php','debugMode') == 'true')
		{
			error_reporting(E_ALL);
		}
		else
		{
			error_reporting(0);
		}
	}
	catch (Exception $e)
	{
		LogHandler::SaveLog(LogType::ERROR, 'HTMLHeader', $e);
	}
?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/favicon.png">
    <script src="<?php echo JSONHandler::GetConfigElement($_SERVER['DOCUMENT_ROOT'].'/CMS/Config/JSONConfig.php','jQuery'); ?>" ></script>
    <script src="<?php echo JSONHandler::GetConfigElement($_SERVER['DOCUMENT_ROOT'].'/CMS/Config/JSONConfig.php','ajax'); ?>"></script>
    <script src="<?php echo JSONHandler::GetConfigElement($_SERVER['DOCUMENT_ROOT'].'/CMS/Config/JSONConfig.php','bootstrapScript'); ?>"></script>


    <script async src="<?php echo JSONHandler::GetConfigElement($_SERVER['DOCUMENT_ROOT'].'/CMS/Config/JSONConfig.php','googleAnalyticsAPI'); ?>"></script>
    <link rel="stylesheet" href="<?php echo JSONHandler::GetConfigElement($_SERVER['DOCUMENT_ROOT'].'/CMS/Config/JSONConfig.php','bootstrapCSS'); ?>">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.css" rel="stylesheet" type="text/css"/>
	
	<style>
		@font-face {
		  font-family: SegoeUI;
		  src: local(CMS/Fonts/SegoeUI.ttf);
		}
		
		@font-face {
		  font-family: SegoeUIBold;
		  src: local(CMS/Fonts/SegoeUIBold.ttf);
		}

		body{
			font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
		}
		html {
			font-size: 1rem;
		}

	.minify{
		font-size: .82rem;
	}
	
	@include media-breakpoint-up(sm) {
	  html {
		font-size: 1.2rem;
	  }
	  .minify {
		  font-size: .6rem;
	  }
	}

	@include media-breakpoint-up(md) {
	  html {
		font-size: 1.4rem;
	  }
	  .minify {
		  font-size: .6rem;
	  }
	}

	@include media-breakpoint-up(lg) {
	  html {
		font-size: 1.6rem;
	  }
	  .minify {
		  font-size: .6rem;
	  }
	}
	</style>