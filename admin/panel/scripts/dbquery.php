<?php
	/*
		This script is buil over rlf's main script.
	*/
	require_once dirname(__FILE__) . '/../../../classes/common/config.php';
	require_once dirname(__FILE__) . '/../../../classes/common/database.php';

	//print_r($_GET);

	if (isset($_GET['func'])) {
		switch ($_GET['func']) {
			case 'saveNews':
					saveNews();
				break;
			case 'updateNews':
					updateNews($_GET['id'], $_GET['content']);
				break;
			case 'removeNews':
				if (!isset($_GET['id'])) {
					exit("ERROR: Trying to delete news, without given id!");
				}
				removeNews($_GET['id']);

				break;
			//TODO: fix getData and stuff
			default:
				
				break;
		}
	}

	/*
	 ---------------------------------
	Fetches the data, from the database,
	 and sends it to the content handler.
 	*/ 
	function getData($table, $data = array(), $parameters = array())
	{
		$selectedData = implode(", ", $data);
		if (!count($data)) {
			$selectedData = "*";
		}
		
		$db = Database::getInstance();
		$db->rawQuery("SELECT " . $selectedData . " FROM " .$table, $parameters);
		return $db->getResults();
	}

	/*function saveNews()
	{
		$db = Database::getInstance();
		$name = $_GET['name'];
		$content = $_GET['content'];

		$db->insert("news", array('name' => $name, 'content' => $content));
	}*/

	//Newer function
	function updateNews($id, $content)
	{
		$db = Database::getInstance();
		$db->update("news", $id, ['content' => $content]);
	}

	function saveNews($content)
	{
		$db = Database::getInstance();
		$db->insert("news", array('content' => $content));
	}

	function removeNews($id)
	{
		$db = Database::getInstance();
		$db->delete('news', ['id', '=', $id]);
	}
 ?>