<?php
    class DatabaseCredentials
	{
        public static function GetDSN()
        {
            require_once($_SERVER['DOCUMENT_ROOT'] . '/CMS/HelperClasses/JSONHandler.php');

            $customDSN = JSONHandler::GetConfigElement($_SERVER['DOCUMENT_ROOT'].'/CMS/Config/JSONDatabaseConfig.php', 'customDSN');

            if ($customDSN == null || $customDSN == "") {

                $driver = JSONHandler::GetConfigElement($_SERVER['DOCUMENT_ROOT'] . '/CMS/Config/JSONDatabaseConfig.php', 'driver');
                $host = JSONHandler::GetConfigElement($_SERVER['DOCUMENT_ROOT'] . '/CMS/Config/JSONDatabaseConfig.php', 'host');
                $databaseName = JSONHandler::GetConfigElement($_SERVER['DOCUMENT_ROOT'] . '/CMS/Config/JSONDatabaseConfig.php', 'databaseName');
                $charset = JSONHandler::GetConfigElement($_SERVER['DOCUMENT_ROOT'] . '/CMS/Config/JSONDatabaseConfig.php', 'charset');

                $dsn = $driver . ':host=' . $host . ';dbname=' . $databaseName . ';';
                if ($charset != null && $charset != "") $dsn .= 'charset=' . $charset;

            } else {
                $dsn = $customDSN;
            }

            return $dsn;
        }

        public static function GetCredentials($type){
            require_once($_SERVER['DOCUMENT_ROOT'] . '/CMS/HelperClasses/JSONHandler.php');

            $users = JSONHandler::GetConfigElement($_SERVER['DOCUMENT_ROOT'].'/CMS/Config/JSONDatabaseConfig.php', 'users');

            foreach ($users as &$value) {
                if ($value['type'] == $type) {

                    $cred = new Credentials();

                    $cred->userName = $value['userName'];
                    $cred->password = $value['password'];

                    return $cred;
                }
            }

            return null;
        }
	}

	class Credentials
    {
        public $userName = "";
        public $password = "";
    }
?>