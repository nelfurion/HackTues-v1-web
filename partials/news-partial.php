<!-- Don't fucking change -->

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