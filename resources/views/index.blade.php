<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="format-detection" content="telephone=no" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<title>创智天地电竞嘉年华</title>
<meta name="description" content="2017创智天地电竞嘉年华由创智天地和Imba传媒联合主办，赛事分英雄联盟和王者荣耀两个项目">
<meta name="keywords" content="下壹站王者,创智天地,电竞嘉年华,王者荣耀精英赛">
<link rel="stylesheet" href="css/swiper.min.css">
<link rel="stylesheet" href="css/common.css">
<script>
	window.Laravel = {!! json_encode([
		'csrfToken' => csrf_token(),
	]) !!};
</script>
<script src="js/jquery-1.9.1.min.js"></script>
<script src="js/swiper.jquery.min.js"></script>
<script src="js/jquery.imgpreload.js"></script>
<script src="js/common.js"></script>
<!--移动端版本兼容 -->
<script language="javascript" id="temp">document.write('<meta name="viewport" content="width=640, initial-scale='+window.screen.width/640+',user-scalable=no, target-densitydpi=device-dpi">');</script>
<!--移动端版本兼容 end -->
@php
	$js = \EasyWeChat::js();
@endphp

<script src="//res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
<script>
function wxShare(data) {
	wx.ready(function () {
		//document.getElementById('bgm').play();
		wx.onMenuShareAppMessage({
			title: data.title, // 分享标题
			desc: data.desc, // 分享描述
			link: data.link, // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
			imgUrl: data.imgUrl, // 分享图标
			type: data.type || 'link', // 分享类型,music、video或link，不填默认为link
			dataUrl: data.dataUrl || '', // 如果type是music或video，则要提供数据链接，默认为空
			success: function () {
				// 用户确认分享后执行的回调函数
			},
			cancel: function () {
				// 用户取消分享后执行的回调函数
			}
		});
		wx.onMenuShareTimeline({
			title: data.title, // 分享标题
			desc: data.desc, // 分享描述
			link: data.link, // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
			imgUrl: data.imgUrl, // 分享图标
			type: data.type || 'link', // 分享类型,music、video或link，不填默认为link
			dataUrl: data.dataUrl || 'link', // 如果type是music或video，则要提供数据链接，默认为空
			success: function () {
				// 用户确认分享后执行的回调函数
			},
			cancel: function () {
				// 用户取消分享后执行的回调函数
			}
		});
	});
}
@section('wxShareData')
var wxData = {
	title: '下壹站，王者！创智天地电竞嘉年华圣诞狂欢季', // 分享标题
	desc: '2017创智天地电竞嘉年华火热招募中，创智天地携手Imba传媒联合打造，决出城市电竞王者，英雄联盟与王者荣耀两大项目同步开启！', // 分享描述
	link: '{{url("/")}}', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
	imgUrl: '{{asset("images/share.jpg")}}' // 分享图标
};
@show
@if(env('APP_ENV') != 'local')
wx.config({!! $js->config(array('onMenuShareTimeline','onMenuShareAppMessage','onMenuShareQQ', 'onMenuShareWeibo','chooseImage','uploadImage','downloadImage'), false) !!});
wxShare(wxData);
@endif
</script>
</head>

<body>
	<audio src="images/bgm.mp3" id="bgm" loop autoplay preload="auto" style="display: none; height: 0;"></audio>

	<div class="loading"><span>0</span>%</div>

	<div class="pageContent" style="display: none;">
		<div class="swiper-container">
			<div class="swiper-wrapper">
				<!--page1-->
				<div class="swiper-slide">
					<div class="page1Bg">
						<div class="innerDiv">
							<div class="actBlock page1Logo1"></div>
							<div class="actBlock page1Logo2"></div>
							<div class="actBlock page1Img3"></div>
							<div class="actBlock page1Img1"></div>
							<div class="actBlock page1Img2"></div>

							<div class="actBlock arrowUp"></div>
							<div class="actBlock arrowUpNote"></div>
						</div>
					</div>
				</div>

				<!--page2-->
				<div class="swiper-slide">
					<div class="page2Bg">
						<div class="innerDiv">
							<div class="actBlock page1Logo1"></div>
							<div class="actBlock page1Logo2"></div>

							<div class="actBlock page2Img1"></div>

							<div class="actBlock page2Img2"></div>
							<div class="actBlock page2Img3"></div>
							<div class="actBlock page2Img4"></div>

							<div class="actBlock page2Img5"></div>
							<div class="actBlock page2Img6"></div>

							<div class="actBlock arrowUp arrowUp2"></div>
						</div>
					</div>
				</div>

				<!--page3-->
				<div class="swiper-slide">
					<div class="page3Bg">
						<div class="innerDiv">
							<div class="actBlock page1Logo1"></div>
							<div class="actBlock page1Logo2"></div>

							<div class="actBlock page3Img1"></div>
							<div class="actBlock page3Img2"></div>

							<div class="actBlock page3Img6"></div>
							<div class="actBlock page3Img5a page3Img5a1"></div>
							<div class="actBlock page3Img5a page3Img5a2"></div>
							<div class="actBlock page3Img5a page3Img5a3"></div>

							<div class="actBlock page3Img7"></div>
							<div class="actBlock page3Img5b page3Img5b1"></div>
							<div class="actBlock page3Img5b page3Img5b2"></div>

							<div class="actBlock page3Img8"></div>
							<div class="actBlock page3Img5c page3Img5c1"></div>

							<div class="actBlock arrowUp arrowUp2"></div>
						</div>
					</div>
				</div>

				<!--page4-->
				<div class="swiper-slide">
					<div class="page4Bg">
						<div class="innerDiv">
							<div class="actBlock page4Img3"></div>
							<div class="actBlock page4Img4"></div>
							<div class="actBlock page4Img1"></div>
							<div class="actBlock page4Img2"></div>
							<div class="actBlock page4Img5"></div>
							<div class="actBlock page4Img6"></div>

							<div class="actBlock arrowUp arrowUp2"></div>
						</div>
					</div>
				</div>

				<!--page5-->
				<div class="swiper-slide">
					<div class="page5Bg">
						<div class="innerDiv">
							<div class="actBlock page5Img4"></div>
							<div class="actBlock page5Img3"></div>
							<div class="actBlock page5Img1"></div>
							<div class="actBlock page5Img2"></div>
							<div class="actBlock page5Img5"></div>
							<div class="actBlock page5Img6"></div>

							<div class="actBlock arrowUp arrowUp2"></div>
						</div>
					</div>
				</div>

				<!--page6-->
				<div class="swiper-slide">
					<div class="page6Bg">
						<div class="innerDiv">

							<div class="txtLineLabel txtLineLabel1">队伍名称</div>
							<input type="text" class="txtLine txtLine1" placeholder="请填写队伍名称" maxlength="40">

							<div class="txtLineLabel txtLineLabel2">联系姓名</div>
							<input type="text" class="txtLine txtLine2" placeholder="请填写联系姓名" maxlength="20">

							<div class="txtLineLabel txtLineLabel3">联系电话</div>
							<input type="tel" class="txtLine txtLine3" placeholder="请填写正确手机号" maxlength="11">

							<div class="txtLineLabel txtLineLabel4">联系QQ</div>
							<input type="number" class="txtLine txtLine4" placeholder="请填写正确QQ号" maxlength="40">

							<div class="submitBtn"></div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

<a href="javascript:void(0);" onClick="controlBgm();" class="musicBtn on"><img src="images/musicOn.png" class="musicOn" width="50"><img
        src="images/musicOff.png" class="musicOff" width="50"></a>

<script>
var images=[];
	images.push("images/arrowUp.png");
	images.push("images/arrowUpNote.png");

    images.push("images/page1Bg.jpg");
	images.push("images/page1Img1.png");
	images.push("images/page1Img2.png");
	images.push("images/page1Img3.png");
	images.push("images/logo1.png");
	images.push("images/logo2.png");

	images.push("images/page2Bg.jpg");
	images.push("images/page2Img1.png");
	images.push("images/page2Img2.png");
	images.push("images/page2Img3.png");
	images.push("images/page2Img4.png");
	images.push("images/page2Img5.png");
	images.push("images/page2Img6.png");

	images.push("images/page3Bg.jpg");
	images.push("images/page3Img1.png");
	images.push("images/page3Img2.png");
	images.push("images/page3Img5.png");
	images.push("images/page3Img6.png");
	images.push("images/page3Img7.png");
	images.push("images/page3Img8.png");

	images.push("images/page4Bg.jpg");
	images.push("images/page4Img1.png");
	images.push("images/page4Img2.png");
	images.push("images/page4Img3.png");
	images.push("images/page4Img4.png");
	images.push("images/page4Img5.png");
	images.push("images/page4Img6.png");

	images.push("images/page5Bg.jpg");
	images.push("images/page5Img1.png");
	images.push("images/page5Img2.png");
	images.push("images/page5Img3.png");
	images.push("images/page5Img4.png");
	images.push("images/page5Img5.png");
	images.push("images/page5Img6.png");

	images.push("images/page6Bg.jpg");
	images.push("images/page6Btn.png");
</script>

</body>
</html>
