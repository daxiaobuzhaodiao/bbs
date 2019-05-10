<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    function index()
    {
    	return view('pages.root');
    }

    function test()
    {
        // return captcha();        // 返回图片
        // return captcha_img('math');       // 图片地址
    }
}
