<?php

APIHTML::GETAPIHTMLAll();

class APIHTML
{
    public static function GETAPIHTMLAll()
    {
		try
		{	
			require_once($_SERVER['DOCUMENT_ROOT'] . '/CMS/HelperClasses/JSONHandler.php');

			$json = JSONHandler::GetConfigElement($_SERVER['DOCUMENT_ROOT'] . '/CMS/Documentation/APIJSON.php', null);

			$index = 0;

			$html = '';

			foreach ($json as $applicationHeader) { //CMS
				
				foreach ($applicationHeader as $iluvu) {
					$html .= '<h2 style="text-align:center;font-size:3em" class="display-4" id="Header'.$index.'">' . $iluvu['GroupName'] . '</h2>';
					foreach ($iluvu['Groups'] as $applicationCallGroup) { //CMS Group
						foreach ($applicationCallGroup as $applicationCall){ 
							foreach ($applicationCall as $Call){ //Calls
								$html .= '<h2 style="text-align:center;font-size:2em;" class="display-4" id="Group'.$index.'">' . $Call['CallName'] . '</h2>';
								foreach ($Call['Calls'] as $APICall) { //APICall ex: Bootstrap Alert Types
									$html .= self::GetAPIHTMLBlock($APICall, $index);
									$index += 1;
								}
							}
						}
					}
				}
			}

			return $html;
		} 
		catch (Exception $e)
		{
			LogHandler::SaveLog(LogType::ERROR, 'GETAPIHTMLAll', $e);
		}
    }

    public static function GETAPI($indexVal)
    {
		try
		{
			require_once($_SERVER['DOCUMENT_ROOT'] . '/CMS/HelperClasses/JSONHandler.php');

			$json = JSONHandler::GetConfigElement($_SERVER['DOCUMENT_ROOT'] . '/CMS/Documentation/APIJSON.php', null);

			$index = 0;

			$html = '';

			foreach ($json as $applicationHeader) { //CMS
				foreach ($applicationHeader as $iluvu) {
					foreach ($iluvu['Groups'] as $applicationCallGroup) { //CMS Group
						foreach ($applicationCallGroup as $applicationCall){ 
							foreach ($applicationCall as $Call){ //Calls
								foreach ($Call['Calls'] as $APICall) { //APICall ex: Bootstrap Alert Types
									if ($index == $indexVal){
										return $APICall; //Found exact call
									}
									$index += 1;
								}
							}
						}
					}
				}
			}

			return -1;
		}
		catch (Exception $e)
		{
			LogHandler::SaveLog(LogType::ERROR, 'GETAPI', $e);
		}
    }

    public static function GetAPIHTMLBlock($apiCallJSON, $index)
    {
		try
		{
			require_once ($_SERVER['DOCUMENT_ROOT']. $apiCallJSON['URL']);

			$value = '<div class="Item" id="API'.$index.'">
								<?php require_once ($_SERVER[\'DOCUMENT_ROOT\']. \'/CMS/HelperClasses/BootstrapAlertType.php\'); ?>
								<h3 style="display:inline">'.$apiCallJSON['Name'].'</h3><p style="display:inline; float: right; margin-top:.4em;" class="minify"><b>URL:</b> '.$apiCallJSON['URL'].'</p>
								<br>
								<br>
								<h6>Class: '.$apiCallJSON['Class'].'</h6>
								<h6>Returns: '.$apiCallJSON['Returns'].'</h6>
								<hr><p>'.$apiCallJSON['Description'].'</p>';

			if (isset($apiCallJSON['List']))
			{
				$value .= '<ul>';
				foreach ($apiCallJSON['List'] as $Item)
				{
					$value .= '<li>'.$Item['Item'].'</li>';
				}
				$value .= '</ul>';
			}

								$value .= '
								<h4><b>Try it out!</b></h4>

								<div class="Output">
									<h3 style="display: inline">Input:</h3>
									<br>
									<br>
									<form action="API.php" method="post">
										<input type="hidden" name="APINumber" value="'.$index.'"/>
										<div class="form-group row">
											<div class="col-sm-5">';

			$i = 0;
			foreach ($apiCallJSON['PlaceHolders'] as $Parameter)
			{
				$value .= '<input type="text" class="form-control" name="inputParam'.$i.'" placeholder="'.$Parameter[$i].'">';
				$i += 1;
			}

											$value .= '</div>
											<div class="col-sm-2">
												<input type="submit" class="form-control btn-primary btn" id="APIButton'.$index.'" value="Submit" name="SubmitInput">
											</div>
										</div>
									</form>
									<div><b>Syntax:</b> '.$apiCallJSON['Syntax'].'</div>
								</div>
								<div class="Output">
									<h3>Output:</h3>
									<p class="ButtonEnabled" style="float:right" onclick="showRAWHTML(\'API'.$index.'\')">Raw</p><p class="ButtonDisabled" style="float:right" onclick="showHTML(\'API'.$index.'\')">HTML</p>
									<input type="hidden" class="RawHTML" value="true" />
									<div class="OutputValue"></div>
								</div>
							</div>';

			return $value;
		}
		catch (Exception $e)
		{
			LogHandler::SaveLog(LogType::ERROR, 'GetAPIHTMLBlock', $e);
		}
    }
	
	public static function GetTree()
	{
		try
		{
			require_once($_SERVER['DOCUMENT_ROOT'] . '/CMS/HelperClasses/JSONHandler.php');

			$json = JSONHandler::GetConfigElement($_SERVER['DOCUMENT_ROOT'] . '/CMS/Documentation/APIJSON.php', null);

			$index = 0;

			$html = '<nav class="navbar navbar-expand-lg navbar-light"><a class="navbar-brand showMobileOnly" href="#">Calls</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTree" aria-controls="navbarTree" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button><div class="collapse navbar-collapse" id="navbarTree">';

			$html .= '<ul id="tree" class="list-group list-group-root well">';
			
			/*foreach ($json as $applicationHeader) { //CMS
				foreach ($applicationHeader as $iluvu) {
					$html .= '<li class="list-group-item"><ul class="list-group"><span>'.$iluvu['GroupName'].'</span>';
					foreach ($iluvu['Groups'] as $applicationCallGroup) { //CMS Group
						foreach ($applicationCallGroup as $applicationCall){
							foreach ($applicationCall as $Call){ //Calls
								$html .= '<li class="list-group-item"><ul class="list-group"><span>'.$Call['CallName'].'</span>';
								foreach ($Call['Calls'] as $APICall) { //APICall ex: Bootstrap Alert Types
									$html .= '<li class="list-group-item"><span>'.$APICall['Name'].'</span>';
								}
								$html .= '</ul></li>';
							}
						}
					}
					$html .= '</ul></li>';
				}
			}*/
			
			$index = 0;
			
			foreach ($json as $applicationHeader) { //CMS
				foreach ($applicationHeader as $iluvu) {
					$html .= '<a href="#Header'.$index.'" class="list-group-item">'.$iluvu['GroupName'].'</a><div class="list-group">';
					foreach ($iluvu['Groups'] as $applicationCallGroup) { //CMS Group
						foreach ($applicationCallGroup as $applicationCall){
							foreach ($applicationCall as $Call){ //Calls
								$html .= '<a href="#Group'.$index.'" class="list-group-item">'.$Call['CallName'].'</a><div class="list-group">';
								foreach ($Call['Calls'] as $APICall) { //APICall ex: Bootstrap Alert Types
									$html .= '<a href="#API'.$index.'" class="list-group-item">'.$APICall['Name'].'</a>';
									$index++;
								}
								$html .= '</li></div>';
							}
						}
					}
					$html .= '</li></div>';
				}
			}
			
			$html .= '</ul></div></nav>';
			
			return $html;
		}
		catch (Exception $e)
		{
		LogHandler::SaveLog(LogType::ERROR, 'GetTree', $e);	
		}
	}
}