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
			
			JSONHandler::AddJSON($_SERVER['DOCUMENT_ROOT'] . '/CMS/Logs/Log.php', $errorLog);
		}
		
		public static function GetLogCount()
		{
			require_once($_SERVER['DOCUMENT_ROOT'] . '/CMS/HelperClasses/JSONHandler.php');
			
			$json = JSONHandler::GetWholeJSON($_SERVER['DOCUMENT_ROOT'] . '/CMS/Logs/Log.php');
			
			$i = 0;
			
			if ($json != null)
			{
				foreach ($json as $log)
				{
					$i++;
				}
			}
			
			return $i;
		}
		
		public static function ReturnLogType($logType)
		{
			switch($logType)
			{
				case LogType::SUCCESS:
					return 'Success';
					break;
				case LogType::ERROR:
					return 'Error';
					break;
				case LogType::WARNING:
					return 'Warning';
					break;
				case LogType::DANGER:
					return 'Danger';
					break;
				default:
					return 'Unknown';
					break;
			}
		}
		
		public static function ReturnLogTable()
		{
			require_once($_SERVER['DOCUMENT_ROOT'] . '/CMS/HelperClasses/JSONHandler.php');
			
			$json = JSONHandler::GetWholeJSON($_SERVER['DOCUMENT_ROOT'] . '/CMS/Logs/Log.php');
			
			$html = '';
			
			$logCount = LogHandler::GetLogCount();
			$i = 0;
			
			if ($json != null)
			{
				$json = array_reverse($json);
				
				foreach ($json as $log)
				{
					$isException = false;
					
					if (isset($log['ExceptionMessage']) && $log['ExceptionMessage'] != null)
					{
							$isException = true;
					}
					
					$number = ($logCount - $i);
					$type = LogHandler::ReturnLogType($log['LogType']);
					$message = $isException ? $log['ExceptionMessage'] : $log['Message'];
					$line = $isException ? $log['Line'] : 'null';
					$stackTrace = $isException ? $log['StackTrace'] : 'null';
					$file = $isException ? $log['File'] : 'null';
					$time = $log['Time'];
					$html .= '<tr>
							  <th>' . $number . '</th>
							  <td>' . $type . '</td>
							  <td>' . json_encode($message) . '</td>
							  <td>' . $stackTrace . '</td>
							  <td>' . $file . '</td>
							  <td>' . $line . '</td>
							  <td>' . $time . '</td>
							</tr>';
					$i++;
				}
			}
			
			return $html;
		}
	}

    abstract class LogType
    {
		const SUCCESS = "0";
		const ERROR = "1";
        const WARNING = "2";
        const DANGER = "3";
    }