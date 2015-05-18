function AJAXRequest (filepath, params, func) {
	if (!filepath) {
		alert("BAD REQUEST: filepath missing!");
		return;
	};
	//IE7+, Firefox, Chrome, Opera, Safari
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	}
	else {
		//IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}

	xmlhttp.onreadystatechange = function () {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById("content").innerHTML = xmlhttp.responseText;
		};
	};

	
	var request = filepath + "?";
	

	if (params.length > 0) {
		for (var i = 0; i < params.length; i++) {
			var keys = Object.keys(params[i]);
			console.log(keys);
			for (var j = 0; j < keys.length; j++) {
				request += keys[j] + "=" + params[i][keys[j]];
				request += "&";
			};
		};
	}


	if(func !== undefined)
	{
		request += func !== undefined ? "func=" + func : "";
		request += "&";
	}

	//opens the request, with unique value, so it is not cached
	console.log(request + "t=" + Math.random());
	xmlhttp.open("POST", request + "t=" + Math.random(), true)
	xmlhttp.send();
}