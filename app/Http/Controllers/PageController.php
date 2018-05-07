<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function getIndex()//lay trang chu
    {
        return view('master');
    }
}
