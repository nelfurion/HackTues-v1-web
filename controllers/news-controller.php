<?php
	//require '/../functions/dbquery.php';
	require 'functions/dbquery.php';
	
	if (isset($_GET['func'])) {
		switch ($_GET['func']) {
			case 'getNews':
				if (!isset($_GET['startIndex'])) {
					exit("To get news, you need a startIndex. StartIndex is not given.");
				}
				showFiveNews($_GET['startIndex'] - 1);
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
				'<article class="newsArticle clear">
					<h3 class="news-title">' . $news[$i]->name . '</h3>
					<p class="news-content">' . $news[$i]->content . '</p>
				</article>';
		}
	}
	
	function showFiveNews($startIndex) {
		//the $startIndex is taken - 1 in the call, for pagination reasons
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
				'<article class="newsArticle clear">
					<h3 class="news-title">' . $news[$index]->name . '</h3>
					<p class="news-content">' . $news[$index]->content . '</p>
				</article>';
			$index++;
		}
	}

	function paginate() {
		$newsPerPage = 5;
		$reqData = ['*'];
		$news = getData('news', $reqData);
		$pagesCount;
		echo '<li><a class="page-link selected-page" onclick="return false;" href="#">1</a></li>';

		if (count($news) % 5 == 0) {
			$pagesCount = count($news) / 5;
		}
		else {
			$pagesCount = count($news) / 5 + 1;
		}

		for ($i=2; $i <= $pagesCount; $i++) { 
			echo '<li><a class="page-link" onclick="return false;" href="#">' . $i . '</a></li>';
		}
	}
?>