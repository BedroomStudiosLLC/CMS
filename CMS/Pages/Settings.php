<?php

?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
    <head>
        <title>CMS - Settings</title>
        <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/CMS/Master/HTMLHeader.php'); ?>
		<style>
			.settingsItem {
				height: 3.5em;
				width: 100%;
				border-style: solid;
                border-width: 2px;
                border-radius: .5em;
                background-color: white;
                padding: 1em;
                margin-top: 1em;
				margin-left: 1em;
                border-color: lightgray;
			}
			.settingsVisible:hover {
				color: blue;
				cursor: pointer;
			}
			.dropDownItem {
				border-width: 0 2px 2px 2px;
				border-radius: 0;
				display: none;
				height: auto;
			}
			.rotateDown {
				transition: .25s;
				transform: rotate(90deg);
			}
			.rotateRight {
				transition: .25s;
				transform: rotate(0deg);
			}
		</style>
		<script>
			function SettingsClicked(element)
			{
				var p = $(element).parent();
				if (p.find('.dropDownItem').css('display') == 'none')
				{
					var e = $(element).find('ion-icon');
					e.addClass("rotateDown");
					e.removeClass("rotateRight");
					p.find('.dropDownItem').css("display", "block" );
				}
				else
				{
					var e = $(element).find('ion-icon');
					e.addClass("rotateRight");
					e.removeClass("rotateDown");
					p.find('.dropDownItem').css("display", "none" );
				}
			}
		</script>
    </head>
    <body>
        <div class="container-fluid">
			<?php require_once($_SERVER['DOCUMENT_ROOT'].'/CMS/Master/HTMLAdminNavSidebar.php') ?>
			<h1 style="text-align: center;" class="display-4">Settings</h1>
			<div class="row">
				<div class="col-md-1"></div>
				<div class="col-md-1"></div>
				<div class="col-md-8">
					<div class="settingsItemHeader">
						<div class="settingsItem settingsVisible" onClick="SettingsClicked(this)">Global Config<ion-icon name="arrow-forward" style="float:right;"></ion-icon></div>
						<div class="settingsItem dropDownItem">
							<form action="/CMS/HelperClasses/SettingsHandler.php" name="GlobalSettings" method="post">
								<div class="form-group row">
									<label for="CompanyName" class="col-sm-2 col-form-label">Company Name</label>
									<div class="col-sm-10">
									  <input type="text" class="form-control" name="CompanyName" id="CompanyName" placeholder="Company Name">
									</div>
								</div>
								<div class="form-group row">
									<label for="CompanyNameShort" class="col-sm-2 col-form-label">Short Name</label>
									<div class="col-sm-10">
									  <input type="text" class="form-control" name="CompanyNameShort" id="CompanyNameShort" placeholder="Short Company Name">
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-2"></div>
									<div class="col-sm-10">
										<div class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input" name="debugMode" id="debugMode" value="true">
											<label class="custom-control-label" for="debugMode">Enable Debug Mode</label>
										</div>
									</div>
								</div>
								<input type="submit" name="submit" class="btn btn-primary" value="Submit">
							 </form>
						</div>
					</div>
				</div>
				<div class="col-md-2">
				</div>
			</div>
        </div>
    </body>
</html>

