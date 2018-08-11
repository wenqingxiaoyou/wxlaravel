<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>益家村介绍篇</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reset.css?v=2.0">
    <link rel="stylesheet" href="css/index.css?v=2.0">
    <link href="https://cdn.bootcss.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="./js/flexible.js?v=2.0"></script>
    <script src="https://cdn.bootcss.com/jquery/3.3.0/jquery.min.js?v=2.0"></script>
    <style>

    </style>
</head>
<body>

<button type="button" class="btn btn-primary" id="button">确认登录</button>

<script>

    var $btn = $('#button');


    var appID = 'wxbac834cdf9ae8d6c';
    $btn.on('click',function () {
        //
        // $.ajax({
        //    url:'/oauth',
        //     data:{
        //         redirect_uri:"http://wx.yasong34.cn/oauth"
        //     },
        //     success:function () {
        //
        //     }
        // });
        // window.location.href = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxbac834cdf9ae8d6c&redirect_uri=http://wx.yasong34.cn/oauth&response_type=code&scope=snsapi_userinfo&state=0123#wechat_redirect'
        var redirect_uri = 'http://wx.yasong34.cn/wxoauth';
        window.location.href = '/mwxoauth';
    });
    //


</script>


</body>
</html>