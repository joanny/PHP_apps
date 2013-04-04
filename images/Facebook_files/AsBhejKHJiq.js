/*1327104225,169776066*/

if (window.CavalryLogger) { CavalryLogger.start_js(["gAvVp"]); }

var LiveListenNux=(function(){var b=null;var c=null;var a=[];var d=false;return {init:function(){if(d)return;d=true;Arbiter.subscribe(MusicConstants.LIVE_LISTEN_OP.QUEUING_SESSION,LiveListenNux.destroy);},setFlyout:function(e){LiveListenNux.init();b=e;c=new HoverFlyout();c.init(b);a.each(LiveListenNux.registerButton);c.subscribe('show',function(){JSLogger.create('music_live_listen').log('show_nux');});},destroy:function(){if(c){c.hideFlyout(true);c.destroy();b.destroy();}c=null;b=null;},registerButton:function(e){if(c){c.initNode(e);}else a.push(e);}};})();
window.SpotifyAjaxRequest||(function(){window.SpotifyAjaxRequest=function(){this._request=null;this._data={};this._option={timeout:30000,method:'GET'};this._timeout=null;};copy_properties(SpotifyAjaxRequest,{LOAD_ERROR:'LOAD_ERROR',TIMEOUT_ERROR:'TIMEOUT_ERROR',PARSE_ERROR:'PARSE_ERROR',isSupported:function(){return window.XMLHttpRequest&&typeof XDomainRequest!=='undefined'||('withCredentials' in new XMLHttpRequest());}});Class.mixin(SpotifyAjaxRequest,'Arbiter',{setData:function(a){this._data=a;return this;},setOption:function(a,b){this._option[a]=b;return this;},setURI:function(a){this._uri=URI(a);return this;},send:function(){if(this.inform('initial',this)!==false){this._uri.addQueryData(copy_properties({cors:''},this._data));this._request=new XMLHttpRequest();if('withCredentials' in this._request){this._request.open(this._option.method,this._uri.toString(),true);}else if(typeof XDomainRequest!=='undefined'){this._request=new XDomainRequest();this._request.open(this._option.method,this._uri.toString());}else throw new Error('SpotifyAjaxRequest: not supported');this._request.ontimeout=bagofholding;this._request.onprogress=bagofholding;this._request.onload=this._parseResult.bind(this);this._request.onerror=this._dispatchResult.bind(this,'error',{error:{type:SpotifyAjaxRequest.LOAD_ERROR,message:'the request failed to load at: '+this._uri}});if(this._option.timeout>0)this._timeout=this._dispatchResult.bind(this,'timeout',{error:{type:SpotifyAjaxRequest.TIMEOUT_ERROR,message:'a timeout occurred after '+this._option.timeout+'ms'}}).defer(this._option.timeout,false);this._request.send();}return this;},abort:function(){clearTimeout(this._timeout);try{this._request.abort();}catch(a){}this._request=null;this.inform('finish');return this;},_dispatchResult:function(b,a){clearTimeout(this._timeout);this.inform.bind(this,'finish',a).defer();this.inform(b,a);},_parseResult:function(){var e;var c;var b;var d;try{e=this._request.responseText||'';}catch(a){c=SpotifyAjaxRequest.LOAD_ERROR;b='responseText not available - '+a.message;}if(!c)try{d=JSON.parse(e);}catch(a){c=SpotifyAjaxRequest.PARSE_ERROR;b='exception parsing JSON - '+a.message;}if(!c&&!d){c=SpotifyAjaxRequest.PARSE_ERROR;b='empty JSON';}if(c){this._dispatchResult('error',{error:{type:c,message:b}});}else this._dispatchResult(d.error?'error':'success',d);}});})();
function SpotifyRemote(){}(function(){var a=window.location.protocol==='https:';Class.mixin(SpotifyRemote,'Arbiter',{PROTOCOL_VERSIONS:[9],serial:1,manualPlay:false,showLoggingin:false,oauthTokenInvalid:false,config:{play_now_url:'/ajax/music/spotify_play_now.php?init_only',oauth_step:8,set_installed_url:'/ajax/music/spotify/installed.php',csrf_uri:'/ajax/music/spotify/set_csrf.php',fetch_oauth_url:'/ajax/music/spotify/auth.php?going_online',retryPeriod:3000,iframeUpdatePeriod:10000,iframeTryCycles:3,longPollPeriod:60000,optimisticPlayNowTime:1000,failureCycles:4,loggingInTimeout:15000,defaultTimeout:4000,pingPortsTimeout:4000,expBackoffFactor:1.2,maxPollInterval:2200,apPollTimeout:8000},responseCallback:bagofholding,tokens:{spotify_csrf:'',spotify_oauth:''},serverConfig:{url:window.location.protocol+'//'+((Math.random()*10000)|0)+'.spotilocal.com',start_port:a?4370:4380,end_port:a?4374:4384,path:'/',callbackParam:'callback',ops:{STATUS:'remote/status.json',RESUME:'remote/pause.json?pause=false',PAUSE:'remote/pause.json?pause=true',PLAY:'remote/play.json',VERSION:'service/version.json?service=remote',GET_IFRAME_RESPONSE:'csrf/getFbCsrfToken.html',LOGIN:'remote/login.json'}},STATES:{OFFLINE:'OFFLINE',RESIGNED:'RESIGNED',SEARCHING:'SEARCHING',AUTHENTICATING:'AUTHENTICATING',LOGGED_OUT_AND_WAITING:'LOGGED_OUT_AND_WAITING',FETCHING_OAUTH:'FETCHING_OAUTH',IFRAME_POLLING:'IFRAME_POLLING',RETRYING_TOKENS:'RETRYING_TOKENS',WAITING_TO_AUTH:'WAITING_TO_AUTH',LOGGING_IN:'LOGGING_IN',ONLINE:'ONLINE'},init:function(b,c){this._iframeTryCount=0;this._providerArgs=c;this._switchToState(this.STATES.OFFLINE);b&&this.setResponseCallback(b);this.uri=new URI(this.serverConfig.url||'');this.uri.setPath(this.serverConfig.path||'');if(c.fb_csrf)this.fb_csrf=c.fb_csrf;if(!this.serverConfig.start_port)this.serverConfig.start_port=this.serverConfig.port||80;this._hasXDomainXHR=SpotifyAjaxRequest.isSupported();},persistSearchingFor:function(b){this._persistFor=b;var c=this._persistentLoopTimer;this._resetPersistenceTimers();if(c&&this._persistFor)this._persistentLoopTimer=this._giveUpPersisting.bind(this,this._persistFor).defer(this._persistFor*1000,false);},serviceRunning:function(){switch(this.state){case this.STATES.LOGGED_OUT_AND_WAITING:case this.STATES.IFRAME_POLLING:case this.STATES.RETRYING_TOKENS:case this.STATES.FETCHING_OAUTH:case this.STATES.LOGGING_IN:case this.STATES.ONLINE:return true;default:return false;}},attemptGoOnline:function(b){this.manualPlay=b;if(!this._hasXDomainXHR&&a||ua.opera()){if(this.manualPlay)Dialog.bootstrap('/ajax/music/spotify/unsupported_browser.php');return;}switch(this.state){case this.STATES.OFFLINE:case this.STATES.RESIGNED:var c=this.serverConfig.start_port||this.serverConfig.port;c&&this.uri.setPort(c);this._switchToState(this.STATES.SEARCHING);this.responseCallback(MusicConstants.DIAGNOSTIC_EVENT.SEARCHING);if(this._hasXDomainXHR){this._pingPorts();}else Bootloader.loadComponents('SpotifyJSONPRequest',this._pingPorts.bind(this));break;case this.STATES.LOGGED_OUT_AND_WAITING:if(this.manualPlay){this._switchToState(this.STATES.LOGGING_IN);this._send(MusicConstants.STATUS_CHANGE_OP.LOGIN);}}this.persistSearchingFor(this._persistFor);},reconnect:function(){if(this.state===this.STATES.IFRAME_POLLING){this._cleanupIframe();}else if(this.state===this.STATES.FETCHING_OAUTH){this.fetchedOauth=true;this.oauthTokenInvalid=false;}else return;this._switchToState(this.STATES.RETRYING_TOKENS);this._send(MusicConstants.STATUS_CHANGE_OP.STATUS);},setShowLoggingin:function(b){this.showLoggingin=b;},setTokens:function(b){b=b||{};if(b.spotify_csrf)this.tokens.spotify_csrf=b.spotify_csrf;if(b.spotify_oauth)this.tokens.spotify_oauth=b.spotify_oauth;},getSpotifyCSRFToken:function(){return this.tokens.spotify_csrf;},goOnline:function(){this._switchToState(this.STATES.ONLINE);this._stopPersisting();this.oauthTokenInvalid=false;this._iframeTryCount=0;this.responseCallback(MusicConstants.DIAGNOSTIC_EVENT.ONLINE);this._startPolling();new AsyncRequest(this.config.set_installed_url).setData({set:true,csrf:this.getSpotifyCSRFToken()}).send();},goOffline:function(){this._switchToState(this.STATES.OFFLINE);clearTimeout(this._authenticatingRetry);this._cleanupIframe();this._stopPersisting();this.oauthTokenInvalid=false;this.fetchedOauth=false;this._iframeTryCount=0;this.responseCallback(MusicConstants.DIAGNOSTIC_EVENT.OFFLINE);},displayError:function(b,d){var c=this._getDisplayErrorParams(b,d);Dialog.bootstrap('/ajax/music/play_error.php',c);},_getDisplayErrorParams:function(b,d){var c={code:b,provider:MusicProviders.SPOTIFY};d=d||{};if(d.error_url)c.url=d.error_url;if(d.song)c.song=d.song;return c;},launchPlayNowDialog:function(b){if(this.state!==this.STATES.LOGGED_OUT_AND_WAITING&&this.serviceRunning())return;this._resetLaunchSubscription();var c=this._launchPlayNow.bind(this,b);this.prePlayNowLaunchTimer=c.defer(this.config.optimisticPlayNowTime,false);this.launchSubscription=this.subscribe([MusicConstants.DIAGNOSTIC_EVENT.STATE_CHANGE,MusicConstants.DIAGNOSTIC_EVENT.WRONG_VERSION],function(d,e){if(d===MusicConstants.DIAGNOSTIC_EVENT.WRONG_VERSION){this._resetLaunchSubscription();}else switch(e.to){case this.STATES.OFFLINE:case this.STATES.RESIGNED:this._resetLaunchSubscription();c();break;case this.STATES.AUTHENTICATING:this._resetLaunchSubscription();if(window.MusicDiagnostics)MusicDiagnostics.userAction.curry(MusicProviders.SPOTIFY,MusicDiagnostics.LAUNCH_NOT_NEEDED).defer();break;}}.bind(this));this.attemptGoOnline(true);},send:function(b,c){if(this.state===this.STATES.ONLINE){this._send.call(this,b,c);}else return false;},setResponseCallback:function(b){this.responseCallback=b;},_send:function(e,f){var g=false;if(e===MusicConstants.OP.PLAY&&f){g={uri:f.uri};if(f.playlist){g.context=f.playlist;}else if(f.album){g.context=f.album;}else if(f.song_list){var c=f.song_list.indexOf(f.uri);var i=f.song_list.map(function(j){return j.replace(/.*\//,'');});g.context='spotify:trackset:'+escape(f.title||'Facebook')+':'+i.join(',');}if(f.offset){var d=Math.floor(f.offset/60);var h=f.offset%60;g.uri+='#'+d+':'+h;}if(f.request_id)g.request_id=f.request_id;if(f.listen_with_friends)g.listen_with_friends=f.listen_with_friends;}var b=g||f;if(b&&b.request_id)b.request_id=b.request_id+'';this._createOpRequest(e,b).send();if(window.MusicDiagnostics)MusicDiagnostics.sendUpdate.curry(MusicProviders.SPOTIFY,e,b).defer();},_launchPlayNow:function(c){this._resetLaunchSubscription();var b=c&&c.context&&c.context.button_id;Dialog.bootstrap(this.config.play_now_url,c,null,null,null,ge(b));},_resetLaunchSubscription:function(){clearTimeout(this.prePlayNowLaunchTimer);this.launchSubscription&&this.unsubscribe(this.launchSubscription);},_pingPorts:function(){var b=this.serverConfig.end_port||this.serverConfig.start_port;this.portAttemptCount=b-this.serverConfig.start_port+1;for(var c=this.serverConfig.start_port;c<=b;c++){this.uri.setPort(c);this._createOpRequest(MusicConstants.OP.VERSION).send();}},_stopPersisting:function(){this._persistFor=0;this._resetPersistenceTimers();return this;},_resetPersistenceTimers:function(){clearTimeout(this._persistentLoopTimer);clearTimeout(this._persistentLoopIterationTimer);this._persistentLoopTimer=null;this.loopIterationTime=1000;},_giveUpPersisting:function(b){this._stopPersisting();},_pingPortsModeResign:function(){if(this._persistFor){var b=this.loopIterationTime*this.config.expBackoffFactor;if(b<this.config.maxPollInterval)this.loopIterationTime=b;this._persistentLoopIterationTimer=this.attemptGoOnline.bind(this,this.manualPlay).defer(this.loopIterationTime,false);this._switchToState(this.STATES.RESIGNED);}else this.goOffline();},_startPolling:function(){if(this.state!==this.STATES.ONLINE)return false;this._latestRequest=this._createOpRequest(MusicConstants.STATUS_CHANGE_OP.STATUS,{returnon:'login,logout,play,error,ap',returnafter:this.config.longPollPeriod/1000});this._latestRequest.subscribe('finish',this._startPolling.bind(this));this._latestRequest.send();},_pollForAP:function(){this._createOpRequest(MusicConstants.STATUS_CHANGE_OP.STATUS,{returnon:'ap',returnafter:this.config.apPollTimeout/1000}).send();},_createOpRequest:function(b,c){if(!this.serverConfig.ops[b])return false;var f=this.config.defaultTimeout;if(c&&c.returnon){f=0;}else if(this.state===this.STATES.SEARCHING){f=this.config.pingPortsTimeout;}else if(this.state===this.STATES.LOGGING_IN)f=this.config.loggingInTimeout;var e=this._hasXDomainXHR?new SpotifyAjaxRequest():new SpotifyJSONPRequest();e.setOption('callbackParam',this.serverConfig.callbackParam).setOption('timeout',f).setData(copy_properties({csrf:this.tokens.spotify_csrf,oauth:this.tokens.spotify_oauth},(c||{}))).setURI(this.uri.toString()+this.serverConfig.ops[b]);var d=this.uri.getPort();e.subscribe('success',this._respondToSuccess.bind(this,b,d));e.subscribe('error',this._respondToError.bind(this,b,d));e.subscribe('timeout',this._respondToError.bind(this,b,d));return e;},_respondToSuccess:function(d,e,b,g){this.uri.setPort(e);if(g.hasOwnProperty('online')&&!g.online)if(this.state!=this.STATES.WAITING_TO_AUTH){this._switchToState(this.STATES.WAITING_TO_AUTH);this._pollForAP();return;}else{this.manualPlay&&this.displayError(4);this.goOffline();}switch(this.state){case this.STATES.SEARCHING:var c=g.client_version;var f=g.version;if(this._isValidClient(c,f)){this._switchToState(this.STATES.AUTHENTICATING);this._send(MusicConstants.STATUS_CHANGE_OP.STATUS);}else{this.inform(MusicConstants.DIAGNOSTIC_EVENT.WRONG_VERSION);if(this.manualPlay)Dialog.bootstrap('/ajax/music/spotify/version_mismatch.php');this.goOffline();return;}break;case this.STATES.LOGGING_IN:case this.STATES.RETRYING_TOKENS:case this.STATES.AUTHENTICATING:this.goOnline();break;case this.STATES.WAITING_TO_AUTH:if(g.online){this.goOnline();}else{this.manualPlay&&this.displayError(4);this.goOffline();}break;case this.STATES.RESIGNED:case this.STATES.OFFLINE:return;}g=g?this._convertURIFields(g):{};this.error_count=0;this.responseCallback(d,g);},_respondToError:function(e,g,b,h){switch(this.state){case this.STATES.SEARCHING:if(--this.portAttemptCount<=0)this._pingPortsModeResign();return;case this.STATES.RESIGNED:case this.STATES.OFFLINE:return;}if(e===MusicConstants.OP.VERSION)return;var c=bagofholding;var f=h||{};var d=this._getError(f.error.type);switch(d){case 'SERVICE_DEPENDENT_ERRORS':var i=this._getError(f.error.type,true);if(MusicConstants.STATUS_CHANGE_OP[e]&&MusicEvents.inform(MusicConstants.DIAGNOSTIC_EVENT.SERVICE_ERROR,this._getDisplayErrorParams(i,f))!==false&&MusicConstants.ERROR[i]!=='AUDIO_AD_PLAYING')this.displayError(i,f);break;case 'PARSE_ERROR':case 'LOAD_ERROR':case 'TIMEOUT_ERROR':case 'SERVICE_NOT_RESPONDING':case 'UNKNOWN_SERVICE':case 'UNKNOWN_METHOD':case 'ERROR_PARSING_REQUEST':clearTimeout(this._authenticatingRetry);if(d=='SERVICE_NOT_RESPONDING'&&this.state===this.STATES.AUTHENTICATING){c=this._pingPortsModeResign;break;}c=this._loadError;if(this.state===this.STATES.AUTHENTICATING||this.state===this.STATES.RETRYING_TOKENS){this._authenticatingRetry=this._send.bind(this,MusicConstants.STATUS_CHANGE_OP.STATUS).defer(this.config.retryPeriod,false);}else if(this.state===this.STATES.LOGGING_IN)this._authenticatingRetry=this._send.bind(this,MusicConstants.STATUS_CHANGE_OP.LOGIN).defer(this.config.retryPeriod,false);break;case 'INVALID_OAUTH_FOR_CURRENT_USER':case 'NO_USER_LOGGED_IN':if(this.state===this.STATES.ONLINE){this.goOffline();this._switchToState(this.STATES.LOGGED_OUT_AND_WAITING);return;}else if(this.state===this.STATES.LOGGING_IN){this.oauthTokenInvalid=true;if(!this.fetchedOauth){this._switchToState(this.STATES.FETCHING_OAUTH);new AsyncRequest(this.config.fetch_oauth_url).send();return;}c=this._authError;}else if(this.manualPlay){this._switchToState(this.STATES.LOGGING_IN);this._send(MusicConstants.STATUS_CHANGE_OP.LOGIN);}else this._switchToState(this.STATES.LOGGED_OUT_AND_WAITING);break;case 'EXPIRED_OAUTH_TOKEN':case 'LOGIN_BAD_CREDENTIALS':this.oauthTokenInvalid=true;if(!this.fetchedOauth){this._switchToState(this.STATES.FETCHING_OAUTH);new AsyncRequest(this.config.fetch_oauth_url).send();return;}c=this._authError;break;case 'OAUTH_TOKEN_NOT_VERIFIED':case 'TOKEN_VERIFICATION_TIMEOUT':if(this.state!=this.STATES.WAITING_TO_AUTH){this._switchToState(this.STATES.WAITING_TO_AUTH);this._pollForAP();return;}c=this._authError;break;case 'INVALID_CSRF_TOKEN':case 'AUTH_FAILED':case 'TOKEN_VERIFICATION_DENIED_TOO_MANY_REQUESTS':c=this._authError;break;default:break;}c.call(this,e,f);},_loadError:function(c,b){if(++this.error_count>=this.config.failureCycles)this.goOffline();},_authError:function(c,b){if(this.state===this.STATES.WAITING_TO_AUTH){this.manualPlay&&this.displayError(4);this.goOffline();return;}if(this.showLoggingin){this._launchPlayNow({step:10});this.showLoggingin=false;}this._cleanupIframe();if(this._iframeTryCount<=this.config.iframeTryCycles){this._switchToState(this.STATES.IFRAME_POLLING);this._makeIframePollRequest();this.responseCallback(MusicConstants.DIAGNOSTIC_EVENT.IFRAME_POLLING);}else{if(this.manualPlay)Dialog.bootstrap('/ajax/music/login_error.php');this.goOffline();}},_makeIframePollRequest:function(){var e=URI(window.location.href);if(e.getSubdomain()=='our')e=e.setSubdomain('www');var b=window.location.protocol+'//'+e.getDomain()+'/';var c=URI(b+this.config.csrf_uri).setQueryData({fb_csrf:this.fb_csrf,refresh_token:this.oauthTokenInvalid});var d=URI(this.uri.toString()+this.serverConfig.ops.GET_IFRAME_RESPONSE).setQueryData({set_csrf_path:c.toString(),cbust:this.serial++});this._iframe&&DOM.remove(this._iframe);this._iframe=$N('iframe',{className:'hidden_elem',src:d});document.body.appendChild(this._iframe);var f=bagofholding;if(++this._iframeTryCount<this.config.iframeTryCycles){f=function(){this._makeIframePollRequest();};}else f=function(){this._pingPortsModeResign();};this._iframePollTimeout=f.bind(this).defer(this.config.iframeUpdatePeriod,false);},_cleanupIframe:function(){clearTimeout(this._iframePollTimeout);this._iframe&&DOM.remove(this._iframe);this._iframe=null;},_switchToState:function(b){if(window.MusicDiagnostics)MusicDiagnostics.stateChanged.curry(MusicProviders.SPOTIFY,this.state,b).defer();this.inform(MusicConstants.DIAGNOSTIC_EVENT.STATE_CHANGE,{from:this.state,to:b});this.state=b;},_convertURIFields:function(c){if(!c)return null;if(c.track&&c.track.track_resource){var e=c.track;c.track={uri:e.track_resource.location.og,name:e.track_resource.name};if(e.track_type)c.track.track_type=e.track_type;if(e.artist_resource)c.track.artist=e.artist_resource.name;if(e.album_resource)c.track.album=e.album_resource.name;if(e.length){c.playing_position=c.playing_position?Math.floor(c.playing_position):0;c.expires_in=e.length-c.playing_position;c.expires_in=c.expires_in<0?0:c.expires_in;}}if(c.context&&c.context.context_resource&&c.context.context_resource.location){var b=c.context;c.context={uri:b.context_resource.location.og,name:b.context_resource.name};if(b.creator)c.context.creator=b.creator.real_name;}for(var d in c)if(!MusicConstants.ALLOWED_STATUS_PARAMS[d])delete c[d];if(window.MusicDiagnostics)MusicDiagnostics.receiveUpdate.curry(MusicProviders.SPOTIFY,c).defer();return c;},_isValidClient:function(e,d){var b=this._providerArgs.blacklisted_versions;var c=this._providerArgs.minimum_version;return this.PROTOCOL_VERSIONS.indexOf(d)!==-1&&c&&b&&e&&b.indexOf(e)===-1&&MusicConstants.greaterOrEqualToMinimumVersion(e,c);},_getError:function(b,c){if(!c&&!isNaN(parseFloat(b)))if(b>=4200&&b<=4399)return this._errorMap['4200 - 4399'];return this._errorMap[b];},_errorMap:{'4200 - 4399':'SERVICE_DEPENDENT_ERRORS',4201:1,4202:2,4203:3,4204:4,4205:5,4301:101,4302:102,4303:103,'4000 - 4099':'GENERAL_RPC_ERRORS',4001:'UNKNOWN_METHOD',4002:'ERROR_PARSING_REQUEST',4003:'UNKNOWN_SERVICE',4004:'SERVICE_NOT_RESPONDING','4100 - 4199':'RPC_AUTHENTICATION_ERRORS',4102:'LOGIN_BAD_CREDENTIALS',4103:'EXPIRED_OAUTH_TOKEN',4104:'OAUTH_TOKEN_NOT_VERIFIED',4105:'TOKEN_VERIFICATION_DENIED_TOO_MANY_REQUESTS',4106:'TOKEN_VERIFICATION_TIMEOUT',4107:'INVALID_CSRF_TOKEN',4108:'INVALID_OAUTH_FOR_CURRENT_USER',4109:'INVALID_CSRF_PATH',4110:'NO_USER_LOGGED_IN',LOAD_ERROR:'LOAD_ERROR',TIMEOUT_ERROR:'TIMEOUT_ERROR',PARSE_ERROR:'PARSE_ERROR'}});})();
function WebBridgeRemote(a,b,c){this.responseCallback=a;this.serverID=b;if(!c.external_player)return;this.externalPlayer=this._getExternalPlayer(c.external_player);this.connectionName=URI(this.externalPlayer).getDomain();this.state=WebBridgeRemote.STATES.OFFLINE;this.lastSentMsg=null;this.wasOnline=false;this.connectionAttempts=0;Arbiter.subscribe('MusicFlashBridge.'+this.serverID+'.status',this.reportStatus.bind(this));Arbiter.subscribe('MusicFlashBridge.'+this.serverID+'.initialized',function(){this._flashBridgeReady.bind(this).defer();}.bind(this));ua.osx()&&Event.listen(window,'focus',this._onFocus.bind(this));ua.osx()&&Event.listen(window,'blur',this._onBlur.bind(this));}copy_properties(WebBridgeRemote,{minFlashVersion:'10.0.32.18',flashBridgeSWF:'/music/flash/MusicFlashBridge.swf',STATES:{OFFLINE:'OFFLINE',BRIDGE_WAITING:'BRIDGE_WAITING',BRIDGE_READY:'BRIDGE_READY',ONLINE:'ONLINE'},PLAY_NOW_URL:'/ajax/music/web_bridge_play_now.php?init_only',ERROR_DIALOG:'/ajax/music/play_error.php',TOS_URL:'/music/tos_launch_player.php',OPTIMISTIC_PLAYNOW_TIME:2000,UNLOAD_ON_BLUR_DELAY:3000,REMOTE_CONNECTION_INTERVAL:1500,REMOTE_CONNECTION_TIMEOUT_MANUAL:60,REMOTE_CONNECTION_TIMEOUT_AUTO:5,REMOTE_CONNECTION_RETRY_TIMEOUT:4000,hasMinFlashVersion:function(){var a=deconcept.SWFObjectUtil.getPlayerVersion();if(!a.versionIsValid(new deconcept.PlayerVersion(this.minFlashVersion.split('.')))){spawn_flash_update_dialog();return false;}return true;}});Class.mixin(WebBridgeRemote,'Arbiter',{responseCallback:bagofholding,flashBridge:null,persistFor:0,persistSearchingFor:function(a){this.connectionAttempts=0;this.persistFor=a;this.maxConnectAttempts=Math.floor((a*1000)/WebBridgeRemote.REMOTE_CONNECTION_INTERVAL);if(this.state===WebBridgeRemote.STATES.OFFLINE)this._initFlashBridge();},attemptGoOnline:function(a){var b=a?WebBridgeRemote.REMOTE_CONNECTION_TIMEOUT_MANUAL:WebBridgeRemote.REMOTE_CONNECTION_TIMEOUT_AUTO;if(b<this.persistFor)b=this.persistFor;this.persistSearchingFor(b);},goOffline:function(){this._switchToState(WebBridgeRemote.STATES.OFFLINE);this._removeFlashBridge();this._resetClientPoll();this.responseCallback(MusicConstants.DIAGNOSTIC_EVENT.OFFLINE);},serviceRunning:function(){return this.state===WebBridgeRemote.STATES.ONLINE;},reconnect:function(){},setTokens:function(a){},send:function(a,b){if(this.state===WebBridgeRemote.STATES.ONLINE){this.lastSentMsg={};copy_properties(this.lastSentMsg,b);if(b.radio_station||b.album||b.playlist||b.musician){delete b.song_list;}else if(!b.song)b.song=b.uri;delete b.uri;this._send.call(this,a,b);}else return false;},_send:function(a,b){switch(a){case MusicConstants.OP.PLAY:case MusicConstants.OP.RESUME:case MusicConstants.OP.PAUSE:case MusicConstants.STATUS_CHANGE_OP.STATUS:if(this.flashBridge&&!this._unloadIfNeeded()){this.flashBridge.send(a,b);if(window.MusicDiagnostics)MusicDiagnostics.sendUpdate.curry(this.serverID,a,b).defer();}break;default:}},launch:function(f,a,e,b){var g=this.serverID.replace(/\.|-/g,'_');var d=URI(this.externalPlayer).addQueryData(a);var h=d;if(e)h=URI(WebBridgeRemote.TOS_URL).addQueryData({player_url:d.toString(),url:f,perms:e,get_dtsg:Env.fb_dtsg});window.open(h,g);if(window.MusicDiagnostics)MusicDiagnostics.sendUpdate.curry(this.serverID,MusicDiagnostics.WINDOW_OPEN,a).defer();var c={url:f,step:9};if(b)c=copy_properties(c,b);this._launchPlayNow(c);},launchPlayNowDialog:function(a){if(this.serviceRunning())return;this._resetLaunchSubscription();var b=this._launchPlayNow.bind(this,a);this.prePlayNowLaunchTimer=b.defer(WebBridgeRemote.OPTIMISTIC_PLAYNOW_TIME,false);this.launchSubscription=this.subscribe([MusicConstants.DIAGNOSTIC_EVENT.MISS,MusicConstants.DIAGNOSTIC_EVENT.STATE_CHANGE],function(c,d){if(c===MusicConstants.DIAGNOSTIC_EVENT.MISS){this._resetLaunchSubscription();b();}else if(d.to===WebBridgeRemote.STATES.ONLINE){this._resetLaunchSubscription();if(window.MusicDiagnostics)MusicDiagnostics.userAction.curry(this.serverID,MusicDiagnostics.LAUNCH_NOT_NEEDED).defer();}}.bind(this));this.attemptGoOnline(true);},reportStatus:function(b,a){var e=a.op;var c=a.args;clearTimeout(this._pollTimeout);if(c.error_code)switch(MusicConstants.ERROR[c.error_code]){case 'AUDIO_AD_PLAYING':break;default:var d={code:c.error_code,provider:this.serverID};if(c.song)d.song=c.song;if(c.redirect_url)d.url=c.redirect_url;Dialog.bootstrap(WebBridgeRemote.ERROR_DIALOG,d);return;}if(c.offline){this.goOffline();}else if(e===MusicConstants.DIAGNOSTIC_EVENT.MISS){this.inform(e,c);if(this.state!==WebBridgeRemote.STATES.ONLINE&&this.state!==WebBridgeRemote.STATES.OFFLINE){if(this.connectionAttempts<this.maxConnectAttempts){this._pollForClient.bind(this).defer(WebBridgeRemote.REMOTE_CONNECTION_INTERVAL,false);}else this.goOffline();}else if(this.state===WebBridgeRemote.STATES.ONLINE){this.goOffline();if(this.lastSentMsg&&this.lastSentMsg.uri)this.responseCallback(MusicConstants.DIAGNOSTIC_EVENT.RELAUNCH,{last_sent:this.lastSentMsg});return;}}else if(this.state===WebBridgeRemote.STATES.BRIDGE_READY){this.wasOnline=true;this._switchToState(WebBridgeRemote.STATES.ONLINE);this.responseCallback(MusicConstants.DIAGNOSTIC_EVENT.ONLINE);}if(window.MusicDiagnostics&&e===MusicConstants.STATUS_CHANGE_OP.STATUS)MusicDiagnostics.receiveUpdate.curry(this.serverID,c).defer();if(c.radio_station||c.song){c.track={};c.track.uri=c.radio_station||c.song;c.track.songuri=c.song;}if(c.radio_station){c.context={name:c.title,uri:c.radio_station};}else if(c.playlist){c.context={name:c.title,uri:c.playlist};}else if(c.album){c.context={name:c.title,uri:c.album};}else if(c.musician)c.context={name:c.title,uri:c.musician};this.responseCallback.apply(this,[e].concat(c));},_onFocus:function(){clearTimeout(this._blurTimeout);if(!this.wasOnline)return;if(!this.flashBridge){this.persistSearchingFor(WebBridgeRemote.REMOTE_CONNECTION_TIMEOUT_AUTO);}else this.flashBridge.activate();},_onBlur:function(){if(this.flashBridge){clearTimeout(this._blurTimeout);this._blurTimeout=function(){this._unloadIfNeeded();}.bind(this).defer(WebBridgeRemote.UNLOAD_ON_BLUR_DELAY);}},_unloadIfNeeded:function(){if(this.flashBridge)try{if(ua.osx()&&this.flashBridge.shouldUnload()){this.goOffline();return true;}}catch(a){}return false;},_launchPlayNow:function(b){var a=b&&b.context&&b.context.button_id;this._resetLaunchSubscription();Dialog.bootstrap(WebBridgeRemote.PLAY_NOW_URL,b,null,null,null,ge(a));},_resetLaunchSubscription:function(){clearTimeout(this.prePlayNowLaunchTimer);this.launchSubscription&&this.unsubscribe(this.launchSubscription);},_initFlashBridge:function(){this.flashBridge=ge(this.serverID);if(!this.flashBridge){this._switchToState(WebBridgeRemote.STATES.BRIDGE_WAITING);var a=this.serverID+'_container';document.body.appendChild($N('div',{id:a}));var b=new SWFObject(WebBridgeRemote.flashBridgeSWF,this.serverID,'1px','1px');b.addParam('allowscriptaccess','always');b.addVariable('swf_id',this.serverID);b.addVariable('name',this.connectionName);b.addVariable('user_id',Env.user);b.write(a);window[this.serverID]=b;this.flashBridge=$(this.serverID);}else this._flashBridgeReady();},_removeFlashBridge:function(){if(this.flashBridge){var a=this.serverID+'_container';DOM.remove($(a));this.flashBridge=null;}},_switchToState:function(a){if(window.MusicDiagnostics)MusicDiagnostics.stateChanged.curry(this.serverID,this.state,a).defer();this.inform(MusicConstants.DIAGNOSTIC_EVENT.STATE_CHANGE,{from:this.state,to:a});this.state=a;},_flashBridgeReady:function(){if(this.state!=WebBridgeRemote.STATES.ONLINE){this._switchToState(WebBridgeRemote.STATES.BRIDGE_READY);this._pollForClient();}},_resetClientPoll:function(){this.connectionAttempts=0;this.persistFor=0;clearTimeout(this._pollTimeout);},_pollForClient:function(){if(!this.flashBridge||this.state==WebBridgeRemote.STATES.OFFLINE)return;this._send(MusicConstants.STATUS_CHANGE_OP.STATUS,{});if(++this.connectionAttempts<this.maxConnectAttempts){timeout_function=function(){if(this.state==WebBridgeRemote.STATES.OFFLINE)return;clearTimeout(this._pollTimeout);this._pollForClient();};}else timeout_function=function(){this.goOffline();};this._pollTimeout=timeout_function.bind(this).defer(WebBridgeRemote.REMOTE_CONNECTION_RETRY_TIMEOUT,false);},_getExternalPlayer:function(a){return a;}});