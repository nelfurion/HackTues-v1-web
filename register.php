<?php
	
	require_once 'functions/user/init.php';

	if (Input::exists())
	{
		if (Token::check(Input::get('token')))
		{
			$validate = new Validate();
			$validation = $validate->check($_POST, array(
				'username' => array(
					'required' => true,
					'min_len' => 2,
					'max_len' => 20,
					'unique' => 'users'
				),
				'password' => array(
					'required' => true,
					'min_len' => 6
				),
				'password-again' => array(
					'required' => true,
					'matches' => 'password'
				),
				'first-name' => array(
					'required' => true,
					'min_len' => 2,
					'max_len' => 50
				),
				'last-name' => array(
					'required' => true,
					'min_len' => 2,
					'max_len' => 50
				),
				'email' => array(
					'required' => true,
					'min_len' => 2,
					'max_len' => 50
				),
				'class-number' => array(
					'require' => true,
					'min_num' => 8,
					'max_num' => 12
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
							'first-name' => Input::get('first-name'),
							'last-name' => Input::get('last-name'),
							'email' => Input::get('email'),
							'class' => Input::get('class-number') . Input::get('class-letter'),					
							'timestamp' => date('Y-m-d H:i:s'),
							'level' => 1
						));

					Session::flash('home', 'You registered successfully and can now login.');
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
		<label for="first-name">Име: </label>
		<input type="text" name="first-name" id="first-name" value="<?php echo escape(Input::get('first-name')); ?>" autocomplete="off">
	</div>

	<div class="field">
		<label for="last-name">Фамилия: </label>
		<input type="text" name="last-name" id="last-name" value="<?php echo escape(Input::get('last-name')); ?>" autocomplete="off">
	</div>

	<div class="field">
		<label for="class-number">Клас: </label>
		<input type="number" name="class-number" min="8" max="12" id="class-number" value="<?php echo escape(Input::get('class-number')); ?>" autocomplete="off">
		<select name="class-letter">
		  <option value="A">А</option>
		  <option value="B">Б</option>
		  <option value="V">В</option>
		  <option value="G">Г</option>
		</select>		
	</div>

	<div class="field">
		<label for="email">Ел. поща: </label>
		<input type="email" name="email" id="email" value="<?php echo escape(Input::get('email')); ?>" autocomplete="off">
	</div>

	<div class="field">
		<label for="username">Потребител: </label>
		<input type="text" name="username" id="username" value="<?php echo escape(Input::get('username')); ?>" autocomplete="off">
	</div>

	<div class="field">
		<label for="password">Парола: </label>
		<input type="password" name="password" id="password">
	</div>

	<div class="field">
		<label for="password-again">Потвърди парола: </label>
		<input type="password" name="password-again" id="password_again">		
	</div>

	<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
	<input type="submit" value="Register">
</form>