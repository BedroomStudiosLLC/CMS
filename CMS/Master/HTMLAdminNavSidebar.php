<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . '/CMS/HelperClasses/JSONHandler.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/CMS/HelperClasses/LogHandler.php');
	
	$logCount = LogHandler::GetLogCount();
?>
        <style>
			.sidenav {
			  height: 100%; /* Full-height: remove this if you want "auto" height */
			  width: 230px; /* Set the width of the sidebar */
			  position: fixed;
			  z-index: 1;
			  top: 0;
			  left: 0;
			  background-color: #31353d;
			  overflow-x: hidden; /* Disable horizontal scroll */
			  //padding-top: 20px;
			}
			/* width */
			::-webkit-scrollbar {
			  width: 10px;
			}

			/* Track */
			::-webkit-scrollbar-track {
			  background: #f1f1f1; 
			}

			/* Handle */
			::-webkit-scrollbar-thumb {
			  background: #888; 
			}

			/* Handle on hover */
			::-webkit-scrollbar-thumb:hover {
			  background: #555; 
			}
						
			.dashboardTop{
				color: white;
				background-color: #006fa4;
				font-size: 1.1em;
				padding: .3em;
				font-weight: bold;
				height: auto;
			}
			.dashboardTop i{
				color: #6acfff;
				margin-right: 5px;
				transition: 0.9s;
				text-decoration: none;
			}
			.dashboardTop i:hover{
				color: #003d59;
			}
			.dashboardUserName {
			  font-size: 1.1em;
			  margin-top: .7em;
			  text-align: center;
			  font-weight: bold;
			  color: #cdd0d8;
			  display: block;
			}
			.dashboardDivider{
				background-color: #25282e;
				//height: 25px;
				color: #cdd0d8;
				padding: .3em;
				font-weight: bold;
			}
			.dashboardNavItem {
			  padding: .3em .4em .3em .8em;
			  text-decoration: none;
			  font-size: 1em;
			  color: #cdd0d8;
			  display: block;
			}
			.dashboardNavItem:hover {
			  color: white;
			  text-decoration: none;
			  background-color: #2e3138;
			}
			.dashboardNavItem i{
				margin-right: 5px;
				transition: 0.9s;
			}
			.dashboardNavItem ion-icon{
				margin-right: 5px;
				transition: 0.9s;
			}
			.dashboardHeaders{
				font-weight: bold;
			}
			.dashboardHeaders:hover {
			  color: #5e6b77;
			}
			a .badge{
				float: right;
				margin-right: .3em;
			}
			
			.navBar{
				position: fixed;
				z-index: 1;
				top: 0;
				left: 0;

				padding-top: .3em;
				padding-bottom: .3em;
				background-color: #0080c0;
				width: 100%;
				font-size: 1.1em;
				height: auto;
				//height: 38px;
				margin-bottom:1em;
			}
			.navBarItems{
				float:right; 
				color:white;
			}
			.navBarItems a{
				float:left;
				color:white;
				padding-left: .5em;
				padding-right:.5em;
				text-decoration: none;
				//padding-top:.2em;
			}
			.navBarItems ion-icon:hover{
				color: #c8e3f0;
				text-decoration: none;
			}
			.navBarItems ion-icon{
				color:white;
				padding:-1em;
				margin:-.1em;
				font-size: 1.3em;
				transition: 0.9s;
			}
			.hideOnNavClose{
				display:inline;
			}
			.showOnNavClose{
				display:none;
			}
		</style>
		<script>
			var sideNavVisable = true;
		
			function toggleNav(){
				if (sideNavVisable){
					document.getElementById("sideNav").style.width = "80px";
					var elements = document.getElementsByClassName("hideOnNavClose")

					for (var i = 0; i < elements.length; i++){
						elements[i].style.display = "none";
					}
					var elements = document.getElementsByClassName("showOnNavClose")

					for (var i = 0; i < elements.length; i++){
						elements[i].style.display = "inline";
					}
					
					var elements = document.getElementsByClassName("expandOnClose")

					for (var i = 0; i < elements.length; i++){
						elements[i].style.textAlign = "center";
						elements[i].style.fontSize = "2.5em";
					}
					sideNavVisable = false;
				}else{
					document.getElementById("sideNav").style.width = "230px";
					var elements = document.getElementsByClassName("hideOnNavClose")

					for (var i = 0; i < elements.length; i++){
						elements[i].style.display = "inline";
					}
					var elements = document.getElementsByClassName("showOnNavClose")

					for (var i = 0; i < elements.length; i++){
						elements[i].style.display = "none";
					}
					var elements = document.getElementsByClassName("expandOnClose")

					for (var i = 0; i < elements.length; i++){
						elements[i].style.fontSize = "1em";
						elements[i].style.fontSize = "1em";
					}
					
					sideNavVisable = true;
				}
			}
		</script>
		<div style="margin-bottom:1em;">
			<nav class="navBar" id="adminNavBar">
				<div class="navBarItems">
					<a href="#"><ion-icon name="notifications-outline"></ion-icon></a>
					<a href="#"><ion-icon name="warning" style="<?php if($logCount > 0) echo 'color:#ffc107'; ?>"></ion-icon></a>
					<a href="#"><ion-icon name="mail"></ion-icon></a>
					<a href="#"><div>Hello Mark Mueller<ion-icon name="arrow-dropdown"></ion-icon></div></a>
				</div>
			</nav>
			<div class="row showDesktopOnly">
				<div class="col-md-2" id="dashboardNav" style="width:100%">
					<nav class="sidenav" id="sideNav">
						<div class="dashboardTop" id="dashboardTop" style="table-cell"><div class="hideOnNavClose"><?php echo JSONHandler::GetConfigElement($_SERVER['DOCUMENT_ROOT'].'/CMS/Config/GlobalConfig.php','CompanyName');?></div><div class="showOnNavClose"><?php echo JSONHandler::GetConfigElement($_SERVER['DOCUMENT_ROOT'].'/CMS/Config/GlobalConfig.php','CompanyNameShort');?></div><a href="javascript:void(0)" onclick="toggleNav()"><ion-icon name="menu" style="float:right; font-size:1.3em;"></ion-icon></a></div>
						<div class="hideOnNavClose"><div class="dashboardUserName">Hello Mark Mueller</div></div>
						<div class="hideOnNavClose"><hr style="border-color: #5e6b77; "></div>
						<div class="hideOnNavClose"><div class="dashboardDivider">General</div></div>
						<!--<div class="dashboardNavItem dashboardHeaders">General</div>-->
						<a class="dashboardNavItem" href="/CMS/Pages/Dashboard.php"><ion-icon name="home" class="expandOnClose"></ion-icon><div class="hideOnNavClose">Home</div></a>
						<a class="dashboardNavItem" href="#"><ion-icon name="document" class="expandOnClose"></ion-icon><div class="hideOnNavClose">Pages<span class="badge badge-secondary">New</span></div></a>
						<a class="dashboardNavItem" href="#"><ion-icon name="people" class="expandOnClose"></ion-icon><div class="hideOnNavClose">Users</div></a>						
						<a class="dashboardNavItem" href="#"><ion-icon name="code" class="expandOnClose"></ion-icon><div class="hideOnNavClose">Plugins</div></a>
						<a class="dashboardNavItem" href="#"><ion-icon name="color-palette" class="expandOnClose"></ion-icon><div class="hideOnNavClose">Styles</div></a>
						<div class="hideOnNavClose"><div class="dashboardDivider">Developer Tools</div></div>
						<!--<div class="dashboardNavItem dashboardHeaders">Developer Tools</div>-->
						<a class="dashboardNavItem" href="/CMS/Logs/Logs.php"><ion-icon name="folder" class="expandOnClose"></ion-icon><div class="hideOnNavClose">File Manager</div></a>
						<a class="dashboardNavItem" href="/CMS/Documentation/API.php"><ion-icon name="flash" class="expandOnClose"></ion-icon><div class="hideOnNavClose">API Calls</div></a>
						<a class="dashboardNavItem" href="/CMS/Logs/Logs.php"><ion-icon name="bug" class="expandOnClose"></ion-icon><div class="hideOnNavClose">Logs</div></a>
						<div class="hideOnNavClose"><div class="dashboardDivider">Options</div></div>
						<a class="dashboardNavItem" href="/CMS/Pages/Settings.php"><ion-icon name="settings" class="expandOnClose"></ion-icon><div class="hideOnNavClose">Settings</div></a>
					</nav>
				</div>
				<div class="col-sm-10" style="margin-top: 1em;">
					
				</div>
			</div>	
		</div>


