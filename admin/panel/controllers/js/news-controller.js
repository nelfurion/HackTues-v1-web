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

		var ckform = document.createElement('form');

		var textarea = document.createElement('textarea');
		textarea.cols = "80";
		textarea.rows = "5";
		textarea.id = "article-content";
		textarea.name = "article-content";

		var areaHolder = document.createElement('div');
		areaHolder.id = "areaHolder";
		
		areaHolder.appendChild(ckform);
		ckform.appendChild(textarea);


		section.insertBefore(areaHolder, firstArticle);

		CKEDITOR.replace('article-content');
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
	if (caller.parentNode.id.indexOf(' edited') === -1 && caller.innerHTML !== "SAVE") {

		var textarea = document.createElement('textarea');
		textarea.id = 'edited';
		textarea.cols = '80';
		textarea.rows = '5';
		textarea.name = 'edited';

		var saveEditBtn = document.createElement('button');
		saveEditBtn.onclick = 'saveEdit();';
		saveEditBtn.className = 'save-edit-btn';

		
		caller.parentNode.insertBefore(textarea, caller.nextSibling.nextSibling.nextSibling);

		CKEDITOR.replace('edited');
		textarea.value = caller.previousSibling.previousSibling.innerHTML;

		caller.innerHTML = "SAVE";
	} else if (caller.innerHTML === "SAVE") {
		AJAXRequest('scripts/dbquery.php', {func: 'updateNews', id: id, content: CKEDITOR.instances.edited.getData(), done: function () {
			document.getElementById('content').innerHTML = xmlhttp.responseText;
		}});
	}
}