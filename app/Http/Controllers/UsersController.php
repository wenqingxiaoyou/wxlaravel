<?php

namespace App\Http\Controllers;

use EasyWeChat\OpenPlatform\Authorizer\OfficialAccount\Application;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    //
    public function __construct(Application $wechat)
    {
        $this->wechat = $wechat;
    }
    public function users(){
        $users = $this->wechat->user->list();
        return $users;
    }
}
