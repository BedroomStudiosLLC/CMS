<?php

class JSONHandler
{
    public static function GetConfigElement($path, $element)
    {
		try
		{
			require_once($_SERVER['DOCUMENT_ROOT'] . '/CMS/HelperClasses/LogHandler.php');
			
			$configFile = file_get_contents($path);

			$jsonConfig = json_decode($configFile, true);

			if ($element != null && $element != "")
			{
				return $jsonConfig[$element];
			}
			else
			{
				return $jsonConfig;
			}
		}
		catch (Exception $e)
		{
			LogHandler::SaveLog(LogType::ERROR, 'GetConfigElement', $e);
		}
    }
	
	public static function UpdateJSONElement($path, $element, $newValue, $force = false)
    {
		try
		{
			require_once($_SERVER['DOCUMENT_ROOT'] . '/CMS/HelperClasses/LogHandler.php');
			
			$configFile = file_get_contents($path);

			$jsonConfig = json_decode($configFile, true);

			if ($element != null && $element != "")
			{
				if(array_key_exists($element, $jsonConfig))
				{
					$jsonConfig[$element] = $newValue;
				}
				else
				{
					if (!$force)
					{
						LogHandler::SaveLog(LogType::DANGER, 'UpdateJSONElement - no value of ' . $element);
						return;
					}
					else
					{
						$tempArray = array($element => $newValue);
						JSONHandler::AddJSON($path, $tempArray);
					}
				}
			}
			else
			{
				LogHandler::SaveLog(LogType::DANGER, 'UpdateJSONElement - no value');
				return;
			}
			
			file_put_contents($path, json_encode($jsonConfig, JSON_PRETTY_PRINT));
		}
		catch (Exception $e)
		{
			LogHandler::SaveLog(LogType::ERROR, 'UpdateJSONElement', $e);
		}
    }
	
	public static function GetWholeJSON($path, $asString = false)
    {
        $json = file_get_contents($path);

		if($asString == false)
			return json_decode($json, true);
		if($asString == true)
			return $json;
    }
	
	public static function AddJSON($path, $newJSONArray)
    {
		try
		{
			require_once($_SERVER['DOCUMENT_ROOT'] . '/CMS/HelperClasses/LogHandler.php');
			
			$fileJSON = JSONHandler::GetWholeJSON($path, true);
			
			$tempArray = array();
			
			if ($fileJSON != null && $fileJSON != "null")
				$tempArray = json_decode($fileJSON);
			
			array_push($tempArray, $newJSONArray);
			$jsonData = json_encode($tempArray, JSON_PRETTY_PRINT);
			file_put_contents($path, $jsonData);
		}
		catch (Exception $e)
		{
			LogHandler::SaveLog(LogType::ERROR, 'AddJSON', $e);
		}
    }
}