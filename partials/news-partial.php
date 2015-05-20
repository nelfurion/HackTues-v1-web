<div class="col-sm-12">
	<h2>Новини</h2>
	<div id="news-container">
		<?php
			//require_once '/../controllers/news-controller.php';
			require_once 'controllers/news-controller.php';
		?>
	</div>
	<ul class="pagination" id="news-nav">
  		<?php
			//require_once '/../controllers/news-controller.php';
  			require_once 'controllers/news-controller.php';
			paginate();
		?>
	</ul>
</div>