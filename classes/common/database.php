<?php

	class Database 
	{
		private static $_instance = null;
		private $_pdo, 
				$_query, 
				$_error = false, 
				$_results, 
				$_count = 0;

		private function __construct()
		{
			try 
			{
				$databaseHost = Config::getValue('mysql/host');
				$databaseName = Config::getValue('mysql/db');
				$databaseUsername = Config::getValue('mysql/username');
				$databasePassword = Config::getValue('mysql/password');
				$this->_pdo = new PDO('mysql:host=' . $databaseHost . ';dbname=' . $databaseName, $databaseUsername, $databasePassword, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
			} 
			catch (PDOException $e)
			{
				die($e->getMessage());
			}
		}

		public static function getInstance()
		{
			if (!isset(self::$_instance))
			{
				self::$_instance = new Database();
			}

			return self::$_instance;
		}

		public function rawQuery($sql, $params = array())
		{
			$this->_error = false;
			if ($this->_query = $this->_pdo->prepare($sql))
			{
				$currentParamPos = 1;
				if (count($params))
				{
					foreach ($params as $param)
					{
						$this->_query->bindValue($currentParamPos, $param);
						$currentParamPos++;
					}
				}

				if ($this->_query->execute())
				{
					$this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
					$this->_count = $this->_query->rowCount();
				}
				else
				{
					$this->_error = true;
				}
			}

			return $this;
		}

		public function rawAction($action, $table, $where = array())
		{
			if (count($where) == 3)
			{
				$operators = array('=', '>', '<', '>=', '<=');

				$field    = $where[0];
				$operator = $where[1];
				$value    = $where[2];

				if (in_array($operator, $operators))
				{
					$queryString = "{$action} FROM {$table} WHERE {$field} {$operator} ?";
					if (!$this->rawQuery($queryString, array($value))->getLastError())
					{
						return $this;
					}
				}
			}

			return false;
		}

		public function select($table, $where)
		{
			return $this->rawAction('SELECT *', $table, $where);
		}

		public function delete($table, $where)
		{
			return $this->rawAction('DELETE', $table, $where);
		}

		public function insert($table, $fields = array())
		{
			if (count($fields))
			{
				$keys = array_keys($fields);
				$values = '';
				$currentFieldsCount = 1;

				foreach ($fields as $field)
				{
					$values .= '?';
					if ($currentFieldsCount < count($fields))
					{
						$values .= ', ';
					}
					$currentFieldsCount++;
				}

				$queryString = "INSERT INTO {$table} (`" . implode('`, `', $keys) ."`) VALUES ({$values})";

				if (!$this->rawQuery($queryString, $fields)->getLastError())
				{
					return true;
				}
			}

			return false;
		}

		public function update($table, $id, $fields)
		{
			$set = '';
			$currentFieldsCount = 1;

			foreach ($fields as $name => $value)
			{
				$set .= "{$name} = ?";
				if ($currentFieldsCount < count($fields))
				{
					$set .= ', ';
				}
				$currentFieldsCount++;
			}

			$queryString = "UPDATE {$table} SET {$set} WHERE id = {$id}";

			if (!$this->rawQuery($queryString, $fields)->getLastError())
			{
				return true;
			}

			return false;				
		}

		public function getResults()
		{
			return $this->_results;
		}

		public function getFirstResult()
		{
			return $this->getResults()[0];
		}

		public function getLastError()
		{
			return $this->_error;
		}

		public function getCount()
		{
			return $this->_count;
		}

	}