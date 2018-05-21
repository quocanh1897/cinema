<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use App\User;
use App\phim;
use App\khuyen_mai;
use App\rap_chieu;
use App\suat_chieu;
use App\khung_gio;
use App\dien_vien;
use App\dich_vu;
use App\the_loai;
use Auth;
use Carbon;
use Redirect;
use Session;

class PageController extends Controller
{
    public function getIndex()//lay trang chu
    {
        $currentDate = Carbon\Carbon::now()->toDateString();
        $km = khuyen_mai::all();
        $pre_phim = phim::where('batdau','>',$currentDate)->get();
        $new_phim = phim::where('batdau','<',$currentDate)->get();
         
        return view('page.trangchu', compact('new_phim','pre_phim','km'));
    }

    public function get404()
    {
        return view('page.404');
    }

    public function getProfile()
    {
        return view('page.profile');
    }

    public function getAbout()
    {
        return view('page.about');
    }

    public function getLichSu()
    {
        return view('page.lichsu');
    }

    public function getChiTietLichSu()
    {
        return view('page.chitietlichsu');
    }

    public function getPhimDaXem()
    {
        return view('page.phimdaxem');
    }

    public function phimDangChieu()
    {
        $currentDate = Carbon\Carbon::now()->toDateString();
        $phim = phim::where('batdau','<',$currentDate)->get();
        return view('page.phimdangchieu',compact('phim'));
    }

    public function phimSapChieu()
    {
        $currentDate = Carbon\Carbon::now()->toDateString();
        $phim = phim::where('batdau','>',$currentDate)->get();
        return view('page.phimsapchieu',compact('phim'));
    }

    public function getMuaVe()
    {
        return view('page.muave');
    }

    public function heThongRap()
    {
        $rap = rap_chieu::all();
        return view('page.hethongrap',compact('rap'));
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

    public function getFAQduy()
    {
        return view('page.faqduy');
    }

    public function getChitiet($idPhim)
    {
        
        $phim = phim::where('maphim',$idPhim)->get();
        $dienvien = dien_vien::where('maphim',$idPhim)->get();
        $theloai = the_loai::where('maphim',$idPhim)->get();
         
        return view('page.chitiet',compact('phim','dienvien','theloai'));
    }

    public function postChonPhim(Request $req)
    {
        $phimDaChon = phim::where('maphim',$req['idphim'])->get();
        return view('page.chonphim',compact('phimDaChon'));
    }

    public function postChonRap(Request $req)
    {
        $phimDaChon = phim::where('maphim',$req['idphim'] )->get();
        //dd($phimDaChon);
        $rap = rap_chieu::all();
        return view('page.chonrap',compact('phimDaChon','rap'));
    }

    public function postChonSuatChieu(Request $req)
    {
        $phimDaChon = phim::where('maphim',$req['idphim'])->get();
        $rapDaChon = rap_chieu::where('marap',$req['idrap'])->get();
        
        
        $suatchieu = suat_chieu::where([
            ['maphim','=',$req['idphim']],
            ['marap','=', $req['idrap']]
        ])->select('ngaychieu')->distinct()->get();


        $currentDate = Carbon\Carbon::now()->toDateString();
        $kgtungngay = [];
        foreach($suatchieu as $sc){
            if($sc->ngaychieu < $currentDate) continue;
            $kgtungngay[] = suat_chieu::join('khung_gio','suat_chieu.makhunggio','khung_gio.makhunggio')
            ->where([
                ['ngaychieu',$sc->ngaychieu],
                ['maphim','=',$req['idphim']],
                ['marap','=', $req['idrap']]
                ])->get();
        }
        
        /*
        
        $due = Carbon\Carbon::now()->modify('+7 day');
        $arrDate = [];
        for($i = $currentDate; $i <= $due; $i++){
            $arrDate[] = $currentDate->toDateString();
            $currentDate->addDay();
        }*/
        //dd($kgtungngay[0]->first()->ngaychieu);
        return view('page.chonsuatchieu',compact('phimDaChon','rapDaChon','kgtungngay'));

    }

    public function postMuaVe(Request $req)
    {
        $dichvu = dich_vu::all();
        $phimDaChon = phim::where('maphim',$req['idphim'])->get();
        $rapDaChon = rap_chieu::where('marap',$req['idrap'])->get();
        $ngay = $req['ngaychieu'];
        $gio = $req['giochieu'];
        return view('page.muave',compact('phimDaChon','rapDaChon','ngay','gio','dichvu') );

    }

    public function getMuaVeMenu()
    {
        $currentDate = Carbon\Carbon::now()->toDateString();
        $phim = phim::where('batdau','<',$currentDate)->get();
        $rap = rap_chieu::all();
        $khung_gio = khung_gio::all();
        return view('page.chonphimve',compact('phim','rap','khung_gio'));
    }

}