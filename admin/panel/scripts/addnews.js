function addArticle () {
		var section = document.getElementById("content");
		var firstArticle = document.querySelector(".newsArticle");
		var textarea = document.createElement('textarea');
		textarea.cols = "80";
		textarea.rows = "5";
		textarea.id = "niceditArea";
		var areaHolder = document.createElement('div');
		areaHolder.id = "areaHolder";
		areaHolder.appendChild(textarea);
		
		section.insertBefore(areaHolder, firstArticle);
		new nicEditor({
				fullPanel : true, onSave : function(content, id, instance) {
					alert('save button clicked for element '+id+' = '+content);
				} 
			}
	  	).panelInstance('niceditArea');
	}