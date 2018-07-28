<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use EasyWeChat;

class WeChatController extends Controller
{

    /**
     * 处理微信的请求消息
     *
     * @return string
     */
    public function serve()
    {
        Log::info('request arrived.'); # 注意：Log 为 Laravel 组件，所以它记的日志去 Laravel 日志看，而不是 EasyWeChat 日志

        $app = app('wechat.official_account');
        $app->server->push(function($message){
            return "欢迎关注 前端菜鸟成长记！";
        });

        return $app->server->serve();
    }

    function getConfig(){
        $app = app('wechat.official_account');
        $url = $_SERVER['HTTP_REFERER'];
        $app->jssdk->setUrl($url);
        $result = $app->jssdk->buildConfig([
            'onMenuShareAppMessage', //发送给朋友
            'onMenuShareQQ',  //发送给QQ
            'onMenuShareWeibo', //发送给微博
            'onMenuShareTimeline',//分享给朋友圈
        ], $debug = true, $beta = false, $json = true);
        return $result;
    }
}
