<?php
//	Controller
	require_once("../classes/class.Authentication.php");
	require_once("../classes/class.Session.php");

	$Session	= new TSession();
	$Authentication = new TAuthentication();

	$ControllerVars['loggedin'] = 0;	

	if($Authentication->isAuthorized()) {
		$ControllerVars['loggedin'] = 1;
	}
	else {
		if($_POST['submit'] == 'Submit') {
			if($Authentication->checkUserPass()) {
				$ControllerVars['loggedin'] = 1;
				$Authentication->successfulLogin();
			}
			else {
				$Authentication->failedLogin();
			}
		}
	}

	echo "Login status is: ".$ControllerVars['loggedin'];

	if($ControllerVars['loggedin'] == 0) {
		$content = file_get_contents("../templates/loginform.html");
		echo $content;
	}
