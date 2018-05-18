@extends('master') @section('content')
<div id="heading-breadcrumbs">
    <div class="container">
        <div class="row d-flex align-items-center flex-wrap">
            <div class="col-md-7">
                <h1 class="h2">Tài khoản của tôi</h1>
            </div>
            <div class="col-md-5">
                <ul class="breadcrumb d-flex justify-content-end">
                    <li class="breadcrumb-item">
                        <a href="index.html">Trang chủ</a>
                    </li>
                    <li class="breadcrumb-item active">Tài khoản</li>
                </ul>
            </div>
        </div>
    </div>
</div>

@if(count($errors) > 0)

@foreach($errors->all() as $err)
<div role="alert" class=" alert alert-danger">
 {{$err}}
 <br>   
</div>
@endforeach

@endif

@if(Session::has('flag'))
<div role="alert" class="alert alert-{{Session::get('flag')}} alert-dismissible">
    <button type="button" data-dismiss="alert" class="close">
        <span aria-hidden="true">×</span>
        <span class="sr-only">Đóng</span>
    </button>{{Session::get('mes')}}
</div>
@endif

<div id="content">
    <div class="container">
        <div class="row bar">
            <div id="customer-account" class="col-lg-9 clearfix">
                <!-- THONG TIN CA NHAN -->
                <!-- <div class="card card-primary">
                    <div id="headingTwo" role="tab" class="heading">

                        <a data-toggle="collapse" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">


                            <h3 class="text-uppercase">Thông tin cá nhân</h3>


                        </a>

                    </div>
                    <div id="collapseTwo" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion" class="collapse show">
                        <div class="card-body">
                            <form action="{{route('changePersonalData')}}" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}"> 

                                <div class="row">        
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="firstname">Họ Tên</label>
                                            <input name="hoten" id="firstname" type="text" class="form-control" placeholder="{{Auth::user()->name}} ">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="gioitinh">Giới tính</label>
                                            <select name="gioitinh" id="state" class="form-control">
                                                <option value="{{Auth::user()->gioitinh}}" disabled selected hidden> {{Auth::user()->gioitinh}} </option>    
                                                <option value="Nam">Nam</option>
                                                <option value="Nữ">Nữ</option>
                                                <option value="Khác">Khác</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="ngaysinh">Ngày sinh</label><br>
                                            <input type="date" name="ngaysinh" class="form-control" onfocus="(this.type='date')" onblur="(this.type='text')" placeholder="{{Auth::user()->ngaysinh}}">                                        
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="company">Email</label>
                                            <input name="email" id="company" type="text" class="form-control" placeholder="{{Auth::user()->email}}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="company">Phone</label><br>
                                            <input type="text" class="autocomplete form-control" value="{{Auth::user()->phone}} " >

                                        </div>
                                    </div>

                                </div>
                                <div class="row">


                                    <div class="col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="state">Quốc gia</label>
                                            <select id="state" class="form-control" placeholder="{{Auth::user()->quocgia}}">
                                                <option value="{{Auth::user()->gioitinh}}" disabled selected hidden> {{Auth::user()->gioitinh}} </option> 
                                                <option value="Việt Nam">Việt Nam</option>
                                                <option value="Nước ngoài">Nước ngoài (others)</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="address">Địa chỉ</label>
                                            <input id="address" type="text" class="form-control" placeholder="{{Auth::user()->diachi}}">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-template-outlined">
                                            <i class="fa fa-save"></i> Lưu thay đổi</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div> -->
                    <!-- END THONG TIN CA NHAN -->

                    <div class="bo3">
                        <div class="heading">
                            <h3 class="text-uppercase">Thông tin cá nhân</h3>
                        </div>
                        <form action="{{route('changePersonalData')}}" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="hoten">Họ Tên(*)</label>
                                        <input name="hoten" id="hoten" type="text" class="form-control" placeholder="{{Auth::user()->name}}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="ngaysinh">Ngày sinh</label><br>
                                        <input type="text" name="ngaysinh" id="ngaysinh" class="form-control" onfocus="(this.type='date')" onblur="(this.type='text')" placeholder="{{Auth::user()->ngaysinh}}">                                        
                                    </div>
                                </div>

                                <div class="col-md-4 col-lg-2">
                                    <div class="form-group">
                                        <label for="gioitinh">Giới tính</label>
                                        <select name="gioitinh" id="gioitinh" class="form-control" required="required">
                                            <option selected="selected" disabled selected hidden>Chọn</option>    
                                            <option value="1">Nam</option>
                                            <option value="0">Nữ</option>
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Số điện thoại</label><br>
                                        <input type="text" name="sodt" id="phone" class="autocomplete form-control" placeholder="{{Auth::user()->sodt}}" value="{{Auth::user()->phone}} " >

                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cmnd">Chứng minh thư</label>
                                        <input name="cmnd" id="cmnd" type="text" class="form-control" placeholder="{{Auth::user()->cmnd}}" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-template-outlined"><i class="fa fa-save"></i> Lưu thay đổi</button>
                            </div>
                        </form>
                    </div>



                    <!-- DOI MAT KHAU -->
                <!-- <div class="card card-primary">
                    <div id="headingOne" role="tab" class="heading">

                        <a data-toggle="collapse" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            <div class="heading">
                                <h3 class="text-uppercase">Đổi mật khẩu</h3>
                            </div>
                        </a>

                    </div>
                    <div id="collapseOne" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion" class="collapse ">
                        <div class="card-body">
                            <form action="{{route('changepass')}}" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password_old">Mật khẩu cũ</label>
                                            <input name="password_old" id="password_old" type="password" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password_1">Mật khẩu mới</label>
                                            <input name="password" id="password_1" type="password" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password_2">Gõ lại mật khẩu mới</label>
                                            <input name="re_password" id="password_2" type="password" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-template-outlined">
                                        <i class="fa fa-save"></i> Lưu thay đổi</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div> -->
                    <!-- END DOI MAT KHAU -->
                </div>
                <div class="col-lg-3 mt-4 mt-lg-0">
                    <!-- CUSTOMER MENU -->
                    <div class="panel panel-default sidebar-menu">
                        <div class="panel-heading">
                            <h3 class="h4 panel-title">Khách hàng</h3>
                        </div>
                        <div class="panel-body">
                            <ul class="nav nav-pills flex-column text-sm">
                                <li class="nav-item">
                                    <a href="{{route('lich-su')}}" class="nav-link">
                                        <i class="fa fa-list"></i> Lịch sử giao dịch</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('phim-da-xem')}}" class="nav-link">
                                            <i class="fa fa-heart"></i> Phim đã xem</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link active">
                                                <i class="fa fa-user"></i> Cài đặt</a>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endsection