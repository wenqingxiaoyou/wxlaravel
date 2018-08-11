<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Log;
use EasyWeChat;

class WeChatController extends Controller
{

    /**
     * 处理微信的请求消息
     *
     * @return string
     */
    function __construct()
    {
        $this->app = app('wechat.official_account');
    }

    public function serve()
    {
        Log::info('request arrived.'); # 注意：Log 为 Laravel 组件，所以它记的日志去 Laravel 日志看，而不是 EasyWeChat 日志

        $app = $this->app;
        $app->server->push(function($message){
            return "欢迎关注 前端菜鸟成长记！";
        });

        return $app->server->serve();
    }

    function getConfig(Request $request){

        //$url = $_SERVER['HTTP_REFERER']; //获取当前页面的url
        $app = $this->app ;
        $app->jssdk->setUrl($request->url);
        $result = $app->jssdk->buildConfig([
            'onMenuShareAppMessage', //发送给朋友
            'onMenuShareQQ',  //发送给QQ
            'onMenuShareWeibo', //发送给微博
            'onMenuShareTimeline',//分享给朋友圈
        ], $debug = true, $beta = false, $json = true);
        return $result;
    }

    function oauthConfirm(Request $request){
        $app = $this->app ;
        $response = $app->oauth->scopes(['snsapi_userinfo'])
            ->setRequest($request)
            ->redirect('http://wx.yasong34.cn/wxoauth');
        return $response;
    }

    function wxoauth(Request $request){
        $app = $this->app ;
        $user = $app->oauth->setRequest($request)->user();

    }

    function mwxoauth(){
        $user = session('wechat.oauth_user'); // 拿到授权用户资料

        return redirect('introduce');
    }
}
