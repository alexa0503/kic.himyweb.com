DATAForWeixin.debug = false; // 可设置为 true 以调试

DATAForWeixin.appId = 'wx79ba388debd4db30',//账号的appid
DATAForWeixin.openid = '',
DATAForWeixin.sharecampaign = 'mbh.addechina.com',//campaign名称

/* 请修改以下文字和图片，定制分享文案 */
DATAForWeixin.setTimeLine({
    title: "第22届美博会（5.23-5.25），上美彩妆盛宴敬待莅临！",
    imgUrl: 'http://mbh.addechina.com/images/shareImg.jpg',
    link: 'http://mbh.addechina.com/',
	success:function(){
		}
});
DATAForWeixin.setAppMessage({
    title: '玩转色彩，品色不凡',
    imgUrl: 'http://mbh.addechina.com/images/shareImg.jpg',
    desc: "第22届美博会（5.23-5.25），上美彩妆盛宴敬待莅临！",
    link: 'http://mbh.addechina.com/',
	success:function(){
		}
});

$(function () {
    DATAForWeixin.getWx(function (wx) {
        //wx.hideAllNonBaseMenuItem({
        //    success: function () {
        //    }
        //});
    });
});     