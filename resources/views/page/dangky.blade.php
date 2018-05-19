@extends('master') @section('content')

<div id="heading-breadcrumbs">
    <div class="container">
        <div class="row d-flex align-items-center flex-wrap">
            <div class="col-md-7">
                <h1 class="h2">Đăng kí tài khoản mới</h1>
            </div>
            <div class="col-md-5">
                <ul class="breadcrumb d-flex justify-content-end">
                    <li class="breadcrumb-item">
                        <a href="#">Trang chủ</a>
                    </li>
                    <li class="breadcrumb-item active">Đăng kí</li>
                </ul>
            </div>
        </div>
    </div>
</div>

@if(count($errors) > 0) @foreach($errors->all() as $err)

<div role="alert" class=" alert alert-danger">
    {{$err}}
    <br>
</div>
@endforeach @endif @if(Session::has('thanhcong'))
<div role="alert" class="alert alert-success">{{Session::get('thanhcong')}}</div>
@endif

<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-9">
                <div class="box">   
                    <!-- Form đăng kí -->
                    <form action="{{route('dang-ky')}}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <!-- Thông tin đăng nhập -->
                        <div class="row">

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="email">Email (*)</label>
                                    <input name="email" type="text" class="form-control" placeholder="Dùng để đăng nhập vào hệ thống">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="password">Mật khẩu (*)</label>
                                    <input name="password" type="password" class="form-control" placeholder="Độ dài hợp lệ từ 6 tới 20 kí tự">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="re_password">Nhập lại mật khẩu (*)</label>
                                    <input name="re_password" type="password" class="form-control">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <!-- End Thông tin đăng nhập -->
                        <!-- Thông tin cá nhân -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="name">Họ và tên</label>
                                    <input name="name" type="text" id="name" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="ngaysinh">Ngày sinh</label>
                                    <input name="ngaysinh" type="date" id="ngaysinh" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="gioitinh">Giới tính</label>
                                    <select name="gioitinh" id="gioitinh" class="form-control">
                                        
                                        <option value="1" selected>Nam</option>
                                        <option value="0">Nữ</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="sodt">Số điện thoại</label>
                                    <input name="sodt" type="tel" id="sodt" class="form-control" placeholder="+84">
                                </div>
                            </div>
                            
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="cmnd">Chứng minh thư</label>
                                    <input name="cmnd" id="cmnd" type="number" class="form-control" placeholder="Xin nhập đúng chứng minh thư">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="agree">Chấp nhận điều khoản sử dụng dịch vụ</label>
                                    <br>
                                    <input type="checkbox" name="agree" id="argree" /> Tôi đã đọc, hiểu và đồng ý với các
                                    <strong>
                                        <a href="faq">điều khoản</a> và 
                                    </strong>
                                    <strong>
                                        <a href="faq">chính sách bảo mật</a>  của chúng tôi.
                                    </strong>
                                </div>
                            </div>
                            <!-- End Thông tin cá nhân  -->
                        </div>

                        <div class="text-center" align="center">
                            <button type="submit" class="btn btn-template-outlined">
                                <i class="fa fa-user-md"></i> Đăng ký
                            </button>
                        </div>

                    </form>
                    <!-- End form đăng kí -->
                </div>
            </div>

        </div>
    </div>
</div>
@endsection