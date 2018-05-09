<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function getIndex()//lay trang chu
    {
        return view('page.trangchu');
    }

    public function get404()
    {
        return view('page.404');
    }

    public function getAbout()
    {
        return view('page.about');
    }

    public function phimDangChieu()
    {
        return view('page.phimdangchieu');
    }

    public function phimSapChieu()
    {
        return view('page.phimsapchieu');
    }

    public function heThongRap()
    {
        return view('page.hethongrap');
    }

    public function contact()
    {
        return view('page.contact');
    }

    public function getDangKy()
    {
        return view('page.dangky');
    }

    public function getFAQ()
    {
        return view('page.faq');
    }

}
