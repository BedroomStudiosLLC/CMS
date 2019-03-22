<?php

	class LogHandler
	{	
		public static function SaveLog($logType, $message, $exception = null)
		{
			require_once($_SERVER['DOCUMENT_ROOT'] . '/CMS/HelperClasses/JSONHandler.php');
		
			$errorLog = array();
		
			if ($exception == null)
				$errorLog = array('LogType' => $logType, 'Message' => $message, 'Time' => date("Y-m-d H:i:s"));
			else
				$errorLog = array('LogType' => $logType, 'Message' => $exception->getMessage(), 'Time' => date("Y-m-d H:i:s"), 'Exception' => $exception, 'Line' => $exception->getLine(), 'ExceptionMessage' => $exception->getMessage(), 'StackTrace' => $exception->getTraceAsString(), 'File' => $exception->getFile());
			
			JSONHandler::UpdateJSON($_SERVER['DOCUMENT_ROOT'] . '/CMS/Logs/Log.php', $errorLog);
		}
	}

    abstract class LogType
    {
		const SUCCESS = "0";
		const ERROR = "1";
        const WARNING = "2";
        const DANGER = "3";
    }