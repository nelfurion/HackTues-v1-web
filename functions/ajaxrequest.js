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

	if (params.containerId) {
		console.log("CONTAINER: ", "'" + params.containerId + "'");
		xmlhttp.onreadystatechange = function () {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				document.getElementById('news-container').innerHTML = xmlhttp.responseText;
			};
		};
	}
	else {
		xmlhttp.onreadystatechange = function () {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				document.getElementById('content').innerHTML = xmlhttp.responseText;
			};
		};
	}

	//For older browsers, which do not support Object.keys()
	// From https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Object/keys
	if (!Object.keys) {
	  Object.keys = (function() {
	    'use strict';
	    var hasOwnProperty = Object.prototype.hasOwnProperty,
	        hasDontEnumBug = !({ toString: null }).propertyIsEnumerable('toString'),
	        dontEnums = [
	          'toString',
	          'toLocaleString',
	          'valueOf',
	          'hasOwnProperty',
	          'isPrototypeOf',
	          'propertyIsEnumerable',
	          'constructor'
	        ],
	        dontEnumsLength = dontEnums.length;

	    return function(obj) {
	      if (typeof obj !== 'object' && (typeof obj !== 'function' || obj === null)) {
	        throw new TypeError('Object.keys called on non-object');
	      }

	      var result = [], prop, i;

	      for (prop in obj) {
	        if (hasOwnProperty.call(obj, prop)) {
	          result.push(prop);
	        }
	      }

	      if (hasDontEnumBug) {
	        for (i = 0; i < dontEnumsLength; i++) {
	          if (hasOwnProperty.call(obj, dontEnums[i])) {
	            result.push(dontEnums[i]);
	          }
	        }
	      }
	      return result;
	    };
	  }());
	}
	
	var request = filepath + "?";

	var paramKeys = Object.keys(params);

	for (var i = 0; i < paramKeys.length; i++) {
		request += paramKeys[i] + "=" + params[paramKeys[i]];
		request += "&";
	};
	
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