<?php

APIHTML::GETAPIHTMLAll();

class APIHTML
{
    public static function GETAPIHTMLAll()
    {
        require_once($_SERVER['DOCUMENT_ROOT'] . '/CMS/HelperClasses/JSONHandler.php');

        $json = JSONHandler::GetConfigElement($_SERVER['DOCUMENT_ROOT'] . '/CMS/Documentation/APIJSON.php', null);

        $index = 0;

        $html = '';

        foreach ($json as $type) {
			foreach ($type as $t){	
				$html .= '<h2 style="text-align:center;">' . $t['CallName'] . '</h2>';
				foreach ($t['Calls'] as $APICall) { //APICall ex: Bootstrap Alert Types
					$html .= self::GetAPIHTMLBlock($APICall, $index);
					$index += 1;
				}
			}
        }

        return $html;
    }

    public static function GETAPI($indexVal)
    {
        require_once($_SERVER['DOCUMENT_ROOT'] . '/CMS/HelperClasses/JSONHandler.php');

        $json = JSONHandler::GetConfigElement($_SERVER['DOCUMENT_ROOT'] . '/CMS/Documentation/APIJSON.php', null);

        $index = 0;

        $html = '';

		foreach ($json as $type) {
			foreach ($type as $t){	
				foreach ($t['Calls'] as $APICall) { //APICall ex: Bootstrap Alert Types
					if ($index == $indexVal){
						return $APICall;
					}
					$index += 1;
				}
			}
        }

        return -1;
    }

    public static function GetAPIHTMLBlock($apiCallJSON, $index)
    {

        require_once ($_SERVER['DOCUMENT_ROOT']. $apiCallJSON['URL']);

        $value = '<div class="Item" id="API'.$index.'">
                            <?php require_once ($_SERVER[\'DOCUMENT_ROOT\']. \'/CMS/HelperClasses/BootstrapAlertType.php\'); ?>
                            <h3 style="display:inline">'.$apiCallJSON['Name'].'</h3><p style="display:inline; float: right"><b>URL:</b> '.$apiCallJSON['URL'].'</p>
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
}