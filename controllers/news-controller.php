<?php
	require '/../functions/dbquery.php';

	if (isset($_GET['func'])) {
		switch ($_GET['func']) {
			case 'getNews':
				if (!isset($_GET['startIndex'])) {
					exit("To get news, you need a startIndex. StartIndex is not given.");
				}
				showFiveNews($_GET['startIndex']);
				break;
			
			default:
				# code...
				break;
		}
	}
	else
	{
		$newsPerPage = 5;
		$reqData = ["name", "content"];
		$news = getData("news", $reqData);

		if (!count($news)) {
			echo "В момента няма информация.";
			return;
		}

		$numOfPages = count($news) / $newsPerPage;
		if (count($news) % $newsPerPage != 0) {
			$numOfPages++;
		}

		for ($i=0; $i < $newsPerPage; $i++) { 
			echo
				"<article class=\"newsArticle clear\">
					<h3>" . $news[$i]->name . "</h3>
					<p>" . $news[$i]->content . "</p>
				</article>";
		}
	}
	

	

	function showFiveNews($startIndex) {
		$newsPerPage = 5;
		if ($startIndex != 0) {
			$startIndex *= $newsPerPage;
		}

		$reqData = ["name", "content"];
		$news = getData("news", $reqData);

		if (!count($news)) {
			echo "В момента няма информация.";
			return;
		}

		$numOfPages = count($news) / $newsPerPage;
		if (count($news) % $newsPerPage != 0) {
			$numOfPages++;
		}

		$index = $startIndex;
		$endIndex = $startIndex + $newsPerPage;

		while ($index < count($news) && $index < $endIndex) {
			echo
				"<article class=\"newsArticle clear\">
					<h3>" . $news[$index]->name . "</h3>
					<p>" . $news[$index]->content . "</p>
				</article>";
			$index++;
		}
	}
?>