<?php

?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
    <head>
        <title>CMS - API</title>
        <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/CMS/Master/HTMLHeader.php'); ?>
    </head>
    <body>
        <div class="container-fluid">
			<?php require_once($_SERVER['DOCUMENT_ROOT'].'/CMS/Master/HTMLAdminNavSidebar.php') ?>
			<h1 style="text-align: center;" class="display-4">Template</h1>
			<div class="row">
				<div class="col-md-1">
					<p>This is hidden by partial sidebar.</p>
				</div>
				<div class="col-md-1">
					<p>This is hidden by fully extended sidebar.</p>
				</div>
				<div class="col-md-8">
				</div>
				<div class="col-md-2">
				</div>
			</div>
        </div>
    </body>
</html>

