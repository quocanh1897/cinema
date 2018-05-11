<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use App\User;
use Auth;
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

    public function postSignin(Request $req)
    {
        $this->validate($req, 
        [
            'email'=>'required|email',
            'password'=>'required|min:6|max:20',
        ],
        [
            'email.required'=>'Vui lòng điền email',
            'password.required'=>'Vui lòng nhập mật khẩu! ',
            'password.max'=>'Sai mật khẩu! ',
            'password.min'=>'Sai mật khẩu! '

        ]);
        $credentials = array('email'=>$req->email,'password'=>$req->password);
        if(Auth::attempt($credentials)){
            
            return redirect()->back()->with(['flag'=>'success','done'=>'Đăng nhập thành công']);
        }else{
            return redirect()->back()->with(['flag'=>'danger','fail'=>'Đăng nhập thất bại']);
        }
        

    }

    public function postSignup(Request $req)
    {
        $this->validate($req,
            [
                'email'=>'required|email|unique:users,email',
                'password'=>'required|min:6|max:20',
                'name'=>'required',
                're_password'=>'required|same:password'
            ],
            [
                'email.required'=>'Vui lòng nhập email! ',
                'email.email'=>'email không đúng! ',
                'email.unique'=>'email đã được sử dụng! ',
                'name.required'=>'Vui lòng nhập tên! ',
                'password.required'=>'Vui lòng nhập mật khẩu! ',
                're_password.required'=>'Vui lòng nhập lại mật khẩu! ',
                're_password.same'=>'Mật khẩu không khớp! ',
                'password.max'=>'Mật khẩu tối đa 20 kí tự! ',
                'password.min'=>'Mật khẩu cần ít nhất 6 kí tự! '
            ]);
        
        $user = new User();
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->save();
        return redirect()->back()->with('thanhcong','Tạo tài khoản thành công, hãy đăng nhập lại');

    }

}
