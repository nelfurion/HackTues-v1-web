<?php
	class User 
	{
		private $_db,
				$_data,
				$_sessionName,
				$_isLoggedIn;

		public function __construct($user = null)
		{
			$this->_db = Database::getInstance();
			$this->_sessionName = Config::getValue('session/session_name');

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

		public function login($username = null, $password = null)
		{
			$user = $this->find($username);
			
			if ($user)
			{
				if ($this->getData()->password === Hash::make($password, $this->getData()->salt))
				{
					Session::put($this->_sessionName, $this->getData()->id);
					return true;
				}
			}

			return false;
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