/*********************************************************************************************************
 This code is part of the FileManager software (www.gerd-tentler.de/tools/filemanager), copyright by
 Gerd Tentler. Obtain permission before selling this code or hosting it on a commercial website or
 redistributing it over the Internet or in any other medium. In all cases copyright must remain intact.
*********************************************************************************************************/

//---------------------------------------------------------------------------------------------------------
// Add new methods to Function prototype - needed to pass objects to event handlers etc.
//---------------------------------------------------------------------------------------------------------
if(typeof Function.prototype.bind == 'undefined') Function.prototype.bind = function() {
	var _this = this, args = [], object = arguments[0];
	for(var i = 1; i < arguments.length; i++) args.push(arguments[i]);
	return function() {
		return _this.apply(object, args);
	}
}

if(typeof Function.prototype.bindAsEventListener == 'undefined') Function.prototype.bindAsEventListener = function() {
	var _this = this, args = [], object = arguments[0];
	for(var i = 1; i < arguments.length; i++) args[i + 1] = arguments[i];
	return function(e) {
		args[0] = e || event;
		return _this.apply(object, args);
	}
}

//---------------------------------------------------------------------------------------------------------
// Global variables and functions
//---------------------------------------------------------------------------------------------------------
var OP = (window.opera || navigator.userAgent.indexOf('Opera') != -1);
var IE = (navigator.userAgent.indexOf('MSIE') != -1 && !OP);
var FF = (navigator.userAgent.indexOf('Firefox') != -1 && !OP);
var WK = (navigator.userAgent.indexOf('WebKit') != -1 && !OP);
var GK = (navigator.userAgent.indexOf('Gecko') != -1 || OP);
var DM = (document.designMode && document.execCommand && !OP && !WK); /* Opera and WebKit not supported at the moment */

//---------------------------------------------------------------------------------------------------------
// Little helpers
//---------------------------------------------------------------------------------------------------------
var fmTools = {

	getWindowWidth: function() {
		if(window.innerWidth)
			return window.innerWidth;
		if(document.documentElement && document.documentElement.clientWidth)
			return document.documentElement.clientWidth;
		if(document.body && document.body.clientWidth)
			return document.body.clientWidth;
		return screen.width;
	},

	getWindowHeight: function() {
		if(window.innerHeight)
			return window.innerHeight;
		if(document.documentElement && document.documentElement.clientHeight)
			return document.documentElement.clientHeight;
		if(document.body && document.body.clientHeight)
			return document.body.clientHeight;
		return screen.height;
	},

	getScrollLeft: function() {
		if(document.documentElement && document.documentElement.scrollLeft)
			return document.documentElement.scrollLeft;
		if(document.body && document.body.scrollLeft)
			return document.body.scrollLeft;
		if(window.pageXOffset)
			return window.pageXOffset;
		return 0;
	},

	getScrollTop: function() {
		if(document.documentElement && document.documentElement.scrollTop)
			return document.documentElement.scrollTop;
		if(document.body && document.body.scrollTop)
			return document.body.scrollTop;
		if(window.pageYOffset)
			return window.pageYOffset;
		return 0;
	},

	numberFormat: function(val, dec) {
		if(dec) {
			if(val == 0) {
				val = '0.';
				for(var i = 0; i < dec; i++) val += '0';
			}
			else {
				if(val < 0) {
					var neg = true;
					val *= -1;
				}
				else var neg = false;
				val = (Math.round(val * Math.pow(10, dec))).toString();
				if(val.length <= dec) for(var i = 0; i < dec - val.length + 1; i++) val = '0' + val;
				val = val.substr(0, val.length - dec) + '.' + val.substr(val.length - dec);
				if(val.substr(0, 1) == '.') val = '0' + val;
				if(neg) val = '-' + val;
			}
		}
		else val = Math.round(val);
		return val;
	},

	inArray: function(val, arr, ignoreCase) {
		var str = '|' + arr.join('|') + '|';
		if(ignoreCase) {
			str = str.toLowerCase();
			val = val.toLowerCase();
		}
		return (str.indexOf('|' + val + '|') != -1);
	},

	addListener: function(obj, type, fn) {
		if(obj.addEventListener) {
			obj.addEventListener(type, fn, false);
		}
		else if(obj.attachEvent) {
			obj.attachEvent('on' + type, fn);
		}
		else obj['on' + type] = fn;
	},

	setUnselectable: function(node) {
		node.unselectable = true;
		node.style.MozUserSelect = 'none';
		node.onmousedown = function() {return false;}
		node.style.cursor = 'default';
	},

	replaceHtml: function(node, html) {
		/*@cc_on // pure innerHTML is slightly faster in IE
			node.innerHTML = html;
			return node;
		@*/
		var newNode = node.cloneNode(false);
		newNode.innerHTML = html;
		node.parentNode.replaceChild(newNode, node);
		return newNode;
	},

	trim: function(val) {
		val = val.replace(/^\s+/, '');
		val = val.replace(/\s+$/, '');
		return val;
	},

	toBytes: function(val) {
		val.match(/(\d+(\.\d+)?)\s+([BKMG])/);
		switch(RegExp.$3) {
			case 'B':return parseInt(RegExp.$1);
			case 'K':return parseFloat(RegExp.$1) * 1024;
			case 'M':return parseFloat(RegExp.$1) * 1024 * 1024;
			case 'G':return parseFloat(RegExp.$1) * 1024 * 1024 * 1024;
		}
		return val;
	},

	b64decode: function(input) {
		var output = '';

		if(input) {
			var k = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
			var chr1, chr2, chr3;
			var enc1, enc2, enc3, enc4;
			var i = 0;
			input = input.replace(/[^A-Za-z0-9\+\/\=]/g, '');

			do {
				enc1 = k.indexOf(input.charAt(i++));
				enc2 = k.indexOf(input.charAt(i++));
				enc3 = k.indexOf(input.charAt(i++));
				enc4 = k.indexOf(input.charAt(i++));

				chr1 = (enc1 << 2) | (enc2 >> 4);
				chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
				chr3 = ((enc3 & 3) << 6) | enc4;

				output = output + String.fromCharCode(chr1);

				if(enc3 != 64) {
					output = output + String.fromCharCode(chr2);
				}
				if(enc4 != 64) {
					output = output + String.fromCharCode(chr3);
				}
			}
			while(i < input.length);
		}
		return output;
	},

	getSelectedItems: function(curCont, checkDir) {
		var ids = [];
		var contObj;

		if(contObj = document.getElementById(curCont)) {
			var nodes = contObj.getElementsByTagName('input');

			for(var i in nodes) {
				if(nodes[i].type == 'checkbox' && nodes[i].checked) {
					if(nodes[i].value != '') {
						ids.push(nodes[i].value);

						if(checkDir) {
							if(fmEntries[curCont][nodes[i].value].icon.substr(0, 3) == 'dir') {
								fmContSettings[curCont].expJson = null;
							}
						}
					}
				}
			}
		}
		return ids;
	},

	arraySum: function(arr) {
		var sum = 0;
		for(var i in arr) sum += arr[i];
		return sum;
	},

	isTouchDevice: function() {
		try {
			document.createEvent('TouchEvent');
			return true;
		}
		catch(e) {
			return false;
		}
	},

	touchScroll: function(obj) {
		if(this.isTouchDevice()) try {
			if(typeof obj != 'object') obj = document.getElementById(obj);
			var scrollStartPos = 0;

			this.addListener(obj, 'touchstart', function(event) {
				scrollStartPos = this.scrollTop + event.touches[0].pageY;
			});

			this.addListener(obj, 'touchmove', function(event) {
				this.scrollTop = scrollStartPos - event.touches[0].pageY;
				event.preventDefault();
			});
		}
		catch(e) {}
	}
}
