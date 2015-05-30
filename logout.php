<?php
	require_once 'functions/user/init.php';

	$user = new User();
	$user->logout();

	Redirect::to('home');