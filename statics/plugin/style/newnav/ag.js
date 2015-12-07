(function() {
	ag_para = {
		getCookie : function(key) {
			var arr = document.cookie.match(new RegExp("(^| )" + key
					+ "=([^;]*)(;|$)"));
			if (arr != null)
				return unescape(arr[2]);
			return null;
		},
		from_input : function(para) {
			if (!_agt) {
				return;
			}
			for (var i = 0; i < _agt.length; i++) {
				if (_agt[i][0]) {
					key = _agt[i][0].substring(1);
					para[key] = "0";
				}
				if (_agt[i].length > 1) {
					para[key] = _agt[i][1];
				}
			}
			
			if (self.frameElement && "IFRAME" == self.frameElement.tagName) {
				var parentUrl = parent.location.href;
				if (parentUrl) {
					para['purl'] = parentUrl;
				}
			}
			para['agfid'] = ag_cookie.getAGFID();
		},
		from_comParams : function(para) {
			var n = navigator;
			para.atsp = n.platform;
			para.atsl = n.language ? n.language : n.browserLanguage;
			para.atsbr = document.body.clientWidth + 'x'
					+ document.body.clientHeight;
			para.atssr = window.screen.width + 'x' + window.screen.height;
			para.atsc = document.charset || document.characterSet;
			para.atsh = location.host;
		},
		from_atstd : function(para) {
			var url = "";
			try {
				url = window.top.location.search;
			} catch (e) {
				url = window.location.search;
			}
			try {
				if (url.indexOf("?") != -1) {
					var str = url.substr(1);
					strs = str.split("&");
					for (var i = 0; i < strs.length; i++) {
						if (strs[i].split("=")[0] == "ag_kwid")
							if (strs[i].split("=").length > 1) {
								para.atstd = strs[i].split("=")[1];
							}
					}
				}
			} catch (e) {
				var ss = "pass";
			}
		},
		from_referrer : function(para) {
			var referrer = '';
			try {
				referrer = window.top.document.referrer;
			} catch (e) {
				if (window.parent) {
					try {
						referrer = window.parent.document.referrer;
					} catch (e2) {
						referrer = document.referrer;
					}
				}
			}

			/* para.refer = referrer; */
			para.atsrf = referrer;
		},
		from_pv : function(para) {
			if ("tkpv" in para) {
				para.atspv = "1";
			}
		},
		from_2click : function(para) {
			if ("tkRedirect" in para) {
				var ag_count = this.getCookie(ag_cookie.rdCookieKey);
				if (ag_count == 2) {
					para.atsrd = "1";
				}
			}
		},
		from_domain : function(para) {
			if ('atsdomain' in para) {
				para.domain = para.atsdomain;
			} else {
				para.domain = window.location.host;
			}
		},
		from_2clickCookie : function(para) {
			if (para.atstd) {
				/* para.atsrf = para.refer; */
				var cookies = new Array([ ag_cookie.rdCookieKey, escape(1) ]);
				ag_cookie.setCookie(cookies, para.domain);
			} else {
				ag_count_tmp = ag_cookie.get_rdCookie();
				if (ag_count_tmp) {
					ag_count = ag_count_tmp;
					ag_count++;
					var cookies = new Array([ ag_cookie.rdCookieKey,
							escape(ag_count) ]);
					ag_cookie.setCookie(cookies, para.domain);
				}
			}
		},
		del_var : function(para) {
			var a = [ "tkpv", "tkRedirect", "domain", "refer", "atstime" ];
			for (var i = 0; i < a.length; i++) {
				delete para[a[i]];
			}
		}
	};

	var ag_cookie = {
		rdCookieKey : 'ag_count',
		AGFID_COOKIE_KEY : 'ag_fid',
		FIRST_COOKIE_SUFFIX : "F",

		get_rdCookie : function(ck) {
			var key = ck || this.rdCookieKey;
			var arr = document.cookie.match(new RegExp("(^| )" + key
					+ "=([^;]*)(;|$)"));
			if (arr != null)
				return unescape(arr[2]);
			return null;
		},
		setCookie : function(cookies, host) {
			var domain = "";
			var main_host_reg=/[-0-9a-z]+\.((com\.cn|net\.cn|org\.cn|gov\.cn)|[a-z]{2,5})($|\/)/gi;
			try{
				domain=host || window.top.location.hostname;
			}catch(err){
				domain=window.location.hostname;
			}
			domain=domain.match(main_host_reg);
			var path = '/';
			var exp = 10 * 365 * 24 * 60 * 60 * 1000;
			var expires = new Date();
			expires.setTime(expires.getTime() + exp);
			var cookiestr = '';
			for (var i = 0; i < cookies.length; i++) {
				cookiestr = cookiestr + cookies[i][0] + '=' + cookies[i][1]
						+ ';';
			}
			document.cookie = cookiestr + 'expires=' + expires.toGMTString()
					+ ";path=" + path + ";" + "domain=" + domain;
		},
		randomString : function(len) {
			len = len || 32;
			var chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
			var maxPos = chars.length;
			var pwd = '';
			for (i = 0; i < len; i++) {
				pwd += chars.charAt(Math.floor(Math.random() * maxPos));
			}
			return pwd;
		},
		getAGFID : function() {
			var agfid = this.get_rdCookie(this.AGFID_COOKIE_KEY);
			if (agfid == null || agfid.length == 0) {
				agfid = this.randomString(15) + this.FIRST_COOKIE_SUFFIX;
			}
			var cookies = new Array([ this.AGFID_COOKIE_KEY, escape(agfid) ]);
			this.setCookie(cookies);
			return agfid;
		}
	};

	var ag_sender = {
		pvUrl : 't4.agrantsem.com/pv?',
		eventUrl : 't.agrantsem.com/tker.gif?',
		query : '',
		init : function(para) {
			ag_para.del_var(para);
			para.atstime = new Date().getTime();
			this.query = "";
			for ( var p in para) {
				this.query = this.query + '&' + p;
				if (para[p]) {
					this.query = this.query + "=" + encodeURIComponent(para[p]);
				}
			}
		},
		build_img : function(url) {
			var img = document.createElement('IMG');
			if (ag_sender.query.indexOf('&') == 0) {
				ag_sender.query = ag_sender.query.substring(1);
			}
			img.src = (document.location.protocol == 'https:' ? 'https://'
					: 'http://')
					+ url + ag_sender.query;
			img.style.display = 'none';
			img.style.width = '0px';
			img.style.height = '0px';
			document.body.appendChild(img);
		},
		img_query : function(para, fn, url) {
			this.init(para);
			if (document.onreadystatechange && document.readyState) {
				if (document.readyState == 'complete'
						|| document.readyState == 'loaded') {
					fn(url);
				} else {
					document.onreadystatechange = function() {
						if (document.readyState == 'complete'
								|| document.readyState == 'loaded') {
							fn(url);
						}
					};
				}
			} else {
				fn(url);
			}
		},
		send : function(para) {
			if ('atspv' in para) {
				this.img_query(para, this.build_img, this.pvUrl);
			}
			if ('atsrd' in para || 'atstd' in para || 'atsev' in para) {
				this.img_query(para, this.build_img, this.eventUrl);
			}
		}
	};
	var CookieMapping = function(ag_main_domain) {
		//add param for adx/tanx(use atscu),bes(use ext_data) value atscu
		var atscu;
		if (!_agt) {
			return;
		}
		for (var i = 0; i < _agt.length; i++) {
			if (_agt[i][0].substring(1) == "atscu") {
				atscu = _agt[i][1];
			}
		}
		if(document.location.protocol == 'https:'){
            this.cm_param = [];
        }else{
            this.cm_param = [
				'cm.g.doubleclick.net/pixel?google_nid=agrantcn&google_cm&atscu='+atscu,
				'cms.tanx.com/t.gif?tanx_nid=42756270&tanx_cm&atscu='+atscu,
				'cm.pos.baidu.com/pixel?dspid=6666724&ext_data='+ atscu ];
        }
		this.ck = "__ag_cm_";
		this.img_query = function(fn, url) {
			if (document.onreadystatechange && document.readyState) {
				if (document.readyState == 'complete'
						|| document.readyState == 'loaded') {
					fn(url);
				} else {
					document.onreadystatechange = function() {
						if (document.readyState == 'complete'
								|| document.readyState == 'loaded') {
							fn(url);
						}
					};
				}
			} else {
				fn(url);
			}
		};
		this.build_img = function(url) {
			var img = document.createElement('IMG');
			img.src = (document.location.protocol == 'https:' ? 'https://'
					: 'http://')
					+ url;
			img.style.display = 'none';
			img.style.width = '0px';
			img.style.height = '0px';
			document.body.appendChild(img);
		};

		this.genCookieValue = function() {
			var t = new Date().getTime();
			var cookieValue = ag_cookie.get_rdCookie(this.ck);
			var cv=null;
			if (t - cookieValue && t - cookieValue < 7 * 24 * 3600000) {
					cv = null;
			} else {
				cv = t;
			}
			return cv;
		};
		this.send = function() {
			var cv = this.genCookieValue();
			var host = "";
			try{
				host=ag_main_domain || window.top.location.host
						|| window.top.location.hostname;
			}catch(err){
				host=window.location.hostname;
			}
			host = host
					.match(/[-a-z0-9]+\.(com|cn|com\.cn|me|org|cc|info|net|net\.cn)(?=$)/gi);
			if (host && host.length > 0) {
				host = host[0];
			}
			if (cv) {
				ag_cookie.setCookie([ [ this.ck, cv ] ], host);
				for ( var i in this.cm_param) {
					this.img_query(this.build_img, this.cm_param[i]);
				}
			}
		};
	};
	var ag_main = {
		track : function() {
			var para = {};
			ag_para.from_input(para);
			ag_para.from_comParams(para);
			ag_para.from_atstd(para);
			ag_para.from_referrer(para);
			ag_para.from_pv(para);
			ag_para.from_domain(para);
			ag_para.from_2clickCookie(para);
			ag_para.from_2click(para);
			para.atspv = 1;
			var cm = new CookieMapping();
			cm.send();
			ag_sender.send(para);
			
		}
	};
	ag_main.track();
})();
