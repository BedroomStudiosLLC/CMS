<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . '/CMS/HelperClasses/LogHandler.php');
?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
    <head>
        <title>CMS - Logs</title>
        <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/CMS/Master/HTMLHeader.php'); ?>
    </head>
    <body>
        <div class="container-fluid">
			<?php require_once($_SERVER['DOCUMENT_ROOT'].'/CMS/Master/HTMLAdminNavSidebar.php') ?>
			<h1 style="text-align: center;" class="display-4">Logs</h1>
			<hr>
			<div class="row" style="margin-top: 3em;">
				<div class="col-md-1"></div>
				<div class="col-md-1"></div>
				<div class="col-md-9">
					<div class="table-responsive">
						<table class="table table-sm table-hover table-striped table-bordered">
						  <thead>
							<tr>
							  <th scope="col">#</th>
							  <th scope="col">Log Type</th>
							  <th scope="col">Message</th>
							  <th scope="col">Stack Trace</th>
							  <th scope="col">File</th>
							  <th scope="col">Line Number</th>
							  <th scope="col">Time</th>
							</tr>
						  </thead>
						  <tbody>
							<?php echo LogHandler::ReturnLogTable();?>
						  </tbody>
						</table>
					</div>
				</div>
				<div class="col-md-1">
				</div>
			</div>
        </div>
    </body>
</html>

