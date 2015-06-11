function escapeHtml(str) {
    return String(str)
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;")
        .replace(/\//g, "&#x2F;")
}

function addArticle () {
	var section = document.getElementById("content");
	var firstArticle = document.querySelector(".newsArticle");
	var newsAreaExists = document.getElementById('areaHolder');

	if (!newsAreaExists) {

		var editor = document.createElement('textarea');
		editor.id = 'editor';

		var form = document.createElement('form');
		form.action="#";
		form.appendChild(editor);

		var areaHolder = document.createElement('div');
		areaHolder.id = "areaHolder";

		//var boldButton = document.createElement();
		
		areaHolder.appendChild(form);

		section.insertBefore(areaHolder, firstArticle);

		tinymce.init({
		    selector: "textarea",
		    theme: "modern",
		    plugins: [
		        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
		        "searchreplace wordcount visualblocks visualchars code fullscreen",
		        "insertdatetime media nonbreaking save table contextmenu directionality",
		        "emoticons template paste textcolor colorpicker textpattern save"
		    ],
		    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
		    toolbar2: "print preview media | forecolor backcolor emoticons save",
		    image_advtab: true,
		    templates: [
		        {title: 'Test template 1', content: 'Test 1'},
		        {title: 'Test template 2', content: 'Test 2'}
		    ],
		    save_enablewhendirty: true,
    		save_onsavecallback: function() {
    			var content = tinyMCE.activeEditor.getContent();
    			console.log(content);
    			AJAXRequest('scripts/dbquery.php', {func: 'saveNews', content:content, done: function () {
    				document.getElementById('content').innerHTML = xmlhttp.responseText;
    			}});
    		}
		});

	}
}

function removeNews(caller, id) {
	if (id) {
		if (caller.style.backgroundColor !== "red") {
			caller.style.backgroundColor = "red";
		} else {
			AJAXRequest('scripts/dbquery.php', {func: 'removeNews', id: id, done: function () {
				document.getElementById('content').innerHTML = xmlhttp.responseText;
			}});
		}
	} else {
		alert("Error: Trying to delete news, without given id!");
	}
}

function editNews(caller, id) {
	var section = document.getElementById("content");
	var firstArticle = document.querySelector(".newsArticle");
	var newsAreaExists = document.getElementById('areaHolder');

	if (!newsAreaExists) {

		var editor = document.createElement('textarea');
		editor.id = 'editor';

		var form = document.createElement('form');
		form.action="#";
		form.appendChild(editor);

		var areaHolder = document.createElement('div');
		areaHolder.id = "areaHolder";

		//var boldButton = document.createElement();
		
		areaHolder.appendChild(form);

		section.insertBefore(areaHolder, firstArticle);

		tinymce.init({
		    selector: "textarea",
		    theme: "modern",
		    plugins: [
		        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
		        "searchreplace wordcount visualblocks visualchars code fullscreen",
		        "insertdatetime media nonbreaking save table contextmenu directionality",
		        "emoticons template paste textcolor colorpicker textpattern save"
		    ],
		    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
		    toolbar2: "print preview media | forecolor backcolor emoticons save",
		    image_advtab: true,
		    templates: [
		        {title: 'Test template 1', content: 'Test 1'},
		        {title: 'Test template 2', content: 'Test 2'}
		    ],
		    save_enablewhendirty: true,
    		save_onsavecallback: function() {
    			var content = tinyMCE.activeEditor.getContent();
    			console.log(content);
    			AJAXRequest('scripts/dbquery.php', {func: 'updateNews', id: id, content:content, done: function () {
    				document.getElementById('content').innerHTML = xmlhttp.responseText;
    			}});
    		}
		});
		var jcaller = $(caller);
		tinyMCE.activeEditor.setContent(jcaller.prev().html());
	}
}