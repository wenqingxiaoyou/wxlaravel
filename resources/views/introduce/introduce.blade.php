<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>益家村介绍篇</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reset.css?v=2.0">
    <link rel="stylesheet" href="css/index.css?v=2.0">
    <link href="https://cdn.bootcss.com/fullPage.js/2.9.7/jquery.fullpage.min.css?v=2.0" rel="stylesheet">
    <script src="./js/flexible.js?v=2.0"></script>
    <script src="https://cdn.bootcss.com/jquery/3.3.0/jquery.min.js?v=2.0"></script>
    <script src="https://cdn.bootcss.com/fullPage.js/2.9.7/jquery.fullpage.min.js?v=2.0"></script>
</head>
<body>

<div class="loading">
    <div class="cell-div">
        <div class="l-img"></div>
        <div class="line-wrap">
            <div class="line" id="line"></div>
        </div>
        <br>
        <span id="loadingText">0%</span>
    </div>
</div>
<div id="fullpage" class="hide">
    <div class="section">
        <div class="bg-top"></div>
        <div class="bg-bottom"></div>
        <div class="s-inner"></div>
    </div>
    <div class="section">
        <div class="bg-top"></div>
        <div class="bg-bottom"></div>
        <div class="s-inner"></div>
    </div>
    <div class="section">
        <div class="bg-top"></div>
        <div class="bg-bottom"></div>
        <div class="s-inner"></div>
    </div>
    <div class="section">
        <div class="bg-top"></div>
        <div class="bg-bottom"></div>
        <div class="s-inner"></div>
    </div>
    <div class="section">
        <div class="bg-top"></div>
        <div class="bg-bottom"></div>
        <div class="s-inner"></div>
    </div>
    <div class="section">
        <div class="bg-top"></div>
        <div class="bg-bottom"></div>
        <div class="s-inner"></div>
        <div class="download"></div>
    </div>
</div>
<div class="top-arrow"></div>
<div class="m-icon" id="m-control"></div>
<audio loop="loop" src="./audio/music.mp3"  id="audio"></audio>
<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">

    $.ajax({
        url:'/getwxconfig',
        success:function (res) {
            wx.config({
                // 配置信息, 即使不正确也能使用 wx.ready
                debug: false,
                appId: res.appId,
                timestamp:res.timestamp,
                nonceStr: res.nonceStr,
                signature: res.signature,
                jsApiList: res.jsApiList
            });
        }
    });
    wx.ready(function () {
        wx.onMenuShareAppMessage({
            title: '分享标题', // 分享标题
            desc: '分享描述', // 分享描述
            link: 'http://wx.yasong34.cn/introduce', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
            imgUrl: 'http://lfyilian.oss-cn-beijing.aliyuncs.com/wechat/html/introduce/images/share.png', // 分享图标
            type: 'link', // 分享类型,music、video或link，不填默认为link
            dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
            success: function () {
// 用户点击了分享后执行的回调函数
                alert(1);
            }
        });
    })
</script>
<script>
    var initModule = (function () {
        var $audio =$('#audio').get(0);
        $('#audio').attr('src','./audio/music.mp3');
        var $mControl = $('#m-control');
        var $downBtn = $('.download');
        var $topArrow = $('.top-arrow');
        var $page = $('#fullpage');
        var audio = document.getElementById('audio');
        var arrLoading = [
            'images/bg.png',
            'images/bgdown.png',
            'images/bgup.png',
            'images/down.png',
            'images/l-bg@2x.png',
            'images/pause.png',
            'images/play.png',
            'images/section-1.png',
            'images/section-2.png',
            'images/section-3.png',
            'images/section-4.png',
            'images/section-5.png',
            'images/section-6.png',
            'images/top-arrow.png',
        ];
        var isPlay = false;
        var imgLoadFlag = false;
        function init(){
            $(document).ready(function() {
                $page.fullpage({
                    afterLoad:function (anchorLink,index) {
                        if(+index == 6){
                            $topArrow.removeClass('show').addClass('hide');
                        }else{
                            $topArrow.removeClass('hide').addClass('show');
                        }
                    }
                });
            });
            loadingFn(arrLoading);
            bind();
            audioAutoPlay('audio');
        }
        function loadingFn(arrImg) {

            var iNum = 0;
            var totalNum = arrImg.length;
            $.each(arrImg, function (i, img) {
                var objImg = new Image();
                objImg.src = img;
                objImg.onload = function () {
                    iNum++;
                    var rate = (iNum/totalNum);
                    var width = Math.floor(rate*100);
                    $('#line').css({
                        width:width+"%"
                    });
                    $('#loadingText').text(width+"%");
                    if (iNum == arrImg.length) {
                        imgLoadFlag = true;
                        console.log('图片加载完成');
                        setTimeout(function () {
                            $page.removeClass('hide');
                            $('.loading').addClass('hide');
                        },500);
                    }
                };
                objImg.onerror = function () {
                    iNum++;
                    console.log('图片加载失败');
                };
            })
        }

        function audioAutoPlay(id) {
            var　audio = document.getElementById(id);
            $mControl.addClass('play');

            var play = function () {
                audio.play();
                $mControl.addClass('play');

                document.removeEventListener('touchstart',play,false);
            }
            audio.play();
            document.addEventListener('WeicinJSBridgeReady',function () {
                play();
                $mControl.addClass('play');
            });
            document.addEventListener('touchstart',play,false);


            wx.ready(function() {
                audio.play();
                $mControl.addClass('play');
            });
        }

        function bind() {
            $mControl.on('click',function () {
                if($(this).hasClass('play')){
                    $(this).removeClass('play').addClass('pause');
                    $audio.pause();
                }else{
                    $(this).removeClass('pause').addClass('play');
                    $audio.play();
                }
            });
            $downBtn.on('click',function () {
                window.location.href = 'http://a.app.qq.com/o/simple.jsp?pkgname=com.yilian.mall'
            });

            //
            // $(document).one('touchstart',function () {
            //     if(!isPlay && audio.paused){
            //         audio.play();
            //         isPlay = true;
            //         $mControl.addClass('play');
            //     }
            // });
            // audio.addEventListener('canplaythrough',function () {
            //     if(audio.paused){
            //         setTimeout(function () {
            //             audio.play();
            //             isPlay = true;
            //             $mControl.addClass('play');
            //         },1000);
            //     }
            // });

        }
        return {
            init:init,
        }
    })();

    initModule.init();





</script>
</body>
</html>