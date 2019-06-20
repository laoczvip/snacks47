<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    /**
     * 加载前台首页
     *
     * @return \Illuminate\Http\Response
     */

    public function Index()
    {
        return view('home.index.index');
    }

}
