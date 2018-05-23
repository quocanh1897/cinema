<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Trang chủ 

Route::get('/', [
    'uses'=>'PageController@getIndex'
]);

Route::get('index',[
    'as'=>'trang-chu',
    'uses'=>'PageController@getIndex'
]);

// End trang chủ ============================================================

// Nhóm trang thông tin khách hàng

Route::get('profile',[
    'as'=>'profile',
    'uses'=>'PageController@getProfile'
]);

Route::get('lich-su',[
    'as'=>'lich-su',
    'uses'=>'PageController@getLichSu'
]);

Route::post('chi-tiet-lich-su',[
    'as'=>'chi-tiet-lich-su',
    'uses'=>'PageController@postChiTietLichSu'
]);

Route::get('phim-da-xem',[
    'as'=>'phim-da-xem',
    'uses'=>'PageController@getPhimDaXem'
]);

Route::post('changePersonalData',[
    'as'=>'changePersonalData',
    'uses'=>'PageController@postchangePersonalData'
]);

// End Nhóm trang thông tin người dùng =============================================

// Nhóm trang nhân viên

// 1. Thông tin nhân viên
Route::get('profilenhanvien',[
    'as'=>'profilenhanvien',
    'uses'=>'PageController@getProfileNhanvien'
]);

Route::post('changePassNhanvien',[
    'as'=>'changePassNhanvien',
    'uses'=>'PageController@postchangePassNhanvien'
]);
// 2. Thông tin khuyến mãi
Route::get('dieuchinhkhuyenmai',[
    'as'=>'dieuchinhkhuyenmai',
    'uses'=>'PageController@getDieuchinhKhuyenmai'
]);

Route::post('themKhuyenmai',[
    'as'=>'themKhuyenmai',
    'uses'=>'PageController@postThemKhuyenmai'
]);

Route::post('suaKhuyenmai',[
    'as'=>'suaKhuyenmai',
    'uses'=>'PageController@postSuaKhuyenmai'
]);

Route::post('xoaKhuyenmai',[
    'as'=>'xoaKhuyenmai',
    'uses'=>'PageController@postXoaKhuyenmai'
]);
// 3. Thông tin giá vé
Route::get('dieuchinhgiave',[
    'as'=>'dieuchinhgiave',
    'uses'=>'PageController@getDieuchinhGiave'
]);

Route::post('themLoaiphong',[
    'as'=>'themLoaiphong',
    'uses'=>'PageController@postThemLoaiphong'
]);

Route::post('themLoaighe',[
    'as'=>'themLoaighe',
    'uses'=>'PageController@postThemLoaighe'
]);

Route::post('suaLoaiphong',[
    'as'=>'suaLoaiphong',
    'uses'=>'PageController@postSuaLoaiphong'
]);

// 4. Thông tin dịch vụ
Route::get('dieuchinhdv',[
    'as'=>'dieuchinhdv',
    'uses'=>'PageController@getDieuChinhDv'
]);

Route::post('themDv',[
    'as'=>'themDv',
    'uses'=>'PageController@postThemDv'
]);

Route::post('suaDv',[
    'as'=>'suaDv',
    'uses'=>'PageController@postSuaDv'
]);

Route::post('xoaDv',[
    'as'=>'xoaDv',
    'uses'=>'PageController@postXoaDv'
]);
// End Nhóm trang nhân viên

// Trang thông báo lỗi

Route::get('404',[
    'as'=>'404',
    'uses'=>'PageController@get404'
]);

// End trang thông báo lỗi ============================================================

// Nhóm trang đăng nhập/ đăng kí/ đăng xuất

Route::get('dang-ky',[
    'as'=>'dang-ky',
    'uses'=>'PageController@getDangKy'
]);

Route::post('dang-ky',[
    'as'=>'dang-ky',
    'uses'=>'PageController@postSignup'
]);

Route::post('dang-nhap',[
    'as'=>'dang-nhap',
    'uses'=>'PageController@postSignin'
]);

Route::get('dang-xuat',[
    'as'=>'dang-xuat',
    'uses'=>'PageController@getDangxuat'
]);

// End nhóm trang đăng nhập/ đăng kí/ đăng xuất ===============================================================

// Nhóm trang thuộc vùng footer

Route::get('about',[
    'as'=>'about',
    'uses'=>'PageController@getAbout'
]);

Route::get('contact',[
    'as'=>'contact',
    'uses'=>'PageController@contact'
]);

Route::get('faq',[
    'as'=>'faq',
    'uses'=>'PageController@getFAQ'
]);

Route::get('faqduy',[
    'as'=>'faqduy',
    'uses'=>'PageController@getFAQduy'
]);

// End nhóm trang thuộc vùng footer ===============================================================

// Nhóm trang thuộc menu Hệ thống rạp

Route::get('he-thong-rap',[
    'as'=>'he-thong-rap',
    'uses'=>'PageController@heThongRap'
]);

Route::get('rap/{id}',[
    'as'=>'rap',
    'uses'=>'PageController@getRap'
]);

// End nhóm trang thuộc menu Hệ thông rạp ===============================================================

// Nhóm trang thuộc menu Lịch chiếu

Route::get('phim-dang-chieu',[
    'as'=>'phim-dang-chieu',
    'uses'=>'PageController@phimDangChieu'
]);

Route::get('phim-sap-chieu',[
    'as'=>'phim-sap-chieu',
    'uses'=>'PageController@phimSapChieu'
]);

Route::get('chi-tiet/{id}',[
    'as'=>'chi-tiet',
    'uses'=>'PageController@getChitiet'
]);

// End nhóm trang thuộc menu Lịch chiếu ===============================================================

// Nhóm trang thuộc menu Mua vé

Route::post('mua-ve',[
    'as'=>'mua-ve',
    'uses'=>'PageController@postMuaVe'
]);

Route::get('mua-ve-menu',[
    'as'=>'mua-ve-menu',
    'uses'=>'PageController@getMuaVeMenu'
]);

// End nhóm trang thuộc menu Mua vé ============================================================



Route::post('chon-phim',[
    'as'=>'chon-phim',
    'uses'=>'PageController@postChonPhim'
]);

Route::post('chon-rap',[
    'as'=>'chon-rap',
    'uses'=>'PageController@postChonRap'
]);

Route::post('chon-suat-chieu',[
    'as'=>'chon-suat-chieu',
    'uses'=>'PageController@postChonSuatChieu'
]);

Route::post('chon-ghe',[
    'as'=>'chon-ghe',
    'uses'=>'PageController@postChonGhe'
]);

Route::post('thanhtoan',[
    'as'=>'thanhtoan',
    'uses'=>'PageController@postThanhToan'
]);


Route::get('khuyen-mai',[
    'as'=>'khuyen-mai',
    'uses'=>'PageController@getKhuyenMai'
]);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
