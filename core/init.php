<?php
	session_start();

	$GLOBALS["config"] = array(
		'mysql' => array(
			'host' => '127.0.0.1',
			'username' => 'root',
			'password' => 'test',
			'db' => 'access' // TODO: Change
		),
		'remember' => array(
			'cookie_name' => 'hash',
			'cookie_expiry' => 604800
		),
		'session' => array(
			'session_name' => 'user',
			'token_name' => 'token'
		),
	);

	function autoloadClasses($class_name) 
	{
	    $array_paths = array(
	        'classes/common', 
	        'classes/user'
	    );

	    foreach($array_paths as $path)
	    {
	        $file = sprintf('%s/%s.php', $path, strtolower($class_name));
	        if (is_file($file)) 
	        {
	            require_once $file;
	        } 

	    }
	}

	spl_autoload_register('autoload_class_multiple_directory');

	require_once 'functions/sanitize.php';