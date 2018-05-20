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

    public function postSignin(Request $req)
    {
        $this->validate($req, 
        [
            'email'=>'required|email',
            'password'=>'required',
        ],
        [
            'email.required'=>'Vui lòng điền email',
            'password.required'=>'Vui lòng nhập mật khẩu! ',  
        ]);
        //$credentials = $req->only('email', 'password');
        $credentials = array('email'=>$req->email,'password'=>$req->password);
        if (Auth::attempt($credentials)) {
            $data = $req->session()->all();
            //return redirect()->route('dang-ky')->with(['flag'=>'success','mes'=>'Đăng nhập thành công']);

            return redirect()->back()->with('success','Đăng nhập thành công');
        }else{
            return redirect()->back()->with('error','Đăng nhập thất bại');
        }       
    }

    public function postSignup(Request $req)
    {
        $this->validate($req,
            [
                'email'=>'required|email|unique:users,email',
                'password'=>'required|min:6|max:20',                
                're_password'=>'required|same:password',

                'name'=>'required|regex:/(^([a-zA-Z\sàáâãèéêìíòóôõùúăđĩũơưăạảấầẩẫậắằẳẵặẹẻẽềềểễệỉịọỏốồổỗộớờởỡợụủứừửữựỳỵỷỹ]*)$)/|max:50',
                'ngaysinh'=> 'after:"1950-01-01"',
                'gioitinh'=>'required',
                'sodt'=>'numeric|digits_between:10,11',
                'cmnd'=>'numeric|digits:9|unique:users,cmnd',
                'agree'=>'required'
            ],
            [
                'email.required'=>'Vui lòng nhập email! ',
                'email.email'=>'Địa chỉ email vừa nhập không đúng! ',
                'email.unique'=>'Địa chỉ email đã được sử dụng! ',                
                'password.required'=>'Vui lòng nhập mật khẩu! ',
                're_password.required'=>'Vui lòng nhập lại mật khẩu! ',
                're_password.same'=>'Mật khẩu nhập lại không khớp! ',
                'password.max'=>'Mật khẩu cần ít nhất 6 và tối đa 20 kí tự! ',
                'password.min'=>'Mật khẩu cần ít nhất 6 và tối đa 20 kí tự! ',

                'name.regex'=>'Tên không được chứa số hoặc ký tự đặc biệt',              
                'name.max'=>'Tên không được vượt quá 50 ký tự',
                'ngaysinh.after'=>'Ngày sinh không hợp lệ',
                'sodt.numeric'=>'Số điện thoại không hợp lệ',
                'sodt.digits_between'=>'Số điên thoại không hợp lệ',
                'cmnd.numeric'=>'Chứng minh nhân dân vừa nhập không hợp lệ',
                'cmnd.digits'=>'Chứng minh nhân dân vừa nhập không hợp lệ',
                'cmnd.unique'=>'Chứng minh nhân dân này đã được sử dụng',
                'agree.required'=>'Vui lòng đọc và đồng ý với các điều khoản sử dụng!'
            ]);
        
        $obj_user = new User();
        $obj_user->email = $req->email;
        $obj_user->password = Hash::make($req->password);

        $obj_user->name = $req['name'];
        $obj_user->ngaysinh = $req['ngaysinh'];    
        $obj_user->gioitinh = $req['gioitinh'];       
        $obj_user->sodt = $req['sodt'];
        $obj_user->cmnd = $req['cmnd'];
        $obj_user->save();
        return redirect()->back()->with('success','Tạo tài khoản thành công, vui lòng đăng nhập lại');

    }

    // public function postChangePass(Request $req)
    // {
    //     $this->validate($req,
    //         [
    //             'password_old'=>'required',
    //             'password'=>'required|min:6|max:20',
    //             're_password'=>'required|same:password'
    //         ],
    //         [
    //             'password_old.required'=>'Vui lòng nhập mật khẩu cũ! ',
    //             'password.required'=>'Vui lòng nhập mật khẩu! ',
    //             're_password.required'=>'Vui lòng nhập lại mật khẩu! ',
    //             're_password.same'=>'Mật khẩu không khớp! ',
    //             'password.max'=>'Mật khẩu tối đa 20 kí tự! ',
    //             'password.min'=>'Mật khẩu cần ít nhất 6 kí tự! '
    //         ]);
        
    //     if(Hash::check($req['password_old'], Auth::user()->password))
    //     {
    //         $user_id = Auth::user()->id;                       
    //         $obj_user = User::find($user_id);
    //         $obj_user->password = Hash::make($req['password']);;
    //         $obj_user->save(); 
    //         return redirect()->back()->with(['flag'=>'success','mes'=>'Đổi mật khẩu thành công']);
    //     }else{
    //         return redirect()->back()->with(['flag'=>'danger','mes'=>'Sai mật khẩu']);
    //     }
    // }
    
    public function postchangePersonalData(Request $req)
    {
        $this->validate($req,
            [
                'name'=>'regex:/(^([a-zA-Z\sàáâãèéêìíòóôõùúăđĩũơưăạảấầẩẫậắằẳẵặẹẻẽềềểễệỉịọỏốồổỗộớờởỡợụủứừửữựỳỵỷỹ]*)$)/|max:50',
                'ngaysinh'=> 'after:"1950-01-01"',
                'sodt'=>'numeric|digits_between:10,11',
                
            ],
            [
                'name.regex'=>'Tên không được chứa số hoặc ký tự đặc biệt',              
                'name.max'=>'Tên không được vượt quá 50 ký tự',
                'ngaysinh.after'=>'Ngày sinh không hợp lệ',
                'sodt.numeric'=>'Số điện thoại không hợp lệ',
                'sodt.digits_between'=>'Số điên thoại không hợp lệ',
                
            ]);
        
        $user_id = Auth::user()->id;                       
        $obj_user = User::find($user_id);
        $obj_user->name = $req['name'];
        $obj_user->ngaysinh = $req['ngaysinh'];    
        $obj_user->gioitinh = $req['gioitinh'];       
        $obj_user->sodt = $req['sodt'];

        if (is_null($req['password']) && is_null($req['password_old']) && is_null($req['re_password'])) {
            $obj_user->save(); 
            return redirect()->back()->with('success','Thay đổi thông tin thành công');
        } 
        else 
        {   
            $this->validate($req,
                [
                    'password_old'=>'required',
                    'password'=>'required|min:6|max:20',
                    're_password'=>'required|same:password'
                ],
                [      
                    'password_old.required'=>'Vui lòng nhập mật khẩu hiện tại! ',
                    'password.required'=>'Vui lòng nhập mật khẩu mới! ',
                    're_password.required'=>'Vui lòng nhập lại mật khẩu mới! ',
                    're_password.same'=>'Mật khẩu mới không trùng khớp! Vui lòng thử lại ',
                    'password.max'=>'Mật khẩu tối đa 20 kí tự! ',
                    'password.min'=>'Mật khẩu cần ít nhất 6 kí tự! '
                ]
            );      
            if(Hash::check($req['password_old'], Auth::user()->password))
            {
                $obj_user->password = Hash::make($req['password']);;
                $obj_user->save(); 
                return redirect()->back()->with('success','Đổi mật khẩu/thông tin thành công');
            }
            else
            {
                $obj_user->save();
                return redirect()->back()->with('error','Mật khẩu hiện tại không đúng');
            }
        }      
    }

    public function getDangxuat()
    {
        Auth::logout();
        return redirect()->route('trang-chu');
    }

}
