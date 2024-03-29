<?php

	require_once ($_SERVER['DOCUMENT_ROOT']. '/CMS/Documentation/APIHTML.php');

    $isRunningAPICommand = false;

    //Show API calls and plugins
    if (isset($_POST['SubmitInput']))
    {
        $isRunningAPICommand = true;
    }

?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
    <head>
        <title>CMS - API</title>
        <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/CMS/Master/HTMLHeader.php'); ?>
        <!-- Bootstrap documentation: https://getbootstrap.com/docs/4.3/getting-started/introduction/ -->
        <style>
            .Main {
                //border-style: solid;
                //border-width: 2px;
                //border-radius: .5em;
                //border-color: #04569A;
            }
            .Item {
                border-style: solid;
                border-width: 2px;
                border-radius: .5em;
                background-color: white;
                padding: 1em;
                margin: 1em;
                border-color: lightgray;
            }
            .Output{
                background-color: lightgray;
                border-radius: .5em;
                padding: 1em;
                margin-top: 1em;
            }
            .OutputValue{
                background-color: whitesmoke;
                border-radius: .5em;
                padding: 1em;
                margin-top: 2em;
            }
            .ButtonDisabled{
                color: #04569A;
                background-color: whitesmoke;
                padding: .2em;
            }
            .ButtonEnabled{
                color: whitesmoke;
                background-color: #04569A;
                padding: .2em;
            }
            .active-cyan-4 input[type=text]:focus:not([readonly]) {
                border: 1px solid #04569A;
                box-shadow: 0 0 0 1px #04569A;
            }
            .active-cyan-3 input[type=text] {
                border: 1px solid #4dd0e1;
                box-shadow: 0 0 0 1px #4dd0e1;
            }
			.navigation-tree li span {
				border: 5px solid #4dd0e1;
				padding: .2em;
				margin: .2em;
				//background-color: yellow;
			}
			
			.list-group.list-group-root {
			  padding: 0;
			  overflow: hidden;
			}

			.list-group.list-group-root .list-group {
			  margin-bottom: 0;
			}

			.list-group.list-group-root .list-group-item {
			  border-radius: 0;
			  border-width: 1px 0 0 0;
			  color: black;
			}

			.list-group.list-group-root > .list-group-item:first-child {
			  border-top-width: 0;
			}

			.list-group.list-group-root > .list-group > .list-group-item {
			  padding-left: 30px;
			}

			.list-group.list-group-root > .list-group > .list-group > .list-group-item {
			  padding-left: 45px;
			}
		</style>
        <script>
            function showRAWHTML(APIID) {
                if( $('#'+APIID).find('.RawHTML').val() == "true") {
                    $(document).ready(function () {
                        $('#'+APIID).find('.OutputValue').text($('#'+APIID).find('.OutputValue').html());
                        var raw = $('#'+APIID).find('.ButtonEnabled');
                        var HTML = $('#'+APIID).find('.ButtonDisabled');
                        raw.attr('class', 'ButtonDisabled');
                        HTML.attr('class', 'ButtonEnabled');
                        $('#'+APIID).find('.RawHTML').val("false");
                    });
                }
            }

            function showHTML(APIID) {
                if( $('#'+APIID).find('.RawHTML').val() == "false")
                {
                    $(document).ready( function() {
                        $('#'+APIID).find('.OutputValue').html($('#'+APIID).find('.OutputValue').text())
                        var raw = $('#'+APIID).find('.ButtonDisabled');
                        var HTML = $('#'+APIID).find('.ButtonEnabled');
                        raw.attr('class', 'ButtonEnabled');
                        HTML.attr('class', 'ButtonDisabled');
                        $('#'+APIID).find('.RawHTML').val("true")
                    });
                }
            }
        </script>
    </head>
    <body>
        <div class="container-fluid">
			<?php require_once($_SERVER['DOCUMENT_ROOT'].'/CMS/Master/HTMLAdminNavSidebar.php') ?>
			<h1 style="text-align: center;" class="display-4">API Calls</h1>
			<hr>
            <div class="row flex-column-reverse flex-md-row" style="margin-top: 4em;">
                <div class="col-md-2">
				</div>
                <div class="col-md-8">
                    <!--<div class="active-cyan-3 active-cyan-4 mb-4">
                        <input class="form-control" type="text" placeholder="Search" aria-label="Search">
                    </div>-->

                    <div class="Main" style="">

                        <?php
                            echo APIHTML::GETAPIHTMLAll();
                        ?>

                    </div>
                </div>
                <div class="col-md-2">
				<?php
					echo APIHTML::GetTree(); 
				?>
				</div>
            </div>
        </div>
        <?php

        if ($isRunningAPICommand)
        {
			try
			{
				$outputValue = 'Error';
				$failed = false;

				echo '<script>window.location.hash = "'.'API'.$_POST['APINumber'].'"</script>';

				$apiCall = APIHTML::GETAPI($_POST['APINumber']);

				if ($apiCall == -1)
				{
					echo 'API Error';
				}

				switch ($apiCall['Type'])
				{
					case 'CONSTANT':
						$value = GetConstant($_POST['inputParam0']);
						if ($value == -1)
							$outputValue = 'Error: Constant not valid.';
						else
							$outputValue = $value;
						break;

					case 'FUNCTION':
						if (isset($_POST['inputParam0'])) {

							$parameterArray = array();

							for ($i = 0; $i < 2; $i++) {
								if (isset($apiCall['PlaceHolders'][$i]['Type']))
								{
									switch ($apiCall['PlaceHolders'][$i]['Type']) {
										case "CONSTANT":
											$value = GetConstant($_POST['inputParam' . $i]);
											if ($value == -1)
											{
												$outputValue = 'Error: Constant not valid.';
												$failed = true;
											}

											$parameterArray[$i] = $value;
											break;
									}
								}
								else
								{
									$parameterArray[$i] = $_POST['inputParam' . $i];
								}
							}

							if (!$failed) //Run function if hadn't failed
								$outputValue = call_user_func_array($apiCall['FunctionName'], $parameterArray);
						}
						break;
				}

				echo "<script>$(document).ready( function() { $('#API" . $_POST['APINumber'] . "').find('.OutputValue').html('" . $outputValue . "'); })</script>";
			}
			catch (Exception $e)
			{
				LogHandler::SaveLog(LogType::ERROR, 'isRunningAPICommand', $e);
			}
        }

        function GetConstant($constant)
        {
            if (defined($constant))
            {
                return constant($constant);
            }
            else
            {
                return -1;
            }
        }

        ?>
    </body>
</html>

