<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/CMS/PartialHTML/HTMLAlerts.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Page Title</title>
        <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/Master/HTMLHeader.php'); ?>
        <!-- Bootstrap documentation: https://getbootstrap.com/docs/4.3/getting-started/introduction/ -->
    </head>
    <body>
        <div class="container-fluid">

            <h1>My First Heading</h1>

            <?php echo HTMLAlerts::GetHTMLAlert("This is a simple alert", BootstrapAlertType::PRIMARY); ?>

            <p>My first paragraph.</p>

            <button class="btn-primary">Hi</button>
        </div>
    </body>
</html>
