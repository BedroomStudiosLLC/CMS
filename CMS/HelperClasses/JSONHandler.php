<?php

class JSONHandler
{
    public static function GetConfigElement($path, $element)
    {
		try
		{
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
	
	public static function GetWholeJSON($path, $asString = false)
    {
        $json = file_get_contents($path);

		if($asString == false)
			return json_decode($json, true);
		if($asString == true)
			return $json;
    }
	
	public static function UpdateJSON($path, $newJSON)
    {
		$fileJSON = JSONHandler::GetWholeJSON($path, true);
		
		$tempArray = array();
		
		if ($fileJSON != null && $fileJSON != "null")
			$tempArray = json_decode($fileJSON);
		
	    array_push($tempArray, $newJSON);
		$jsonData = json_encode($tempArray);
		file_put_contents($path, $jsonData);
    }
}