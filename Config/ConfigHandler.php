<?php

class ConfigHandler
{
    public static function GetConfigElement($path, $element)
    {

        $configFile = file_get_contents($path);

        $jsonConfig = json_decode($configFile, true);

        return $jsonConfig[$element];

    }
}