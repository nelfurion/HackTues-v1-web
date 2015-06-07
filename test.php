<?php
	echo "ASDASDASDASDASD";
	use use Facebook\FacebookSession;
	use Facebook\FacebookRedirectLoginHelper;
	
	$helper = new FacebookRedirectLoginHelper();
	try {
	$session = $helper->getSessionFromRedirect();
	} catch(FacebookRequestException $ex) {
	// When Facebook returns an error
	echo $ex;
	} catch(\Exception $ex) {
	// When validation fails or other local issues
	echo $ex;
	}
	if ($session) {
	// Logged in
	echo $session;
	//$loginUrl = $helper->getLoginUrl();
	}
?>