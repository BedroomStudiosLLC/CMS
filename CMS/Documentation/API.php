<?php


//Show API calls and plugins

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

            <div class="row">
                <div class="col-3"></div>
                <div class="col-6">
                    <h1>API Calls</h1>

                    <?php echo HTMLAlerts::GetHTMLAlert("This is a simple alert", BootstrapAlertType::PRIMARY); ?>

                    <p>My first paragraph.</p>

                    <button class="btn-primary">Hi</button>
                </div>
                <div class="col-3"></div>
            </div>
        </div>
    </body>
</html>

