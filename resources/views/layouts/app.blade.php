<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>{{ config('app.name') }}</title>
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />
	<meta name="format-detection" content="telephone=no" />
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<meta http-equiv="x-ua-compatible" content="IE=edge" />
	<!--移动端版本兼容 -->
	<script type="text/javascript">
		document.write('<meta name="viewport" content="width=640, initial-scale=' + window.screen.width / 640 + ',user-scalable=no, target-densitydpi=device-dpi">');
	</script>
	@php
		$js = \EasyWeChat::js();
	@endphp
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
	<!--移动端版本兼容 end -->
	<link href="{{cdn('css/common.css?_=20171109162055')}}" rel="stylesheet" type="text/css">
	<link href="{{cdn('css/swiper.min.css')}}" rel="stylesheet" type="text/css">
    @yield('scripts')

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
		title: 'T3C红人征集令', // 分享标题
		desc: '你负责与众不同，我负责让你一炮而红！', // 分享描述
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
	@yield('content')
</body>

</html>
