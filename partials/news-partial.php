<!-- Don't fucking change -->
<link rel="stylesheet" type="text/css" href="assets/css/news.css">
<div id="row news-section">
	<div class="col-sm-12">
		<div id="news-container">
			<?php
				//require_once '/../controllers/news-controller.php';
				require_once dirname(__FILE__) . '/../controllers/news-controller.php';
			?>
		</div>
		<ul class="pagination" id="news-nav">
	  		<?php
				//require_once '/../controllers/news-controller.php';
	  			require_once dirname(__FILE__) . '/../controllers/news-controller.php';
				paginate();
			?>
		</ul>
	</div>
</div>