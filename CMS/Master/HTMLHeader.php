<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/CMS/Connections/DatabaseConnection.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/CMS/Config/ConfigHandler.php');

?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/favicon.png">
    <script src="<?php echo ConfigHandler::GetConfigElement($_SERVER['DOCUMENT_ROOT'].'/CMS/Config/JSONConfig.php','bootstrapScript'); ?>"></script>
    <script src="<?php echo ConfigHandler::GetConfigElement($_SERVER['DOCUMENT_ROOT'].'/CMS/Config/JSONConfig.php','jQuery'); ?>"></script>
    <script async src="<?php echo ConfigHandler::GetConfigElement($_SERVER['DOCUMENT_ROOT'].'/CMS/Config/JSONConfig.php','googleAnalyticsAPI'); ?>"></script>
    <link rel="stylesheet" href="<?php echo ConfigHandler::GetConfigElement($_SERVER['DOCUMENT_ROOT'].'/CMS/Config/JSONConfig.php','bootstrapCSS'); ?>">
    <link rel="stylesheet" type="text/css" href="/Company/API/Default.php">