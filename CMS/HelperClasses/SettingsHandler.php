<?php
	
	if(isset($_POST['submit']))
	{
		SettingsHandler::SaveSettings($_POST);
		header('Location: /CMS/Pages/Settings.php');
	}

	class SettingsHandler
	{	
		public static function SaveSettings($settingsArray)
		{
			try
			{
				require_once($_SERVER['DOCUMENT_ROOT'] . '/CMS/HelperClasses/JSONHandler.php');
				require_once($_SERVER['DOCUMENT_ROOT'] . '/CMS/HelperClasses/LogHandler.php');
				
				foreach ($settingsArray as $key => $setting)
				{
					if ($key == 'submit') continue;
					JSONHandler::UpdateJSONElement($_SERVER['DOCUMENT_ROOT'] . '/CMS/Config/GlobalConfig.php', $key, $setting, true);
				}
			}
			catch (Exception $e)
			{
				LogHandler::SaveLog(LogType::ERROR, 'SaveSettings', $e);
			}
		}
	}