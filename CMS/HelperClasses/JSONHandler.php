<?php

class JSONHandler
{
    public static function GetConfigElement($path, $element)
    {

        $configFile = file_get_contents($path);

        $jsonConfig = json_decode($configFile, true);

        if ($element != null && $element != "")
        {
            return $jsonConfig[$element];
        }
        else{
            return $jsonConfig;
        }

    }
}