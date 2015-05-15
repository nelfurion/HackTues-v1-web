<?php
	class User 
	{
		private $_db,
				$_data,
				$_sessionName,
				$_cookieName,
				$_isLoggedIn;

		public function __construct($user = null)
		{
			$this->_db = Database::getInstance();
			$this->_sessionName = Config::getValue('session/session_name');
			$this->_cookieName = Config::getValue('remember/cookie_name');

			if (!$user)
			{
				if (Session::exists($this->_sessionName))
				{
					$user = Session::get($this->_sessionName);

					if ($this->find($user))
					{
						$this->_isLoggedIn = true;
					}
					else 
					{
						// TODO: Logout
					}
				}
			}
			else 
			{
				$this->find($user);
			}
		}

		public function create($fields)
		{
			if (!$this->_db->insert('users', $fields))
			{
				throw new Exception('There was a problem creating an account.');
			}
		}

		public function find($user = null)
		{
			if ($user)
			{
				$field = (is_numeric($user)) ? 'id' : 'username';
				$data = $this->_db->select('users', array($field, '=', $user));

				if ($data->getCount())
				{
					$this->_data = $data->getFirstResult();
					return true;
				}
			}

			return false;
		}

		public function login($username = null, $password = null, $remember = null)
		{
			$user = $this->find($username);
			
			if (!$username && !$password && $this->exists())
			{
				Session::put($this->_sessionName, $this->getData()->id);
			}
			else {
				if ($user)
				{
					if ($this->getData()->password === Hash::make($password, $this->getData()->salt))
					{
						Session::put($this->_sessionName, $this->getData()->id);
						if ($remember)
						{
							$hash = Hash::unique();
							$hashCheck = $this->_db->select('users_session', array('user_id', '=', $this->getData()->id));

							if (!$hashCheck->getCount())
							{
								$this->_db->insert('users_session', array(
										'user_id' => $this->getData()->id,
										'hash' => $hash
									));
							}
							else 
							{
								$hash = $hashCheck->getFirstResult()->hash;
							}

							Cookie::put($this->_cookieName, $hash, Config::getValue('remember/cookie_expiry'));
						}

						return true;
					}
				}
			}

			return false;			
		}

		public function exists()
		{
			return (!empty($this->_data)) ? true : false;
		}

		public function logout()
		{
			$this->_db->delete('users_session', array('user_id', '=', $this->getData()->id));
			Session::delete($this->_sessionName);
			Cookie::delete($this->_cookieName);
		}

		public function getData()
		{
			return $this->_data;
		}

		public function isLoggedIn()
		{
			return $this->_isLoggedIn;
		}
	}