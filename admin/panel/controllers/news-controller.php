<?php
	require dirname(__FILE__) . '/../scripts/dbquery.php';
	if (isset($_GET['func'])) {
		switch ($_GET['func']) {
			case 'showNews':
				showNews();
				break;
			
			
			default:
				# code...
				break;
		}
	}
	else
	{
		echo "NE E SETNATA";
	}
	

	function showNews()
	{
		$reqData = ["*"];
		$news = getData("news", $reqData);

		if (!count($news)) {
			echo "В момента няма информация.";
			return;
		}

		for ($i=0; $i < count($news); $i++) { 
			echo
				'<article class="newsArticle clear">
					' . $news[$i]->content . '
					<p class="article-id">ID= ' . $i . '</p>
				</article>
				<button class="edit-news-btn" onclick="editNews(this, ' . $news[$i]->id . ');"> Edit </button>
				<button class="remove-news-btn" onclick="removeNews(this, '.$news[$i]->id.');"> Remove </button>';
		}
	}
?>