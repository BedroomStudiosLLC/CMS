<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/CMS/Connections/DatabaseConnection.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/CMS/HelperClasses/JSONHandler.php');

    if (JSONHandler::GetConfigElement($_SERVER['DOCUMENT_ROOT'].'/CMS/Config/JSONConfig.php','debugMode') == true)
    {
        error_reporting(E_ALL);
    }
    else
    {
        error_reporting(0);
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