<?php
	session_start();

	function autoloadClasses($class_name) 
	{
	    $array_paths = array(
	        'classes/common', 
	        'classes/user'
	    );

	    foreach($array_paths as $path)
	    {
	        $file = sprintf('%s/%s.php', $path, strtolower($class_name));
	        //added this for fun
	        $file = dirname(__FILE__) . '/../../' . $file;
	        if (is_file($file)) 
	        {
	            require_once $file;
	        } 

	    }
	}

	spl_autoload_register('autoloadClasses');

	/*require_once 'core/config.php';
	require_once 'functions/sanitize.php';*/
	/*DEV:*/
	require_once dirname(__FILE__) . '/../../core/config.php';
	require_once dirname(__FILE__) . '/../../functions/sanitize.php';

	if (Cookie::exists(Config::getValue('remember/cookie_name')) && !Session::exists(Config::getValue('session/session_name')))		
	{
		$hash = Cookie::get(Config::getValue('remember/cookie_name'));
		$hashCheck = Database::getInstance()->select('users_session', array('hash', '=', $hash));

		if ($hashCheck->getCount())
		{
			$user = new User($hashCheck->getFirstResult()->user_id);
			$user->login();
		}
	}
