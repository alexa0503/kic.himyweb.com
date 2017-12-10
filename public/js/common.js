//找到url中匹配的字符串
function findInUrl(str){
	url = location.href;
	return url.indexOf(str) == -1 ? false : true;
}
//获取url参数
function queryString(key){
    return (document.location.search.match(new RegExp("(?:^\\?|&)"+key+"=(.*?)(?=&|$)"))||['',null])[1];
}

//产生指定范围的随机数
function randomNumb(minNumb,maxNumb){
	var rn=Math.round(Math.random()*(maxNumb-minNumb)+minNumb);
	return rn;
	}

$(function(){
	var ww=$(window).width();
	var wh=$(window).height();
	$('.pageContent').height(wh);
	loadingImg();
	audioAutoPlay(document.getElementById('bgm'));

	$('.selLine1 .selInitA').on('touchend',function(){
		$('.selLine1 .selInitA').removeClass('selInitAOn');
		$(this).addClass('selInitAOn');
	})

	$('.selLine2 .selInitB').on('touchend',function(){
		$('.selLine2 .selInitB').removeClass('selInitBOn');
		$(this).addClass('selInitBOn');
	})

	$('.selLine3 .selInitB').on('touchend',function(){
		$('.selLine3 .selInitB').removeClass('selInitBOn');
		$(this).addClass('selInitBOn');
	})

	$('.submitBtn').on('touchend',function(){
		submitInfo();
	});
})

function loadingImg(){
    /*图片预加载*/
    var imgNum=0;
    $.imgpreload(images,
            {
                each: function () {
                    var status = $(this).data('loaded') ? 'success' : 'error';
                    if (status == "success") {
						var v = (parseFloat(++imgNum) / images.length).toFixed(2);
                        $(".loading span").html(Math.round(v * 100));
                    }
                },
                all: function () {
					$(".loading span").html('100');
					setTimeout(function(){
						goPage1();
						},500);
                }
            });
	}
var swiper;
var isFirstSwiper=true;
function goPage1(){
	$('.loading').fadeOut(700);
	$('.pageContent').fadeIn(700,function(){
		swiper = new Swiper('.swiper-container', {
			direction: 'vertical',
			initialSlide:0,
			//loop:true,
			onSlideChangeStart:function(e){
				if(e.realIndex==5){
					$('.page6Img1Gif').attr('src','images/page6Img1.gif');
				}
			}
		});
	});
}

var canSubmit=true;
function submitInfo(){
	var iTeam=$.trim($('.txtLine1').val());
	var iName=$.trim($('.txtLine2').val());
	var iTel=$.trim($('.txtLine3').val());
	var iQQ=$.trim($('.txtLine4').val());
	var telReg=/^1[34578]\d{9}$/;
	var qqReg=/^\d{5,40}$/;

	if(iTeam==''){
		alert('请填写队伍名称');
		return;
	} else if(iName==''){
		alert('请填写联系人姓名');
		return;
	} else if(iTel==''||!telReg.test(iTel)){
		alert('请填写正确手机号');
		return;
	} else if(iQQ==''||!qqReg.test(iQQ)){
		alert('请填写正确QQ号');
		return;
	} else {
		// 提交
		if(canSubmit){
			canSubmit=false;//请求按钮加锁 失败或者error解锁
			//ajax请求提交
			var data = {
				team: iTeam,
				name: iName,
				telephone: iTel,
				qq: iQQ,
				_token: window.Laravel.csrfToken,
			}
			$.post('/info', data, function(json){
				canSubmit=true;
				if(json.ret == 0){
					alert('提交成功');
				}
				else{
					alert(json.msg);
				}
			},"JSON").fail(function(){
				canSubmit=true;
				alert('服务器错误');
			})
		}
	}
}

var isWx=false;
var ua=navigator.userAgent.toLowerCase();
if(ua.match(/micromessenger/i) == 'micromessenger'){
	isWx=true;
	}

function audioAutoPlay(a) {
    if (!isWx) {
        a.play();
        return
    }
    a.play();
    try {
        wx.checkJsApi({
            jsApiList: ["checkJsApi"],
            success: function() {
                a.play();
            }
        })
    } catch (b) {}
};


function controlBgm() {
        if ($('.musicBtn').hasClass('on')) {
            $('.musicBtn').removeClass('on');
            document.getElementById('bgm').pause();
        }
        else{
            $('.musicBtn').addClass('on');
            document.getElementById('bgm').play();
        }
    }
