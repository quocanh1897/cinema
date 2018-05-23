<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
use App\loai_phong;
use App\loai_ghe;
use App\phong_chieu;
use App\ghe_ngoi;
use App\nhan_vien;
use App\hoa_don;
use App\ve;
use Auth;
use Carbon;
use Redirect;
use Session;

class PageController extends Controller
{ 
    // Trang chủ
    public function getIndex()
    {
        $currentDate = Carbon\Carbon::now()->toDateString();
        $km = khuyen_mai::where('ketthuc','>',$currentDate)->get();
        $pre_phim = phim::where('batdau','>',$currentDate)->get();
        $new_phim = phim::where('batdau','<',$currentDate)->get();
         
        return view('page.trangchu', compact('new_phim','pre_phim','km'));
    }
    // End trang chủ ===============================================================
    // Nhóm trang thông tin khách hàng
    public function getProfile()
    {
        return view('page.profile');
    }
    public function getLichSu()
    {     
        $user_id = Auth::user()->id;                       
        $hoadon = hoa_don::where('idkh',$user_id)->get();
        
        return view('page.lichsu',compact('hoadon'));
    }
    public function postChiTietLichSu(Request $req)
    {
        $hoadon = hoa_don::where('mahoadon',$req['idhoadon'])->get();
        $ve = ve::where('mahoadon',$req['idhoadon'])->get();
        
        $suatchieu = suat_chieu::where([
            ['masuatchieu',$ve->first()->masuatchieu],
        ]);
        $soghe = [];
        foreach($ve as $v){
            $temp = ghe_ngoi::where('maghe',$v->maghe);
            $soghe[] = ($temp->first()->soghe);
        }
         
        $phim = phim::where('maphim',$suatchieu->first()->maphim);
        $rap = rap_chieu::where('marap',$suatchieu->first()->marap);
        $khunggio = khung_gio::where('makhunggio',$suatchieu->first()->makhunggio);
        //dd($suatchieu->first()->);
        return view('page.chitietlichsu',compact('ve','hoadon','phim','rap','soghe','khunggio','suatchieu'));
    }
    public function getPhimDaXem()
    {
        return view('page.phimdaxem');
    }
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
        if (is_null($req['password']) && is_null($req['password_old']) && is_null($req['re_password'])) 
        {
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
                $obj_user->password = Hash::make($req['password']);
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
    // End Nhóm trang thông tin người dùng =============================================

    // Nhóm trang nhân viên

    public function getProfileNhanvien()
    {        
        return view('page.profilenhanvien');
    }

    public function postchangePassNhanvien(Request $req)
    {
        $user_id = Auth::user()->id;                       
        $obj_user = User::find($user_id);

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
            $obj_user->password = Hash::make($req['password']);
            $obj_user->save(); 
            return redirect()->back()->with('success','Đổi mật khẩu/thông tin thành công');
        }
        else
        {
            $obj_user->save();
            return redirect()->back()->with('error','Mật khẩu hiện tại không đúng');
        }
    }

    public function getDieuchinhKhuyenmai()
    {
        $khuyenmai = khuyen_mai::all();     
        return view('page.dieuchinhkhuyenmai',compact('khuyenmai'));
    }

    public function postThemKhuyenmai(Request $req)
    {
        $this->validate($req,
            [
                'tenkm'=>'required',
                'batdau'=>'required|date_format:Y-m-d|after:today',                
                'ketthuc'=>'required|date_format:Y-m-d|after:tomorrow',
                'hinhanh'=>'required|url' 
            ],
            [
                'tenkm.required'=>'Vui lòng nhập tên khuyến mãi! ',                           
                'batdau.required'=>'Vui lòng nhập ngày bắt đầu! ',
                'batdau.data_format'=>"Định dạng sai",
                'batdau.after'=>"Ngày bắt đầu phải sau hôm nay",
                'ketthuc.required'=>'Vui lòng nhập ngày kết thúc! ',
                'ketthuc.data_format'=>"Định dạng sai",
                'ketthuc.after'=>"Ngày kết thúc phải sau ngày mai",
                'hinhanh.required'=>'Vui lòng nhập đường dẫn tới một ảnh mô tả!',
                'hinhanh.url'=>'Định dạng link hình ảnh không đúng'    
            ]);
        
        $obj_user = new khuyen_mai();
        $obj_user->tenkm = $req['tenkm'];
        $obj_user->batdau = $req['batdau'];
        $obj_user->ketthuc = $req['ketthuc'];    
        $obj_user->hinhanh = $req['hinhanh'];       
        $obj_user->mota = $req['mota'];
        $obj_user->save();

        return redirect()->back()->with('success','Thêm thành công');
    }

    public function postSuaKhuyenmai(Request $req)
    {
        $this->validate($req,
            [
                'mtenkm'=>'required',
                'mbatdau'=>'required|date_format:Y-m-d|after:today',                
                'mketthuc'=>'required|date_format:Y-m-d|after:tomorrow',
                'mhinhanh'=>'required|url' 
            ],
            [
                'mtenkm.required'=>'Vui lòng nhập tên khuyến mãi! ',                           
                'mbatdau.required'=>'Vui lòng nhập ngày bắt đầu! ',
                'mbatdau.data_format'=>"Định dạng sai",
                'mbatdau.after'=>"Ngày bắt đầu phải sau hôm nay",
                'mketthuc.required'=>'Vui lòng nhập ngày kết thúc! ',
                'mketthuc.data_format'=>"Định dạng sai",
                'mketthuc.after'=>"Ngày kết thúc phải sau ngày mai",
                'mhinhanh.required'=>'Vui lòng nhập đường dẫn tới một ảnh mô tả!',
                'mhinhanh.url'=>'Định dạng link hình ảnh không đúng'    
            ]);

        $obj_user = khuyen_mai::find($req['mmakm']);

        $obj_user->tenkm = $req['mtenkm'];
        $obj_user->batdau = $req['mbatdau'];
        $obj_user->ketthuc = $req['mketthuc'];    
        $obj_user->hinhanh = $req['mhinhanh'];       
        $obj_user->mota = $req['mmota'];
        $obj_user->save();

        return redirect()->back()->with('success','Điều chỉnh thành công');
    }

    // TODO: put your code into it
    public function postXoaKhuyenmai($idRap)
    {
        $rap = rap_chieu::where('marap',$idRap)->get();
        return view('page.rap',compact('rap'));
    }

    public function getDieuchinhGiave()
    {
        $loaiphong = loai_phong::all();  
        $loaighe = loai_ghe::all();   
        return view('page.dieuchinhgiave',compact('loaiphong','loaighe'));
    }

    public function postThemLoaiphong(Request $req)
    {
        $this->validate($req,
            [
                'tenloai'=>'required',
                'gia'=>'required|numeric|min:45000',                
     
            ],
            [
                'tenloai.required'=>'Vui lòng nhập tên loại phòng mới! ',                           
                'gia.required'=>'Vui lòng nhập giá! ',
                'gia.numeric'=>"Định dạng giá sai",
                'gia.min'=>"Giá phòng không được thấp hơn giá phòng thường",
                  
            ]);
        
        $obj_user = new loai_phong();
        $obj_user->tenloai = $req['tenloai'];
        $obj_user->gia = $req['gia'];
        $obj_user->save();

        return redirect()->back()->with('success','Thêm thành công');
    }

    public function postThemLoaighe(Request $req)
    {
        $this->validate($req,
            [
                'tenloai'=>'required',
                'gia'=>'required|numeric|min:45000',                
     
            ],
            [
                'tenloai.required'=>'Vui lòng nhập tên loại ghế mới! ',                           
                'gia.required'=>'Vui lòng nhập giá! ',
                'gia.numeric'=>"Định dạng giá sai",
                'gia.min'=>"Giá phòng không được thấp hơn giá ghế thường",
                  
            ]);
        
        $obj_user = new loai_ghe();
        $obj_user->tenloai = $req['tenloai'];
        $obj_user->gia = $req['gia'];
        $obj_user->save();

        return redirect()->back()->with('success','Thêm thành công');
    }

    public function postSuaLoaiphong(Request $req)
    {
        $this->validate($req,
            [
                'mtenloai'=>'required',
                'mgia'=>'required|numeric|min:45000',                
     
            ],
            [
                'mtenloai.required'=>'Vui lòng nhập tên loại phòng mới! ',                           
                'mgia.required'=>'Vui lòng nhập giá! ',
                'mgia.numeric'=>"Định dạng giá sai",
                'mgia.min'=>"Giá phòng không được thấp hơn giá phòng thường",
                  
            ]);

        $obj_user = loai_phong::find($req['mid']); // Problem: the 'loai_phong' table doesn't contain id column ???
        $obj_user->tenloai = $req['mtenloai'];
        $obj_user->gia = $req['mgia'];
        
        $obj_user->save();

        return redirect()->back()->with('success','Điều chỉnh thành công');
    }

    // End Nhóm trang nhân viên

    // Trang thông báo lỗi
    public function get404()
    {
        return view('page.404');
    }
    // End trang thông báo lỗi ============================================================
    // Nhóm trang đăng nhập/ đăng kí/ đăng xuất
    public function getDangKy()
    {
        return view('page.dangky');
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
        return redirect()->route('trang-chu')->with('success','Tạo tài khoản thành công, vui lòng đăng nhập lại');
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
        $boolx = false;
        $credentials = array('email'=>$req->email,'password'=>$req->password);
        if (Auth::attempt($credentials))
        {
            $data = $req->session()->all();
            $user = User::where('email',$req['email'])->get();
            
            $nhanvien = nhan_vien::where('idnv',$user[0]->id)->count();
            
            if($nhanvien == 1){
                $boolx = true; 
                return redirect('profilenhanvien')->with('success','Đăng nhập thành công')->with('boolx','true');
            }

            return redirect('/')->with('success','Đăng nhập thành công')->with('boolx','false');
        }
        else
        {
            return redirect('/')->with('error','Đăng nhập thất bại')->with('boolx','false');
        }       
    }
    public function getDangxuat()
    {
        Auth::logout();
        return redirect()->route('trang-chu');
    }
    // End nhóm trang đăng nhập/ đăng kí/ đăng xuất ===============================================================
    // Nhóm trang thuộc vùng footer
    public function getAbout()
    {
        return view('page.about');
    }
    public function contact()
    {
        return view('page.contact');
    }
    public function getFAQ()
    {
        return view('page.faq');
    }
    public function getFAQduy()
    {
        return view('page.faqduy');
    }
    // End nhóm trang thuộc vùng footer ===============================================================
    // Nhóm trang thuộc menu Hệ thống rạp
    public function heThongRap()
    {
        $rap = rap_chieu::all();
        return view('page.hethongrap',compact('rap'));
    }
    public function getRap($idRap)
    {
        $rap = rap_chieu::where('marap',$idRap)->get();
        return view('page.rap',compact('rap'));
    }
    // End nhóm trang thuộc menu Hệ thông rạp ===============================================================
    // Nhóm trang thuộc menu Lịch chiếu
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
    public function getChitiet($idPhim)
    {       
        $phim = phim::where('maphim',$idPhim)->get();
        $dienvien = dien_vien::where('maphim',$idPhim)->get();
        $theloai = the_loai::where('maphim',$idPhim)->get();
        $khuyenmai = khuyen_mai::all();
        return view('page.chitiet',compact('phim','dienvien','theloai','khuyenmai'));
    }
    // End nhóm trang thuộc menu Lịch chiếu ===============================================================
    // Nhóm trang thuộc menu Mua vé
    public function getMuaVeMenu()
    {
        $currentDate = Carbon\Carbon::now()->toDateString();
        $phim = phim::where('batdau','<',$currentDate)->get();
        $rap = rap_chieu::all();
        $khung_gio = khung_gio::all();
        return view('page.chonphimve',compact('phim','rap','khung_gio'));
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
        return view('page.chonsuatchieu',compact('phimDaChon','rapDaChon','kgtungngay'));

    }

    public function postMuaVe(Request $req)
    {
        $loaiphong = phong_chieu::where('marap',$req['idrap'])->get();
        $loaiphongall = loai_phong::all();
        $loaighe = loai_ghe::all();
        $dichvu = dich_vu::all();
        //dd($req);
        $phimDaChon = phim::where('maphim',$req['idphim'])->get();
        $rapDaChon = rap_chieu::where('marap',$req['idrap'])->get();
        $ngay = $req['ngaychieu'];
        $gio = $req['giochieu'];
        return view('page.muave',compact('phimDaChon','rapDaChon','ngay','gio','dichvu','loaiphong','loaighe','loaiphongall') );

    }

    public function postChonGhe(Request $req)
    {
        $dichvu = dich_vu::all();
        $phong = phong_chieu::where([
            ['marap',$req['idrap']],
            ['tenloai',$req['loaiphong']]
        ])->get();
        //dd($req['loaiphong']);
        $tatcaghe = ghe_ngoi::where('maphong',$phong[0]->maphong)->get();
        //dd($tatcaghe);
        $phimDaChon = phim::where('maphim',$req['idphim'])->get();
        $rapDaChon = rap_chieu::where('marap',$req['idrap'])->get();
        $ngay = $req['ngay'];
        $gio = $req['gio'];
        $giaghe = $req['giaghe'];
        $giadv = $req['giadv'];
        $loaiphong = $req['loaiphong'];
        return view('page.chonghe',compact('phimDaChon','loaiphong','rapDaChon','ngay','gio','dichvu','tatcaghe','giaghe','giadv') );

    }

    public function postThanhToan(Request $req)
    {
        //dd($req);
        $currentDate = Carbon\Carbon::now()->toDateString();
        $dichvu = dich_vu::all();
        $phong = phong_chieu::where([
            ['marap',$req['idrap']],
            ['tenloai',$req['loaiphong']]
        ])->get();
        
        $gheso = $req['gheso'];
        $phimDaChon = phim::where('maphim',$req['idphim'])->get();
        $rapDaChon = rap_chieu::where('marap',$req['idrap'])->get();
        $ngay = $req['ngay'];
        $gio = $req['gio'];
        $loaiphong = $req['loaiphong'];
        $tongcong = $req['tongcong'];

        if(Auth::user()){
                //HOA DON
            $user_id = Auth::user()->id;                       
            $obj_user = User::find($user_id);
            $hoadon = new hoa_don();
            
            $hoadon->tongtien = $tongcong;
            $hoadon->ngayxuat = $currentDate;
            $hoadon->idkh = $obj_user->id;
            $hoadon->idnv = 8;
            $hoadon->save();

            $hoadonx = hoa_don::where([
                ['tongtien', $tongcong],
                ['ngayxuat', $currentDate],
                ['idkh', $obj_user->id],
                ['idnv', 8],
            ])->get();
            //VE
            
            $cacghe = explode(",", $gheso);
            //$ve->maghe = $ghe->maghe;
            
            foreach($cacghe as $ghe1){
                $ve = new ve();
                $makg = khung_gio::where('batdau',$gio)->get();
                $ve->ngayxuat = $currentDate;
                $temp = suat_chieu::where([
                    ['ngaychieu', $ngay],
                    ['makhunggio', $makg->first()->makhunggio],
                    ['maphim', $req['idphim']],
                    ['marap',$req['idrap']],
                ])->get();
                $ve->masuatchieu = $temp->first()->masuatchieu;
                $ghe = ghe_ngoi::where([
                    ['maphong',$phong[0]->maphong],
                    ['soghe', $ghe1],
                ])->get();
                $ve->maghe = $ghe->first()->maghe;
                $ve->mahoadon = $hoadonx->first()->mahoadon;
                $ve->save();

                //CAP NHAT TRONG GHE_NGOI
                DB::table('ghe_ngoi')->where('maghe', $ghe->first()->maghe)->update(['tinhtrang'=>1]);
                
            }

            


            return view('page.thanhtoan',compact('phimDaChon','rapDaChon','ngay','gio','dichvu','gheso','tongcong','loaiphong','phong') );

        }else{
            return redirect('/')->with('error','Bạn cần đăng nhập để mua vé');
        }
        
        
        


    }

    // End nhóm trang thuộc menu Mua vé ============================================================

    public function getKhuyenMai(){
        $khuyenmai = khuyen_mai::all();
        return view('page.khuyenmai',compact('khuyenmai'));
    }

}