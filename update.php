<?php

	require_once 'functions/user/init.php';

	$user = new User();

	if (!$user->isLoggedIn())
	{
		Redirect::to('index.php');
	}

	if (Input::exists())
	{
		if (Token::check(Input::get('token')))
		{
			$validate = new Validate();

			if (Input::get('type') == 'general')
			{
				$validation = $validate->check($_POST, array(
						'firstname' => array(
								'required' => true,
								'min_len' => 2,
								'max_len' => 50
							)));
			}
			else if (Input::get('type') == 'password')
			{
				$validation = $validate->check($_POST, array(		
					'password_current' => array(
						'required' => true,
						'min_len' => 6
						),
					'password_new' => array(
						'required' => true,
						'min_len' => 6
						),
					'password_new_again' => array(
						'required' => true,
						'min_len' => 6,
						'matches' => 'password_new'
						)
				));
			}
			if ($validation->isPassed())
			{
				try
				{
					if (Input::get('type') == 'password')
					{
						if (Hash::make(Input::get('password_current'), $user->getData()->salt) !== $user->getData()->password)
						{
							echo 'Въведената парола не съвпада с оригинала.';
						}
						else {
							$salt = Hash::salt(32);
							$user->update(array(
									'password' => Hash::make(Input::get('password_new'), $salt),
									'salt' => $salt
								));

							Session::flash('home', 'Паролата ви беше сменена успешно.');
							Redirect::to('index.php');							
						}
					}
					else if (Input::get('type') == 'general')
					{
						$user->update(array(
								'firstname' => Input::get('firstname')
								));

						Session::flash('home', 'Профилът ви беше обновен успешно.');
						Redirect::to('index.php');											
					}					
				} 
				catch (Exception $e)
				{
					die($e->getMessage());
				}
			}
			else 
			{
				foreach ($validation->getErrors() as $error) {
					echo $error, '<br>';
				}
			}
		}
	}
?>

<?php $token = Token::generate(); ?>
<meta charset="UTF-8">
<fieldset>
	<legend>Основни</legend>
	<form action="" method="post">
		<div class="field">
			<label for="firstname">Име</label>
			<input type="text" name="firstname" value="<?php echo escape($user->getData()->firstname); ?>">
		</div>

		<input type="submit" value="Промени">
		<input type="hidden" name="type" value="general">
		<input type="hidden" name="token" value="<?php echo $token; ?>">	
	</form>
</fieldset>
<fieldset>
	<legend>Достъп</legend>
	<form action="" method="post">
		<div class="field">
			<label for="password_current">Парола: </label>
			<input type="password" name="password_current" id="password_current">
		</div>
		
		<div class="field">
			<label for="password_new">Нова парола: </label>
			<input type="password" name="password_new" id="password_new">
		</div>

		<div class="field">
			<label for="password_new_again">Потвърди парола: </label>
			<input type="password" name="password_new_again" id="password_new_again">
		</div>

		<input type="submit" value="Промени">
		<input type="hidden" name="token" value="<?php echo $token; ?>">		
		<input type="hidden" name="type" value="password">		
	</form>
</fieldset>