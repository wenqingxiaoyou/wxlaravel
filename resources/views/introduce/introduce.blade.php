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
           var res = JSON.parse(res);
           wx.config({
               debug: false,
               appId: res.appId,
               timestamp:res.timestamp,
               nonceStr: res.nonceStr,
               signature: res.signature,
               jsApiList: res.jsApiList
           });
       }
   });

   var shareD = {
       title:'欢迎来到益家村！',
       desc:'平价购物，还有更多惊喜，你不进来看看么？',
       link:'http://wx.yasong34.cn/introduce',
       imgUrl: 'http://lfyilian.oss-cn-beijing.aliyuncs.com/wechat/html/introduce/images/share.png',
       type:'link'
   }

    wx.ready(function () {
        wx.onMenuShareAppMessage({ //分享给分享给朋友
            title: shareD.title,
            desc: shareD.desc,
            link: shareD.link,
            imgUrl: shareD.imgUrl,
            type: shareD.link,
            dataUrl: '',
            success: function () {}
        });
        wx.onMenuShareTimeline({ //分享到朋友圈
            title: shareD.title,
            link: shareD.link,
            imgUrl: shareD.imgUrl,
            success: function () {}
        });
        wx.onMenuShareQQ({  //分享到QQ
            title: shareD.title,
            desc: shareD.desc,
            link: shareD.link,
            imgUrl: shareD.imgUrl,
            success: function () {},
            cancel: function () {}
        });
        wx.onMenuShareQZone({ //分享到qq空间
            title: shareD.title,
            desc: shareD.desc,
            link: shareD.link,
            imgUrl: shareD.imgUrl,
            success: function () {},
            cancel: function () {}
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