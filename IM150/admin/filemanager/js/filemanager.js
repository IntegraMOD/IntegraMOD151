/*********************************************************************************************************
 This code is part of the FileManager software (www.gerd-tentler.de/tools/filemanager), copyright by
 Gerd Tentler. Obtain permission before selling this code or hosting it on a commercial website or
 redistributing it over the Internet or in any other medium. In all cases copyright must remain intact.
*********************************************************************************************************/

var fmLib =  {

	fadeSpeed: 15,   // fade speed (0 - 30; 0 = no fading)
	mouseX: 0,
	mouseY: 0,
	fadeTimer: 0,
	iv: 0,
	opacity: 0,
	dragging: false,
	noMenu: false,
	useRightClickMenu: {},
	browserContextMenu: true,
	dialog: null,
	progBar: null,
	callback: null,
	soundObj: null,

	callOK: function(msg, url, frmName) {
		var ok = confirm(msg);
		if(ok) {
			if(url) this.call(url, frmName);
			else if(frmName) document.forms[frmName].submit();
		}
	},

	call: function(url, frmName) {
		url.match(/fmContainer=(\w+)/);
		var curCont = RegExp.$1;
		var ajaxObj = new ajax();

		if(this.dialog && this.opacity) this.fadeOut(this.opacity, this.dialog);

		if(url.match('fmMode=readTextFile')) {
			ajaxObj.makeRequest(url, function() {
				var contObj = document.getElementById('fmTextViewerCont');

				if(contObj) {
					fmParser.parseTextViewer(ajaxObj.response, contObj);
					fmLib.initTextViewer();
				}
			});
			return;
		}
		var listCont = document.getElementById(curCont + 'List');

		if(listCont) {
			var listLoad, callback;
			var fmCont = document.getElementById(curCont);

			if(fmCont) listLoad = this.viewLoader(fmCont, url);

			if(frmName == 'frmEdit' || url.match('fmMode=edit')) {
				callback = this.initEditor;
			}
			else if(url.match(/fmMode=(move|copy)/)) {
				if(url.match(/fmObject=(\d+)/)) {
					if(fmEntries[curCont][RegExp.$1].icon.substr(0, 3) == 'dir') {
						fmContSettings[curCont].expJson = null;
					}
				}
			}
			else if(url.match(/fmMode=refresh/)) {
				fmContSettings[curCont].expJson = null;
			}
			else {
				callback = this.callback;
				this.callback = null;
			}
			ajaxObj.makeRequest(url, function() {
				fmLib.viewResponse(ajaxObj.response, curCont, listLoad);
				if(typeof callback == 'function') callback();
			}, frmName);
		}
	},

	checkFile: function(listLoad, sid) {
		var iFrame = frames.fmFileAction;

		if(iFrame) {
			var url = iFrame.document.location.href;
			var response = iFrame.document.body.innerHTML;
			url.match(/fmContainer=(\w+)/);
			var curCont = RegExp.$1;

			if(response.match(/end:1\}$/)) {
				if(this.iv) clearInterval(this.iv);
				iFrame.document.body.innerHTML = '';
				this.viewResponse(response, curCont, listLoad);

				if(this.progBar) {
					this.fadeOut(this.opacity, this.progBar);
					this.progBar = null;
					setTimeout(function() {
						if(fmLib.progBar) {
							fmLib.fadeOut(fmLib.opacity, fmLib.progBar);
							fmLib.progBar = null;
						}
					}, 1000);
				}
			}
			else if(sid) {
				var ajaxObj = new ajax();
				ajaxObj.noWarning = true;
				url = fmWebPath + '/cgi/ping.pl?sid=' + sid + '&tmp=' + fmContSettings[curCont].tmp;

				ajaxObj.makeRequest(url, function() {
					if(ajaxObj.response) {
						var json = eval('(' + ajaxObj.response + ')');
						var pbContent = fmLib.drawProgBar(json);

						if(!fmLib.progBar) {
							fmLib.viewProgress(pbContent);
						}
						else document.getElementById('fmProgressText').innerHTML = pbContent;
					}
				});
			}
		}
	},

	getFile: function(curCont, id) {
		var iFrame = frames.fmFileAction;
		if(iFrame) {
			var url = fmWebPath + '/action.php?fmContainer=' + curCont + '&fmMode=getFile&fmObject=' + id;
			iFrame.document.location.href = url;
			this.fadeOut(this.opacity, this.dialog);
		}
	},

	drawProgBar: function(json) {
		if(typeof json != 'object') return false;
		var div, unit;

		if(json.bytesTotal > 1024 * 1024) {
			div = 1024 * 1024;
			unit = 'M';
		}
		else {
			div = 1024;
			unit = 'K';
		}
		var percent = (json.bytesTotal > 0) ? Math.round(json.bytesCurrent * 100 / json.bytesTotal) : 0;
		var current = fmTools.numberFormat(json.bytesCurrent / div, 2);
		var total = fmTools.numberFormat(json.bytesTotal / div, 2);
		var s = json.timeCurrent - json.timeStart;
		var bps = fmTools.numberFormat(json.bytesCurrent / 1024 / (s ? s : 1), 2);
		if(bps > 1024) bps = fmTools.numberFormat(bps / 1024, 2) + ' M/sec';
		else bps += ' K/sec';
		var h = Math.floor(s / 3600);
		s -= h * 3600;
		var m = Math.floor(s / 60);
		s -= m * 60;
		if(h < 10) h = '0' + h;
		if(m < 10) m = '0' + m;
		if(s < 10) s = '0' + s;

		html = '<table border="0" cellspacing="0" cellpadding="4" width="100%"><tr>';
		html += '<td colspan="2" align="center">';
		html += '<div class="fmProgressBarText" style="width:200px; margin-bottom:8px; overflow:hidden">' + json.filename + '</div>';
		html += '<div class="fmProgressBarBG" style="width:202px">';
		if(percent) html += '<div class="fmProgressBar" style="width:' + (percent * 2) + 'px">&nbsp;</div>';
		else html += '&nbsp;';
		html += '</div>';
		html += '</td>';
		html += '</tr><tr>';
		html += '<td class="fmProgressBarText" align="left">' + current + ' ' + unit + ' / ' + total + ' ' + unit + ' (' + percent + '%)</td>';
		html += '<td class="fmProgressBarText" align="right">' + bps + '</td>';
		html += '</tr><tr>';
		html += '<td class="fmProgressBarText" align="center" colspan="2">' + h + ':' + m + ':' + s + '</td>';
		html += '</tr></table>';
		return html;
	},

	viewLoader: function(fmCont, url) {
		var listLoad = document.createElement('div');
		this.setOpacity(20, listLoad);
		listLoad.style.position = 'absolute';
		listLoad.style.left = 0;
		listLoad.style.top = 0;
		listLoad.style.padding = 0;
		listLoad.style.backgroundColor = '#000000';
		listLoad.style.width = fmCont.offsetWidth + 'px';
		listLoad.style.height = fmCont.offsetHeight + 'px';
		listLoad.style.display = 'block';
		listLoad.style.zIndex = 68;
		fmCont.appendChild(listLoad);

		var img = document.createElement('img');
		var webPath = url.substring(0, url.lastIndexOf('/'));

		img.src = webPath + '/icn/ajax_loader.gif';
		img.width = 100;
		img.height = 100;
		img.style.position = 'absolute';
		img.style.left = '50%';
		img.style.top = '50%';
		img.style.marginLeft = '-50px';
		img.style.marginTop = '-50px';
		listLoad.appendChild(img);
		return listLoad;
	},

	viewResponse: function(json, curCont, listLoad) {
		var fmCont = document.getElementById(curCont);
		var listCont = document.getElementById(curCont + 'List');
		var logCont = document.getElementById(curCont + 'Log');
		var infoCont = document.getElementById(curCont + 'Info');

		if(typeof json != 'object') {
			if(json.match(/\{.+\}$/)) json = eval('(' + json + ')');
		}

		if(soundManager) {
			if(this.soundObj) {
				if(this.soundObj.bObj) {
					document.getElementById(this.soundObj.bObj.id).src = fmWebPath + '/icn/mediaPlay.gif';
				}
				this.soundObj = null;
			}
			soundManager.stopAll();
		}

		if(typeof json == 'object') {
			this.sortJson(json);
			fmContSettings[curCont].listJson = json;
			if(listCont) fmParser.parseMain(json, listCont);
			if(logCont) fmParser.parseLogMessages(json, logCont);
			if(infoCont) fmParser.parseDebugInfo(json, infoCont);
			if(json.explorer) this.getExplorer(json.cont);
			if(json.error) this.viewError(json.error, json.lang);
		}
		if(listLoad && fmCont) fmCont.removeChild(listLoad);
		if(this.opacity && this.dialog) this.fadeOut(this.opacity, this.dialog);
	},

	initEditor: function() {
		var elems = document.getElementsByTagName('textarea');
		var options = ceos = [];

		for(var i = 0; i < elems.length; i++) {
			if(elems[i].className.match(/^codeedit(\s+(.+))?/i)) {
				options = RegExp.$2.split(/\s+/);
				ceos.push(new CodeEdit(elems[i], options, 'codeEdit_' + i));
			}
		}
		for(i in ceos) ceos[i].create();
	},

	initTextViewer: function() {
		var elems = document.getElementsByTagName('pre');
		var options = cvos = [];

		for(var i = 0; i < elems.length; i++) {
			if(elems[i].className.match(/^codeview(\s+(.+))?/i)) {
				options = RegExp.$2.split(/\s+/);
				cvos.push(new CodeView(elems[i], options, 'codeView_' + (i + 1)));
			}
		}
		for(i in cvos) cvos[i].create();
	},

	initFileManager: function(url, mode) {
		var ajaxObj = new ajax();
		url.match(/fmContainer=(\w+)/);
		var curCont = RegExp.$1;

		ajaxObj.makeRequest(url + '&fmMode=getContSettings', function() {
			fmContSettings[curCont] = eval('(' + ajaxObj.response + ')');
			fmLib.useRightClickMenu[curCont] = (fmContSettings[curCont].useRightClickMenu && !fmTools.isTouchDevice() && !OP);

			if(fmLib.useRightClickMenu[curCont]) {
				document.oncontextmenu = function(e) {
					if(!e) e = window.event;
					e.cancelBubble = true;
					if(e.stopPropagation) e.stopPropagation();
					return fmLib.browserContextMenu;
				}
			}

			ajaxObj.makeRequest(url + '&fmMode=getUserPerms', function() {
				fmContSettings[curCont].userPerms = eval('(' + ajaxObj.response + ')');

				if(!fmMsg[fmContSettings[curCont].language]) {
					fmMsg[fmContSettings[curCont].language] = {};

					ajaxObj.makeRequest(url + '&fmMode=getMessages', function() {
						fmMsg[fmContSettings[curCont].language] = eval('(' + ajaxObj.response + ')');
						if(mode) fmLib.call(url + '&fmMode=' + mode);
					});
				}
				else if(mode) fmLib.call(url + '&fmMode=' + mode);
			});
		});
		fmTools.touchScroll('fmExplorerText2');
	},

	setContMenu: function(toggle) {
		setTimeout('fmLib.browserContextMenu=' + toggle, 100);
	},

	getExplorer: function(curCont, caption, link) {
		if(fmContSettings[curCont].expJson) {
			var html = fmParser.parseExplorer(fmContSettings[curCont].expJson, link);

			if(caption) {
				this.openDialog(null, 'fmExplorer', [caption, html]);
			}
			else {
				var obj = document.getElementById(curCont + 'Exp');
				if(obj) obj.innerHTML = html;
			}
		}
		else {
			var url = fmWebPath + '/action.php?fmContainer=' + curCont + '&fmMode=getExplorer';
			var ajaxObj = new ajax();

			ajaxObj.makeRequest(url, function() {
				var json = eval('(' + ajaxObj.response + ')');
				var html = fmParser.parseExplorer(json, link);

				if(caption) {
					fmLib.openDialog(null, 'fmExplorer', [caption, html]);
				}
				else {
					var obj = document.getElementById(curCont + 'Exp');
					if(obj) obj.innerHTML = html;
				}
			});
		}
	},

	toggleTreeItem: function(img) {
		var div, arr;

		if(img) {
			if(div = img.parentNode.nextSibling) {
				arr = div.id.split('|');

				if(div.style.display == 'none') {
					div.style.display = 'block';
					fmContSettings[arr[0]].expanded[arr[1]] = true;
					img.src = fmWebPath + '/icn/treeClose.gif';
					if(img.nextSibling) img.nextSibling.src = fmWebPath + '/icn/dir_open.gif';
				}
				else {
					div.style.display = 'none';
					fmContSettings[arr[0]].expanded[arr[1]] = false;
					img.src = fmWebPath + '/icn/treeOpen.gif';
					if(img.nextSibling) img.nextSibling.src = fmWebPath + '/icn/dir.gif';
				}
			}
		}
	},

	playSound: function(btnObj, curCont, id) {
		if(!fmSoundManagerReady) return false;
		var name = curCont + '_snd_' + id;
		var sndObj = soundManager.getSoundById(name);

		if(!sndObj) {
			sndObj = soundManager.createSound({
				id: name,
				url: fmWebPath + '/action.php?fmContainer=' + curCont + '&fmMode=loadFile&fmObject=' + id,
				volume: 50,
				autoPlay: true,
				onfinish: function() {
					var btnObj = document.getElementById(curCont + '_btn_' + id);
					if(btnObj) btnObj.src = fmWebPath + '/icn/mediaPlay.gif';
				}
			});
			if(sndObj) sndObj.onposition(100, function() {
				var btnObj = document.getElementById(curCont + '_btn_' + id);
				if(btnObj) btnObj.src = fmWebPath + '/icn/mediaPause.gif';
			});
			if(btnObj) btnObj.src = fmWebPath + '/icn/mediaLoading.gif';
		}
		else if(this.soundObj && this.soundObj.name == name) {
			sndObj.togglePause();
			var icon = sndObj.paused ? 'mediaPlay.gif' : 'mediaPause.gif';
			if(btnObj) btnObj.src = fmWebPath + '/icn/' + icon;
		}
		else {
			sndObj.play({position: 0});
			if(btnObj) btnObj.src = fmWebPath + '/icn/mediaPause.gif';
		}

		if(!this.soundObj || this.soundObj.name != name) {
			if(this.soundObj) {
				if(this.soundObj.sObj) this.soundObj.sObj.stop();
				if(this.soundObj.bObj) document.getElementById(this.soundObj.bObj.id).src = fmWebPath + '/icn/mediaPlay.gif';
			}
			this.soundObj = {name: name, sObj: sndObj, bObj: btnObj};
		}
	},

	toggleListView: function(curCont) {
		var json = fmContSettings[curCont].listJson;
		if(!json) return false;

		var type = (fmContSettings[curCont].listType == 'details') ? 'icons' : 'details';
		fmContSettings[curCont].listType = type;

		fmParser.parseMain(json, document.getElementById(curCont + 'List'));
		if(json.explorer) this.getExplorer(curCont);
	},

	sortList: function(curCont, field, order) {
		var json = fmContSettings[curCont].listJson;
		if(!json) return false;

		this.sortJson(json, field, order);
		fmContSettings[curCont].sort.field = field;
		fmContSettings[curCont].sort.order = order;

		fmParser.parseMain(json, document.getElementById(curCont + 'List'));
		if(json.explorer) this.getExplorer(curCont);
	},

	sortJson: function(json, field, order) {
		if(!json.entries || !json.cont) return false;
		var items = json.entries.items;
		var i, j, cnt, swap, prefix, str1, str2, temp;

		if(!field) field = fmContSettings[json.cont].sort.field;
		if(!order) order = fmContSettings[json.cont].sort.order;

		cnt = items.length;
		swap = true;

		while(cnt && swap) {
			swap = false;

			for(i = 0; i < cnt; i++) {
				if(items[i].name != '..' && items[i].name != '') {
					for(j = i; j < cnt - 1; j++) {
						if(field == 'isDir') {
							prefix = items[j].icon.match(/^dir/i) ? 'a' : 'z';
							str1 = prefix + items[j].name.toLowerCase();
							prefix = items[j + 1].icon.match(/^dir/i) ? 'a' : 'z';
							str2 = prefix + items[j + 1].name.toLowerCase();
						}
						else if(field == 'size') {
							str1 = fmTools.toBytes(items[j].size);
							str2 = fmTools.toBytes(items[j + 1].size);
						}
						else {
							str1 = items[j][field].toLowerCase();
							str2 = items[j + 1][field].toLowerCase();
						}

						if((order == 'asc' && str1 > str2) || (order == 'desc' && str1 < str2)) {
							temp = items[j];
							items[j] = items[j + 1];
							items[j + 1] = temp;
							swap = true;
						}
					}
				}
			}
			cnt--;
		}
	},

	setOpacity: function(opacity, obj) {
		if(obj) {
			obj.style.opacity = opacity / 100;
			obj.style.MozOpacity = opacity / 100;
			obj.style.KhtmlOpacity = opacity / 100;
			obj.style.filter = 'alpha(opacity=' + opacity + ')';
		}
		this.opacity = opacity;
	},

	fadeIn: function(opacity, obj) {
		if(obj) {
			if(this.fadeSpeed && opacity < 100) {
				opacity += this.fadeSpeed;
				if(opacity > 100) opacity = 100;
				this.setOpacity(opacity, obj);
				obj.style.visibility = 'visible';
				obj.style.display = 'block';
				setTimeout(this.fadeIn.bind(this, opacity, obj), 1);
			}
			else {
				this.setOpacity(100, obj);
				obj.style.visibility = 'visible';
				obj.style.display = 'block';
				this.dialog = obj;
			}
		}
	},

	fadeOut: function(opacity, obj) {
		if(obj) {
			if(this.fadeSpeed && opacity > 0) {
				opacity -= this.fadeSpeed;
				if(opacity < 0) opacity = 0;
				this.setOpacity(opacity, obj);
				setTimeout(this.fadeOut.bind(this, opacity, obj), 1);
			}
			else {
				this.setOpacity(0, obj);
				obj.style.visibility = 'hidden';
				obj.style.display = 'none';
				this.dialog = null;

				if(obj.id == 'fmMediaPlayer') {
					var flashCont = document.getElementById('fmFlashCont');
					if(flashCont) flashCont.innerHTML = '';
				}
			}
		}
	},

	setDialogLeft: function(x, obj) {
		if(!obj) obj = this.dialog;
		var width = obj.offsetWidth;
		var left = x ? x : this.mouseX - width + 13;

		if(left < 0) left = 0;
		if(x) left += fmTools.getScrollLeft();
		obj.style.left = left + 'px';
	},

	setDialogTop: function(y, obj) {
		if(!obj) obj = this.dialog;
		var hght = obj.offsetHeight;
		var top = y ? y : this.mouseY - 10;

		var winY = fmTools.getWindowHeight();
		var scrTop = fmTools.getScrollTop();

		if(y) top += scrTop;
		else if(top + hght - scrTop > winY) {
			if(hght > top) top = 0;
			else top = winY + scrTop - hght;
		}
		obj.style.top = top + 'px';
	},

	openDialog: function(url, dialogId, text, fileId, name, perms, x, y) {
		var f, e, i, obj, sid, tmp, curCont, iframeCont, ids, dialog, perc, dir, width, height, params;

		if(url) {
			url.match(/fmContainer=(\w+)/);
			curCont = RegExp.$1;
		}

		if(this.noMenu) {
			this.noMenu = false;
			return;
		}

		switch(dialogId) {

			case 'fmMediaPlayer':
				obj = document.getElementById('fmFlashCont');
				if(obj) {
					obj.style.width = fmContSettings[curCont].mediaPlayerWidth + 'px';
					obj.style.height = fmContSettings[curCont].mediaPlayerHeight + 'px';
				}
				obj = document.getElementById('fmMediaPlayerText');
				if(obj) obj.style.width = (fmContSettings[curCont].mediaPlayerWidth - 32) + 'px';
				break;

			case 'fmDocViewer':
				if(typeof fileId != 'object') {
					obj = document.getElementById('fmDocViewerCont');
					if(obj) {
						if(fmEntries[curCont][fileId].dir) dir = fmEntries[curCont][fileId].dir;
						else dir = fmContSettings[curCont].listJson.path;
						url = fmContSettings[curCont].publicUrl + dir + '/' + fmEntries[curCont][fileId].name;
						var src = 'http://docs.google.com/viewer?embedded=true&url=' + escape(url);
						width = fmContSettings[curCont].docViewerWidth;
						height = fmContSettings[curCont].docViewerHeight;
						obj.innerHTML = '<iframe src="' + src + '" border="0" frameborder="0" style="width:' + width + 'px; height:' + height + 'px"></iframe>';
					}
					obj = document.getElementById('fmDocViewerText');
					if(obj) obj.style.width = (fmContSettings[curCont].docViewerWidth - 32) + 'px';
				}
				break;

			case 'fmTextViewer':
				if(typeof fileId != 'object') {
					obj = document.getElementById('fmDocViewerCont');
					if(obj) {
						width = fmContSettings[curCont].docViewerWidth;
						height = fmContSettings[curCont].docViewerHeight;
						obj.innerHTML = '<div id="fmTextViewerCont" style="width:' + width + 'px; height:' + height + 'px"></div>';
					}
					obj = document.getElementById('fmDocViewerText');
					if(obj) obj.style.width = (fmContSettings[curCont].docViewerWidth - 32) + 'px';
					dialogId = 'fmDocViewer';
					this.call(url + '&fmMode=readTextFile&fmObject=' + fileId, dialogId);
				}
				break;

			case 'fmImgViewer':
			case 'fmCoverViewer':
				if(typeof fileId != 'object') {
					obj = document.getElementById('fmDocViewerCont');
					if(obj) {
						if(dialogId == 'fmCoverViewer') {
							var parts = name.split(':');
							width = parseInt(parts[1]);
							height = parseInt(parts[2]);
							name = parts[0];
						}
						else {
							width = parseInt(fmEntries[curCont][fileId].width);
							height = parseInt(fmEntries[curCont][fileId].height);
						}

						if(width > fmContSettings[curCont].thumbMaxWidth) {
							perc = fmContSettings[curCont].thumbMaxWidth / width;
							width = fmContSettings[curCont].thumbMaxWidth;
							height = Math.round(height * perc);
						}

						if(height > fmContSettings[curCont].thumbMaxHeight) {
							perc = fmContSettings[curCont].thumbMaxHeight / height;
							height = fmContSettings[curCont].thumbMaxHeight;
							width = Math.round(width * perc);
						}

						if(dialogId == 'fmCoverViewer') {
							url = fmWebPath + '/action.php?fmContainer=' + curCont + '&fmMode=getCachedImage&fmObject=' + name + '&width=' + width + '&height=' + height;
						}
						else url = fmWebPath + '/action.php?fmContainer=' + curCont + '&fmMode=getThumbnail&fmObject=' + fileId + '&' + fmEntries[curCont][fileId].thumbnail;

						obj.innerHTML = '<div class="fmThumbnail"' +
										' style="width:' + (width < 100 ? 100 : width) + 'px; height:' + (height < 50 ? 50 : height) + 'px; background-color:#FFFFFF; cursor:pointer"' +
										' onClick="fmLib.fadeOut(100, fmLib.dialog)">' +
										'<div style="height:' + (height < 50 ? 50 : height) + 'px; background:url(' + url + ') center no-repeat"></div></div>';

						obj = document.getElementById('fmDocViewerText');
						if(obj) obj.style.width = (width > 100 ? width - 20 : 80) + 'px';
					}
					dialogId = 'fmDocViewer';
				}
				break;

			default:
				if(f = document.forms[dialogId]) {
					f.reset();

					if(typeof fileId == 'object') fileId = fileId.join(',');
					if(fileId && f.fmObject) f.fmObject.value = fileId;
					if(name && f.fmName) f.fmName.value = name;

					switch(dialogId) {

						case 'fmNewFile':
							for(i = 1; i < 10; i++) {
								if(f['fmFile[' + i + ']']) {
									f['fmFile[' + i + ']'].style.display = 'none';
								}
							}

							if(fmContSettings[curCont] && fmContSettings[curCont].perlEnabled) {
								sid = fmContSettings[curCont].sid;
								tmp = fmContSettings[curCont].tmp;
								f.action = fmWebPath + '/cgi/upload.pl?cont=' + curCont + '&sid=' + sid + '&tmp=' + tmp;
							}
							else {
								f.action = url;
								sid = '';
							}

							f.target = 'fmFileAction';
							f.onsubmit = function() {
								if(fmLib.dialog && fmLib.opacity) fmLib.fadeOut(fmLib.opacity, fmLib.dialog);
								var fmCont = document.getElementById(curCont);
								var listLoad = fmLib.viewLoader(fmCont, url);
								fmLib.iv = setInterval(fmLib.checkFile.bind(fmLib, listLoad, sid), 250);
							}
							break;

						case 'fmJavaUpload':
							if(frames.JUpload.document.location.href.match(/(fmCont\d+)/)) {
								iframeCont = RegExp.$1;
							}
							else iframeCont = '';

							if(iframeCont != curCont) {
								frames.JUpload.document.location.href = fmWebPath + '/action.php?fmContainer=' + curCont + '&fmMode=jupload';
							}
							f.action = "javascript:fmLib.call('" + url + "', '" + dialogId + "')";
							break;

						case 'fmRename':
						case 'fmDelete':
							ids = f.fmObject.value.split(',');
							for(i in ids) {
								if(fmEntries[curCont][ids[i]].icon.substr(0, 3) == 'dir') {
									fmContSettings[curCont].expJson = null;
									break;
								}
							}
							f.action = "javascript:fmLib.call('" + url + "', '" + dialogId + "')";
							break;

						case 'fmNewDir':
							fmContSettings[curCont].expJson = null;
							f.action = "javascript:fmLib.call('" + url + "', '" + dialogId + "')";
							break;

						default:
							f.action = "javascript:fmLib.call('" + url + "', '" + dialogId + "')";
					}

					if(perms) {
						e = f.elements;
						for(i = 0; i < 9; i += 3) {
							e['fmPerms[' + i + ']'].checked = (perms[i + 1] == 'r');
							e['fmPerms[' + (i + 1) + ']'].checked = (perms[i + 2] == 'w');
							e['fmPerms[' + (i + 2) + ']'].checked = (perms[i + 3] == 'x');
						}
					}
				}
		}

		if(text) {
			if(typeof(text) != 'object') text = [text];
			for(i = 0; i < text.length; i++) {
				obj = document.getElementById(dialogId + 'Text' + (i ? i + 1 : ''));
				if(obj) obj.innerHTML = text[i];
			}
		}
		dialog = document.getElementById(dialogId);

		if(this.dialog && this.opacity && this.dialog != dialog) {
			this.fadeOut(this.opacity, this.dialog);
		}
		this.fadeIn(0, dialog);
		this.setDialogLeft(x, dialog);
		this.setDialogTop(y, dialog);

		/* this must be executed when dialog is visible */
		if(dialogId == 'fmMediaPlayer' && typeof FlashReplace == 'object') {
			if(text[0].match(/\.swf$/i)) {
				params = {bgcolor: '#000000', allowFullScreen: 'true'};
				FlashReplace.replace('fmFlashCont', url, 'fmFlashMovie', '100%', '100%', 7, params);
			}
			else {
				params = {FlashVars: 'flvToPlay=' + escape(url) + '&defaultVolume=75&showScaleModes=false', bgcolor: '#000000', allowFullScreen: 'true'};
				FlashReplace.replace('fmFlashCont', fmWebPath + '/flvplayer/flvPlayer.swf', 'fmFlashMovie', '100%', '100%', 9, params);
			}
		}
		else if(f && f.fmName) f.fmName.focus();
		return dialog;
	},

	viewError: function(msg, lang) {
		var x = Math.round((fmTools.getWindowWidth() - 400) / 2);
		var y = Math.round((fmTools.getWindowHeight() - 50) / 2);
		this.openDialog(null, 'fmError', [fmMsg[lang].error, msg], null, null, null, x, y);
	},

	viewProgress: function(msg) {
		var x = Math.round((fmTools.getWindowWidth() - 240) / 2);
		var y = Math.round((fmTools.getWindowHeight() - 200) / 2);
		this.progBar = this.openDialog(null, 'fmProgress', msg, null, null, null, x, y);
	},

	fileInfo: function(id, curCont) {
		var icon = css = style = name = tags = id3Picture = action = '';
		var thumbWidth = thumbHeight = 0;
		var id3, key;
		var lang = fmContSettings[curCont].language;
		var size = fmEntries[curCont][id].size;
		if(fmEntries[curCont][id].width) size += ' (' + fmEntries[curCont][id].width + ' &times; ' + fmEntries[curCont][id].height + ')';

		var html = '<table border="0" cellspacing="1" cellpadding="1" width="100%"><tr align="left" valign="top">' +
			'<td class="fmContent"><b>' + fmMsg[lang].name + ':</b></td><td class="fmContent">' + fmEntries[curCont][id].fullName + '</td>' +
			'</tr><tr align="left">' +
			'<td class="fmContent"><b>' + fmMsg[lang].permissions + ':</b></td><td class="fmContent">' + fmEntries[curCont][id].permissions + '</td>' +
			'</tr><tr align="left">' +
			'<td class="fmContent"><b>' + fmMsg[lang].owner + ':</b></td><td class="fmContent">' + fmEntries[curCont][id].owner + '</td>' +
			'</tr><tr align="left">' +
			'<td class="fmContent"><b>' + fmMsg[lang].group + ':</b></td><td class="fmContent">' + fmEntries[curCont][id].group + '</td>' +
			'</tr><tr align="left">' +
			'<td class="fmContent"><b>' + fmMsg[lang].lastChange + ':</b></td><td class="fmContent" nowrap="nowrap">' + fmEntries[curCont][id].changed + '</td>' +
			'</tr><tr align="left">' +
			'<td class="fmContent"><b>' + fmMsg[lang].size + ':</b></td><td class="fmContent" nowrap="nowrap">' + size + '</td>';

		if(typeof fmEntries[curCont][id].id3 == 'object') {
			id3 = fmEntries[curCont][id].id3;

			for(key in id3) {
				if(key == 'Picture') {
					id3Picture = id3[key];
				}
				else if(id3[key] != '') {
					tags += '</tr><tr align="left">';
					tags +=	'<td class="fmContent"><b>' + key + ':</b></td><td class="fmContent" nowrap="nowrap">' + id3[key] + '</td>';
				}
			}

			if(tags) {
				html += '</tr><tr align="left">';
				html += '<td class="fmContent" colspan="2"><div style="height:0px; margin:4px 0px; border:1px inset #FFFFFF"></div></td>';
				html += tags;
			}
		}

		if(fmEntries[curCont][id].thumbnail || id3Picture) {
			if(id3Picture) {
				icon = fmWebPath + '/action.php?fmContainer=' + curCont + '&fmMode=getCachedImage&fmObject=' + id3Picture.split(':')[0] + '&width=100&height=100';
				css = 'fmThumbnail';
				style = 'width:102px; height:102px; background-color:#FFFFFF; cursor:pointer';
				action = fmParser.parseAction({caption:fmMsg[lang].cmdView,dialog:'fmCoverViewer',content:id3Picture}, curCont, id);
			}
			else {
				thumbWidth = fmEntries[curCont][id].width;
				thumbHeight = fmEntries[curCont][id].height;

				if(thumbWidth > 100) {
					thumbHeight = Math.round(thumbHeight * 100 / thumbWidth);
					thumbWidth = 100;
				}

				if(thumbHeight > 100) {
					thumbWidth = Math.round(thumbWidth * 100 / thumbHeight);
					thumbHeight = 100;
				}
				icon = fmWebPath + '/action.php?fmContainer=' + curCont + '&fmMode=getThumbnail&fmObject=' + id + '&width=' + thumbWidth + '&height=' + thumbHeight + '&' + fmEntries[curCont][id].thumbnail;
				css = 'fmThumbnail';
				style = 'width:' + thumbWidth + 'px; height:' + thumbHeight + 'px; background-color:#FFFFFF; cursor:pointer';
				action = fmParser.parseAction({caption:fmMsg[lang].cmdView,dialog:'fmImgViewer'}, curCont, id);
			}
		}
		else {
			icon = fmWebPath + '/icn/big/' + fmEntries[curCont][id].icon;
			width = height = 32;
		}
		html += '</tr><tr align="left"><td colspan="2" height="8"></td></tr><tr>' +
				'<td colspan="2" align="center">' +
				'<div class="' + css + '" style="' + style + '" onClick="' + action + '">' +
				'<img src="' + icon + '"/></div></td>';
		html += '</tr></table>';

		this.openDialog(null, 'fmInfo', [fmMsg[lang].fileInfo, html]);
	},

	viewMenu: function(id, curCont) {
		if(this.noMenu) {
			this.noMenu = false;
			return;
		}
		var caption, html, menuTitle, confirm;
		var lang = fmContSettings[curCont].language;
		var url = fmWebPath + '/action.php?fmContainer=' + curCont;
		var userPerms = fmContSettings[curCont].userPerms;
		var items = [];

		switch(id) {

			case 'bulkAction':
				menuTitle = fmMsg[lang].cmdSelAction;

				if(userPerms.bulkDownload) {
					items.push({icon:'download.gif',width:12,caption:fmMsg[lang].cmdDownload,exec:['fmLib.getCheckedFiles',curCont]});
				}
				else if(!userPerms.hideDisabledIcons) {
					items.push({icon:'download_x.gif',width:12,caption:fmMsg[lang].cmdDownload});
				}

				if(userPerms.move) {
					items.push({icon:'move.gif',caption:fmMsg[lang].cmdMove,exec:['fmLib.moveCheckedFiles',curCont,fmMsg[lang].cmdMove]});
				}
				else if(!userPerms.hideDisabledIcons) {
					items.push({icon:'move_x.gif',caption:fmMsg[lang].cmdMove});
				}

				if(userPerms.remove) {
					confirm = userPerms.restore ? '' : fmMsg[lang].msgDelItems;
					items.push({icon:'delete.gif',caption:fmMsg[lang].cmdDelete,exec:['fmLib.deleteCheckedFiles',curCont, fmMsg[lang].cmdDelete,confirm]});
				}
				else if(!userPerms.hideDisabledIcons) {
					items.push({icon:'delete_x.gif',caption:fmMsg[lang].cmdDelete});
				}
				break;

			default:
				menuTitle = fmEntries[curCont][id].name;

				if(fmEntries[curCont][id].deleted) {
					items.push({icon:'restore.gif',caption:fmMsg[lang].cmdRestore,call:'restore'});

					if(userPerms.remove) {
						items.push({icon:'delete.gif',caption:fmMsg[lang].cmdDelete,dialog:'fmDelete',confirm:fmMsg[lang].msgDeleteFile});
					}
				}
				else {
					if(fmEntries[curCont][id].icon.substr(0, 3) == 'dir') {
						items.push({icon:'dir_open.gif',width:12,caption:fmMsg[lang].cmdChangeDir,call:'open'});

						if(userPerms.bulkDownload) {
							items.push({icon:'download.gif',width:12,caption:fmMsg[lang].cmdDownload,exec:['fmLib.getCheckedFiles',curCont,id]});
						}
						else if(!userPerms.hideDisabledIcons) {
							items.push({icon:'download_x.gif',width:12,caption:fmMsg[lang].cmdDownload});
						}
					}
					else if(userPerms.download) {
						items.push({icon:'download.gif',width:12,caption:fmMsg[lang].cmdDownload,exec:['fmLib.getFile',curCont,id]});
					}
					else if(!userPerms.hideDisabledIcons) {
						items.push({icon:'download_x.gif',width:12,caption:fmMsg[lang].cmdDownload});
					}
					items.push({icon:'info.gif',caption:fmMsg[lang].cmdFileInfo,exec:['fmLib.fileInfo',id,curCont]});
					items.push({caption:'separator'});

					if(fmEntries[curCont][id].name.match(/\.(jpe?g|png|gif)$/i)) {
						if(userPerms.imgViewer && fmEntries[curCont][id].thumbnail) {
							items.push({icon:'view.gif',caption:fmMsg[lang].cmdView,dialog:'fmImgViewer'});
						}
						else if(!userPerms.hideDisabledIcons) {
							items.push({icon:'view_x.gif',caption:fmMsg[lang].cmdView});
						}

						if(userPerms.rotate && fmEntries[curCont][id].thumbnail) {
							items.push({icon:'rotateLeft.gif',caption:fmMsg[lang].cmdRotateLeft,call:'rotateLeft'});
							items.push({icon:'rotateRight.gif',caption:fmMsg[lang].cmdRotateRight,call:'rotateRight'});
						}
						else if(!userPerms.hideDisabledIcons) {
							items.push({icon:'rotateLeft_x.gif',caption:fmMsg[lang].cmdRotateLeft});
							items.push({icon:'rotateRight_x.gif',caption:fmMsg[lang].cmdRotateRight});
						}
					}
					else if(fmEntries[curCont][id].docType > 0) {
						if(userPerms.docViewer) {
							switch(fmEntries[curCont][id].docType) {

								case 1:
									items.push({icon:'view.gif',caption:fmMsg[lang].cmdView,dialog:'fmTextViewer'});
									break;

								case 2:
									if(fmContSettings[curCont].publicUrl != '') {
										items.push({icon:'view.gif',caption:fmMsg[lang].cmdView,dialog:'fmDocViewer'});
									}
									else if(!userPerms.hideDisabledIcons) {
										items.push({icon:'view_x.gif',caption:fmMsg[lang].cmdView});
									}
									break;
							}
						}
						else if(!userPerms.hideDisabledIcons) {
							items.push({icon:'view_x.gif',caption:fmMsg[lang].cmdView});
						}
					}

					if(fmEntries[curCont][id].icon.substr(0, 4) == 'text') {
						if(userPerms.edit) {
							items.push({icon:'edit.gif',caption:fmMsg[lang].cmdEdit,call:'edit'});
						}
						else if(!userPerms.hideDisabledIcons) {
							items.push({icon:'edit_x.gif',caption:fmMsg[lang].cmdEdit});
						}
					}

					if(userPerms.rename) {
						items.push({icon:'rename.gif',caption:fmMsg[lang].cmdRename,dialog:'fmRename'});
					}
					else if(!userPerms.hideDisabledIcons) {
						items.push({icon:'rename_x.gif',caption:fmMsg[lang].cmdRename});
					}

					if(userPerms.permissions) {
						items.push({icon:'permissions.gif',caption:fmMsg[lang].cmdChangePerm,dialog:'fmPerm',text:[fmMsg[lang].owner,fmMsg[lang].group,fmMsg[lang].other,fmMsg[lang].read,fmMsg[lang].write,fmMsg[lang].execute]});
					}
					else if(!userPerms.hideDisabledIcons) {
						items.push({icon:'permissions_x.gif',caption:fmMsg[lang].cmdChangePerm});
					}

					if(userPerms.move) {
						caption = fmMsg[lang].cmdMove + ': ' + fmEntries[curCont][id].name;
						caption = caption.replace(/\'/g, "\'");
						items.push({icon:'move.gif',caption:fmMsg[lang].cmdMove,exec:['fmLib.getExplorer',curCont,caption,url + '&fmMode=move&fmObject=' + id]});
					}
					else if(!userPerms.hideDisabledIcons) {
						items.push({icon:'move_x.gif',caption:fmMsg[lang].cmdMove});
					}

					if(fmEntries[curCont][id].icon.substr(0, 3) != 'dir') {
						if(userPerms.copy) {
							caption = fmMsg[lang].cmdCopy + ': ' + fmEntries[curCont][id].name;
							caption = caption.replace(/\'/g, "\'");
							items.push({icon:'copy.gif',caption:fmMsg[lang].cmdCopy,exec:['fmLib.getExplorer',curCont,caption,url + '&fmMode=copy&fmObject=' + id]});
						}
						else if(!userPerms.hideDisabledIcons) {
							items.push({icon:'copy_x.gif',caption:fmMsg[lang].cmdCopy});
						}
					}

					if(userPerms.remove) {
						if(fmEntries[curCont][id].icon.substr(0, 3) == 'dir') {
							items.push({icon:'delete.gif',caption:fmMsg[lang].cmdDelete,dialog:'fmDelete',confirm:fmMsg[lang].msgRemoveDir});
						}
						else if(userPerms.restore) {
							items.push({icon:'delete.gif',caption:fmMsg[lang].cmdDelete,call:'delete'});
						}
						else items.push({icon:'delete.gif',caption:fmMsg[lang].cmdDelete,dialog:'fmDelete',confirm:fmMsg[lang].msgDeleteFile});
					}
					else if(!userPerms.hideDisabledIcons) {
						items.push({icon:'delete_x.gif',caption:fmMsg[lang].cmdDelete});
					}
				}
		}
		html = fmParser.parseMenu(items, curCont, id);
		this.openDialog(null, 'fmMenu', [menuTitle, html]);
	},

	newFileSelector: function(cnt) {
		var f = document.forms.fmNewFile;
		if(f && f['fmFile['+cnt+']']) f['fmFile['+cnt+']'].style.display = 'block';
	},

	deleteCheckedFiles: function(curCont, title, confirm) {
		var ids = fmTools.getSelectedItems(curCont, true);
		if(ids.length > 0) {
			var url = fmWebPath + '/action.php?fmContainer=' + curCont;
			if(confirm) this.openDialog(url, 'fmDelete', [title, confirm], ids);
			else this.call(url + '&fmMode=delete&fmObject=' + ids.join(','));
		}
	},

	getCheckedFiles: function(curCont, ids) {
		if(!ids) ids = fmTools.getSelectedItems(curCont);
		else if(typeof ids != 'object') ids = [ids];

		if(ids.length > 0) {
			var iFrame = frames.fmFileAction;
			if(iFrame) {
				var url = fmWebPath + '/action.php?fmContainer=' + curCont + '&fmMode=getFiles&fmObject=' + ids.join(',');
				iFrame.document.location.href = url;
				this.fadeOut(this.opacity, this.dialog);
			}
		}
	},

	moveCheckedFiles: function(curCont, title) {
		var ids = fmTools.getSelectedItems(curCont, true);
		if(ids.length > 0) {
			var url = fmWebPath + '/action.php?fmContainer=' + curCont + '&fmMode=move&fmObject=' + ids.join(',');
			this.getExplorer(curCont, title, url);
		}
	}
}

fmTools.addListener(document, 'mousemove', function(e) {
	var mouseX = fmLib.mouseX;
	var mouseY = fmLib.mouseY;

	if(e && e.pageX != null) {
		fmLib.mouseX = e.pageX;
		fmLib.mouseY = e.pageY;
	}
	else if(event && event.clientX != null) {
		fmLib.mouseX = event.clientX + fmTools.getScrollLeft();
		fmLib.mouseY = event.clientY + fmTools.getScrollTop();
	}
	if(fmLib.mouseX < 0) fmLib.mouseX = 0;
	if(fmLib.mouseY < 0) fmLib.mouseY = 0;

	if(fmLib.dragging && fmLib.dialog) {
		var x = parseInt(fmLib.dialog.style.left + 0);
		var y = parseInt(fmLib.dialog.style.top + 0);
		fmLib.dialog.style.left = x + (fmLib.mouseX - mouseX) + 'px';
		fmLib.dialog.style.top = y + (fmLib.mouseY - mouseY) + 'px';
	}
});

fmTools.addListener(document, 'mousedown', function(e) {
	var firedobj = (e && e.target) ? e.target : event.srcElement;
	if(firedobj.nodeType == 3) firedobj = firedobj.parentNode;

	if(firedobj.className) {
		var isTitle = (firedobj.className.indexOf('fmDialogTitle') != -1);
		var isDialog = (firedobj.className.indexOf('fmDialog') != -1 && !isTitle);

		if(firedobj.className.indexOf('fmTH1') != -1 || isTitle) {
			fmTools.setUnselectable(firedobj);

			while(firedobj.tagName != 'HTML' && !isDialog) {
				firedobj = firedobj.parentNode;
				isTitle = (firedobj.className.indexOf('fmDialogTitle') != -1);
				isDialog = (firedobj.className.indexOf('fmDialog') != -1 && !isTitle);
			}

			if(firedobj.className.indexOf('fmDialog') != -1) {
				fmLib.dialog = firedobj;
				fmLib.dragging = true;
				fmLib.setOpacity(50, fmLib.dialog);
			}
		}
	}
});

fmTools.addListener(document, 'mouseup', function() {
	fmLib.dragging = false;
	fmLib.setOpacity(100, fmLib.dialog);
});
