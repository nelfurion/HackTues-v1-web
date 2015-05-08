<?php

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(-1);

	require_once 'core/user/init.php';

	if (Session::exists('success'))
	{
		echo Session::flash('success');
	}

	echo "<p style='font-family: Calibri;'>Na maika ti potkata.</p> <!-- Za niki -->";
?>