<?php
	class DatabaseConnection
	{
		public static function GetDatabaseConnection()
		{
			static $dbConnection = null;

			if ($dbConnection === null){

                require_once($_SERVER['DOCUMENT_ROOT'] . '/CMS/Config/DatabaseCredentials.php');

                $dsn = DatabaseCredentials::GetDSN();

                $cred = DatabaseCredentials::GetCredentials('default');

                if ($cred != null) {

                    $user = $cred->userName;
                    $pass = $cred->password;

                    $options = [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::ATTR_EMULATE_PREPARES => false,
                    ];

                    try {
                        $dbConnection = new PDO($dsn, $user, $pass, $options);
                    } catch (\PDOException $e) {
                        throw new \PDOException($e->getMessage(), (int)$e->getCode());
                    }
                } else {
                    echo 'Couldn\'t get database credentials';
                }
			}

			return $dbConnection;
		}
	}



