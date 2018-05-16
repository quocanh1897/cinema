<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use App\User;
<<<<<<< HEAD
=======
use App\phim;
use App\khuyen_mai;
use App\rap_chieu;
use App\suat_chieu;
use App\khung_gio;
>>>>>>> a4131c660893e4b8b60470692bd366901e5e415b
use Auth;
use Carbon;

class PageController extends Controller
{
    public function getIndex()//lay trang chu
    {
<<<<<<< HEAD
        return view('page.trangchu');
=======
        $currentDate = Carbon\Carbon::now()->toDateString();
        $km = khuyen_mai::all();
        $pre_phim = phim::where('batdau','>',$currentDate)->get();
        $new_phim = phim::where('batdau','<',$currentDate)->get();
         
        return view('page.trangchu', compact('new_phim','pre_phim','km'));
>>>>>>> a4131c660893e4b8b60470692bd366901e5e415b
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
<<<<<<< HEAD
        return view('page.phimdangchieu');
=======
        $currentDate = Carbon\Carbon::now()->toDateString();
        $phim = phim::where('batdau','<',$currentDate)->get();
        return view('page.phimdangchieu',compact('phim'));
>>>>>>> a4131c660893e4b8b60470692bd366901e5e415b
    }

    public function phimSapChieu()
    {
<<<<<<< HEAD
        return view('page.phimsapchieu');
=======
        $currentDate = Carbon\Carbon::now()->toDateString();
        $phim = phim::where('batdau','>',$currentDate)->get();
        return view('page.phimsapchieu',compact('phim'));
    }

    public function getMuaVe()
    {
        return view('page.muave');
>>>>>>> a4131c660893e4b8b60470692bd366901e5e415b
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

    public function getChitiet()
    {
        return view('page.chitiet');
    }

    public function getChonPhim($idPhim)
    {
        $phimDaChon = phim::where('maphim',$idPhim)->get();
        //dd($phimDaChon);
        return view('page.chonphim',compact('phimDaChon'));
    }

    public function getChonRap($idPhim)
    {
        $phimDaChon = phim::where('maphim',$idPhim)->get();
        $rap = rap_chieu::all();
        return view('page.chonrap',compact('phimDaChon','rap'));
    }

    public function getChonSuatChieu($idPhim, $idRap)
    {
        $currentDate = Carbon\Carbon::now();
        $due = Carbon\Carbon::now()->modify('+7 day');
        $arrDate = [];
        for($i = $currentDate; $i <= $due; $i++){
            $arrDate[] = $currentDate->toDateString();
            $currentDate->addDay();
        }
        $phimDaChon = phim::where('maphim',$idPhim)->get();
        $rapDaChon = rap_chieu::where('marap',$idRap)->get();
        $khunggio = khung_gio::all();
        //dd($khunggio);
        return view('page.chonsuatchieu',compact('phimDaChon','rapDaChon','khunggio','arrDate'));
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
        //$credentials = $req->only('email', 'password');
        $credentials = array('email'=>$req->email,'password'=>$req->password);
        if (Auth::attempt($credentials)) {
            $data = $req->session()->all();
            //return redirect()->route('dang-ky')->with(['flag'=>'success','mes'=>'Đăng nhập thành công']);
            return redirect()->back()->with(['flag'=>'success','mes'=>'Đăng nhập thành công']);
        }else{
            return redirect()->back()->with(['flag'=>'danger','mes'=>'Đăng nhập thất bại']);
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

    public function postChangePass(Request $req)
    {
        $this->validate($req,
            [
                'password_old'=>'required',
                'password'=>'required|min:6|max:20',
                're_password'=>'required|same:password'
            ],
            [
                'password_old.required'=>'Vui lòng nhập mật khẩu cũ! ',
                'password.required'=>'Vui lòng nhập mật khẩu! ',
                're_password.required'=>'Vui lòng nhập lại mật khẩu! ',
                're_password.same'=>'Mật khẩu không khớp! ',
                'password.max'=>'Mật khẩu tối đa 20 kí tự! ',
                'password.min'=>'Mật khẩu cần ít nhất 6 kí tự! '
            ]);
        
        if(Hash::check($req['password_old'], Auth::user()->password))
        {
            $user_id = Auth::user()->id;                       
            $obj_user = User::find($user_id);
            $obj_user->password = Hash::make($req['password']);;
            $obj_user->save(); 
            return redirect()->back()->with(['flag'=>'success','mes'=>'Đổi mật khẩu thành công']);
        }else{
            return redirect()->back()->with(['flag'=>'danger','mes'=>'Sai mật khẩu']);
        }
    }
    
    public function postchangePersonalData(Request $req)
    {
        $this->validate($req,
            [
                'hoten'=>'required|max:50',
                'phone'=>'numeric'
            ],
            [
                'hoten.required'=>'Vui lòng nhập đúng tên! ',
                'phone.numeric'=>'Số điện thoại không đúng',
                'hoten.max'=>'Tên quá dài! ',
            ]);
        
        $user_id = Auth::user()->id;                       
        $obj_user = User::find($user_id);
        $obj_user->phone = $req['phone'];
        $obj_user->name = $req['hoten'];
        $obj_user->diachi = $req['diachi'];
        $obj_user->gioitinh = $req['gioitinh'];
        $obj_user->ngaysinh = $req['ngaysinh'];
        $obj_user->quocgia = $req['quocgia'];
        $obj_user->save(); 
        return redirect()->back()->with(['flag'=>'success','mes'=>'Đổi thông tin thành công']);
        
    }

    public function getDangxuat()
    {
        Auth::logout();
        return redirect()->route('trang-chu');
    }

}
