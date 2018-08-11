<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IntroduceController extends Controller
{
    //

    public function show(){
        return view('introduce.introduce');
    }

    function login(){
        return view('introduce.login');
    }
    function showback(){
        return view('introduce.show');
    }
}
