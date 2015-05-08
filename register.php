<?php

	require_once 'core/user/init.php';

	if (Input::exists())
	{
		if (Token::check(Input::get('token')))
		{
			$validate = new Validate();
			// TODO: Modify the database values here.
			$validation = $validate->check($_POST, array(
				'username' => array(
					'required' => true,
					'min' => 2,
					'max' => 20,
					'unique' => 'users'
				),
				'password' => array(
					'required' => true,
					'min' => 6
				),
				'password_again' => array(
					'required' => true,
					'matches' => 'password'
				),
				'name' => array(
					'required' => true,
					'min' => 2,
					'max' => 50
				)
			));

			if ($validation->isPassed())
			{
				$user = new User();

				$salt = Hash::salt(32);

				try 
				{
					$user->create(array(
							'username' => Input::get('username'),
							'password' => Hash::make(Input::get('password'), $salt),
							'salt' => $salt,
							'first_name' => Input::get('name'),
							'timestamp' => date('Y-m-d H:i:s'),
							'level' => 1
						));

					Session::flash('success', 'You registered successfully and can login successfully.');
					Redirect::to('index.php');					
				} 
				catch (Exception $e)
				{
					die($e->getMessage());
				}
			}
			else
			{
				foreach ($validation->getErrors() as $error)
				{
					echo $error, '<br>';
				}
			}
		}
	}

?>

<form action="" method="post">
	<div class="field">
		<label for="username">Username: </label>
		<input type="text" name="username" id="username" value="<?php echo escape(Input::get('username')); ?>" autocomplete="off">
	</div>

	<div class="field">
		<label for="password">Password: </label>
		<input type="password" name="password" id="password">
	</div>

	<div class="field">
		<label for="password_again">Confirm password: </label>
		<input type="password" name="password_again" id="password_again">		
	</div>

	<div class="field">
		<label for="name">Name: </label>
		<input type="text" name="name" id="name" value="<?php echo escape(Input::get('name')); ?>">
	</div>

	<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
	<input type="submit" value="Register">
</form>