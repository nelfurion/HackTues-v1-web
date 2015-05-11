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
	        if (is_file($file)) 
	        {
	            require_once $file;
	        } 

	    }
	}

	spl_autoload_register('autoloadClasses');

	require_once 'core/config.php';
	require_once 'functions/sanitize.php';
