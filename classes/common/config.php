<?php

	//require '/../../core/config.php';
	require dirname(__FILE__) . '/../../core/config.php'; // This shoudln't work. God knows why it does.
	
	class Config 
	{
		public static function getValue($path = null) 
		{
			if ($path) 
			{
				$config = $GLOBALS['config'];
				$path = explode('/', $path);

				foreach($path as $nextToken)
				{
					if (isset($config[$nextToken]))
					{
						$config = $config[$nextToken];
					}
				}

				return $config;
			}
		}
	}