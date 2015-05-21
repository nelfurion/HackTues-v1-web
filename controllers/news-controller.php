<?php
	//require '/../functions/dbquery.php';
	require dirname(__FILE__) . '/../functions/dbquery.php';

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

	else {
		$newsPerPage = 5;
		$reqData = ["name", "content"];
		$news = getData("news", $reqData);

		if (!count($news)) {
			echo "В момента няма информация.";
			return;
		}

		if (count($news) < 5) {
			$newsPerPage = count($news);
		}

		$numOfPages = count($news) / $newsPerPage;
		if (count($news) % $newsPerPage != 0) {
			$numOfPages++;
		}

		for ($i=$newsPerPage - 1; $i >= 0; $i--) { 
			echo '<h3>' . $news[$i]->name . '</h3><p>' . $news[$i]->content . '</p>';
		}
	}

	function showFiveNews($pageNumber) {
		//the $startIndex is taken - 1 in the call, for pagination reasons
		$reqData = ["name", "content"];
		$news = getData("news", $reqData);

		if (!count($news)) {
			echo "В момента няма информация.";
			return;
		}

		$startIndex = count($news) - 1;
		$newsPerPage = 5;

		$numOfPages = count($news) / $newsPerPage;
		if (count($news) % $newsPerPage != 0) {
			$numOfPages++;
		}
		
		if ($startIndex  > 1 && count($news) > 5) {
			$startIndex = $startIndex - ($pageNumber - 1) * 5;
		}

		

		$curIndex = $startIndex;

		$written = 0;

		while (($written < $newsPerPage) && $curIndex >= 0) {
			echo
				'<article class="newsArticle clear">
					<h3 class="news-title">' . $news[$curIndex]->name . '</h3>
					<p class="news-content">' . $news[$curIndex]->content . '</p>
				</article>';
			$written++;
			$curIndex--;
		}
	}

	function paginate() {
		$newsPerPage = 5;
		$reqData = ['*'];
		$news = getData('news', $reqData);
		$pagesCount;
		//echo '<li><a class="page-link selected-page" onclick="return false;" href="#">1</a></li>';

		if (count($news) % 5 == 0) {
			$pagesCount = count($news) / 5;
		}

		else {
			$pagesCount = count($news) / 5 + 1;
		}

		for ($i=1; $i <= $pagesCount; $i++) { 
			echo '<li><a class="page-link" onclick="return false;" href="#">' . $i . '</a></li>';
		}
	}
?>

