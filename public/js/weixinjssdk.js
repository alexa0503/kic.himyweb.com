

//获取服务器端签名
var WeixinJSSDK = {
    url: 'http://wx.addechina.com/',
    loginurl: 'http://wx.addechina.com/' + 'sns/Oauth2?appId={0}&redirecturl={1}&state={2}&oauthscope={3}',
    getuserinfourl: 'http://wx.addechina.com/' + 'sns/GetUserInfo',
    saveshareurl: 'http://wx.addechina.com/' + 'sns/SaveShareInfo',
    getweixinjssdkconfigurl: 'http://wx.addechina.com/' + 'sns/GetWeixinJSSDKConfig',
    ver: 1.0
}

var wxreadyfunction = [];

var wxready = false;


//通过接口获取签名

var DATAForWeixin = {

    appId: "",

    debug: false,

    bsaveshare:false,

    openid: "",

    sharecampaign: "mbh.addechina.com",

    setAppMessage: function (e) {
        if (wxready) {
            return setAppMessageFun(e)
        } else {
            return wxreadyfunction.push({
                setAppMessage: e
            })
        }
    },
    setTimeLine: function (e) {
        if (wxready) {
            return setTimeLineFun(e)
        } else {
            return wxreadyfunction.push({
                setTimeLine: e
            })
        }
    },
    setQQ: function (e) {
        if (wxready) {
            return setQQFun(e)
        } else {
            return wxreadyfunction.push({
                setQQ: e
            })
        }
    },

    getWx : function(e) {
        if (wxready) {
            return e(wx);
        } else {
            return wxreadyfunction.push({
                getWx: e
            })
        }
    },


    jsApiList: [
      'checkJsApi',
      'onMenuShareTimeline',
      'onMenuShareAppMessage',
      'onMenuShareQQ',
      'onMenuShareWeibo',
      'hideMenuItems',
      'showMenuItems',
      'hideAllNonBaseMenuItem',
      'showAllNonBaseMenuItem',
      'translateVoice',
      'startRecord',
      'stopRecord',
      'onRecordEnd',
      'playVoice',
      'pauseVoice',
      'stopVoice',
      'uploadVoice',
      'downloadVoice',
      'chooseImage',
      'previewImage',
      'uploadImage',
      'downloadImage',
      'getNetworkType',
      'openLocation',
      'getLocation',
      'hideOptionMenu',
      'showOptionMenu',
      'closeWindow',
      'scanQRCode',
      'chooseWXPay',
      'openProductSpecificView',
      'addCard',
      'chooseCard',
      'openCard'
    ]
}

$(function () {

    $.ajaxJsonp({
        'url': WeixinJSSDK.getweixinjssdkconfigurl,
        'data': { "appId": DATAForWeixin.appId, "url": window.location.href, "r": Math.random() },
        'success': function (r) {
            t = {
                debug: DATAForWeixin.debug,
                appId: r.appId,
                timestamp: r.timestamp,
                nonceStr: r.nonceStr,
                signature: r.signature,
                jsApiList: DATAForWeixin.jsApiList
            };
            wx.config(t);
            wx.ready(function () {
                wxready = true;
                wx.showOptionMenu();
                readFun();

				document.getElementById('bgm').play();
				
				audioAutoPlay(document.getElementById('bgm'));
            });
            wx.error(function (e) {
            });
        }
    });

})





setTimeLineFun= function (res) {
    var t;
    t = {
        title: res.title,
        imgUrl: res.imgUrl,
        link: $.UrlUpdateParams(res.link == '' || undefined ? window.location.href : res.link, "shareopenid=" + DATAForWeixin.openid + "&utm_source=sharetimeline"),
        success: function (t) {
            var n;
            trackshare($.UrlUpdateParams(res.link == '' || undefined ? window.location.href : res.link, "shareopenid=" + DATAForWeixin.openid + "&utm_source=sharetimeline"), "share.timeline.success");
            try {
                if ($.isFunction(res.success)) {
                    res.success()
                }
                else {
                    eval(res.success);
                }
            } catch (i) { }
        }
    };
    return wx.onMenuShareTimeline(t)
};

setAppMessageFun = function (res) {
    var t;
    t = {
        title: res.title,
        imgUrl: res.imgUrl,
        desc: res.desc,
        link: $.UrlUpdateParams(res.link == '' || undefined ? window.location.href : res.link, "shareopenid=" + DATAForWeixin.openid + "&utm_source=shareappmessage"),
        success: function (t) {
            var n;
            trackshare($.UrlUpdateParams(res.link == '' || undefined ? window.location.href : res.link, "shareopenid=" + DATAForWeixin.openid + "&utm_source=shareappmessage"), "share.appmessage.success");
            try {
                if ($.isFunction(res.success)) {
                    res.success()
                }
                else {
                    eval(res.success);
                }
            } catch (i) { }
        }
    };
    return wx.onMenuShareAppMessage(t)
};

setQQFun = function (res) {
    var t;
    t = {
        title: res.title,
        imgUrl: res.imgUrl,
        link: $.UrlUpdateParams(res.link == '' || undefined ? window.location.href : res.link, "shareopenid=" + DATAForWeixin.openid + "&utm_source=shareqq"),
        success: function (t) {
            var n;
            trackshare($.UrlUpdateParams(res.link == '' || undefined ? window.location.href : res.link, "shareopenid=" + DATAForWeixin.openid + "&utm_source=shareqq"), "share.qq.success");
            try {
                if ($.isFunction(res.success)) {
                    res.success()
                }
                else {
                    eval(res.success);
                }
            } catch (i) { }
        }
    };
    return wx.onMenuShareQQ(t)
}


readFun = function () {
    var s = [];
    for (n = 0, r = wxreadyfunction.length; n < r; n++) {
        t = wxreadyfunction[n];
        if ($.isFunction(t.getWx)) {
            s.push(t.getWx(wx))
        } else if (t.setAppMessage) {
            s.push(setAppMessageFun(t.setAppMessage))
        } else if (t.setTimeLine) {
            s.push(setTimeLineFun(t.setTimeLine))
        } else if (t.setQQ) {
            s.push(setQQFun(t.setQQ))
        } else {
            continue
        }
    }
    return s
};

trackshare= function ( shareurl, sharetarget) {
    var returnJson = {};

    if (!DATAForWeixin.bsaveshare)
        return ;
    $.ajaxJsonp({
        'url': WeixinJSSDK.saveshareurl,
        'data': { "appid": DATAForWeixin.appId, "openid": DATAForWeixin.openid, "shareurl": shareurl, "sharecampaign": DATAForWeixin.sharecampaign, "sharetarget": sharetarget, "r": Math.random() },
    });
    return returnJson;
}
wechatHandler = function (r) {
};


//微信用户
var WeixinUser = {

    doLogin: function (res) {
        window.location.href = $.format(
            WeixinJSSDK.loginurl,
            DATAForWeixin.appId,
            res.redirecturl==undefined || ''?window.location.href:res.redirecturl,
            res.state == undefined || '' ? "Sys" : res.state,
            res.oauthscope == undefined || '' ? 'snsapi_userinfo' : res.oauthscope);
    },

    getUserInfo: function (res) {
        $.ajaxJsonp({
            'url': WeixinJSSDK.getuserinfourl,
            'data': res,
            'success': res.success
        });
        return returnJson;
    }
}

$.format = function (source, params) {
    if (arguments.length == 1)
        return function () {
            var args = $.makeArray(arguments);
            args.unshift(source);
            return $.format.apply(this, args);
        };
    if (arguments.length > 2 && params.constructor != Array) {
        params = $.makeArray(arguments).slice(1);
    }
    if (params.constructor != Array) {
        params = [params];
    }
    $.each(params, function (i, n) {
        source = source.replace(new RegExp("\\{" + i + "\\}", "g"), n);
    });
    return source;
};

$.UrlUpdateParams = function (url, value) {
    var r = url;

    if (url.match("[\?]")) {
        r = url + "&" + value;
    } else {
        r = url + "?" + value;
    }
    return r;
}

$.ajaxJsonp = function (res) {
    $.ajax({
        'url': res.url,
        'type': res.type == undefined || '' ? 'get' : res.type,
        'async': res.async == undefined || ''? false : res.async,
        'data': res.data,
        'dataType': 'jsonp',
        'jsonpCallback': res.jsonpCallback == undefined || '' ? 'wechatHandler' : res.jsonpCallback,//自定义的jsonp回调函数名称，默认为jQuery自动生成的随机函数名，也可以写"?"，jQuery会自动为你处理数据
        success: function (r) {
            try {
                if ($.isFunction(res.success)) {
                    res.success(r)
                }
            } catch (i) { }
        }
    });

}