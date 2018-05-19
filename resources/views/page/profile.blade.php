@extends('master') @section('content')
<div id="heading-breadcrumbs">
    <div class="container">
        <div class="row d-flex align-items-center flex-wrap">
            <div class="col-md-7">
                <h1 class="h2">Tài khoản của tôi</h1>
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

                <div class="bo3">
                    <!-- THONG TIN CA NHAN -->
                    <div class="heading">
                        <h3 class="text-uppercase">Thông tin cá nhân</h3>
                    </div>
                    <form action="{{route('changePersonalData')}}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Họ Tên(*)</label>
                                    <input name="name" id="name" type="text" class="form-control" value="{{Auth::user()->name}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input name="email" id="email" type="text" class="form-control" value="{{Auth::user()->email}}" disabled>
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="ngaysinh">Ngày sinh</label>
                                    <input type="text" name="ngaysinh" id="ngaysinh" class="form-control" onfocus="(this.type='date')" onblur="(this.type='text')" value="{{Auth::user()->ngaysinh}}">                                        
                                </div>
                            </div>

                            <div class="col-md-4 col-lg-2">
                                <div class="form-group">
                                    <label for="gioitinh">Giới tính</label>
                                    <select name="gioitinh" id="gioitinh" class="form-control" required="required">                                            
                                        <option value="1">Nam</option>
                                        <option value="0">Nữ</option>                                           
                                    </select>
                                </div>
                            </div>

                            <script type="text/javascript">                                   
                                var x = document.getElementById("gioitinh");
                                var y = "{{Auth::user()->gioitinh}}";
                                if (y == "1") {
                                    x.selectedIndex = "0";
                                } 
                                else {
                                    x.selectedIndex = "1";
                                }                                    
                            </script>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sodt">Số điện thoại</label><br>
                                    <input type="tel" name="sodt" id="sodt" class="autocomplete form-control" value="{{Auth::user()->sodt}}" >

                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="cmnd">Chứng minh thư</label>
                                    <input name="cmnd" id="cmnd" type="number" class="form-control" value="{{Auth::user()->cmnd}}" disabled>
                                </div>
                            </div>
                        </div>
                        <!-- END THONG TIN CA NHAN -->
                        
                        <!-- MAT KHAU -->    
                        <label>
                            <input id="want" type="checkbox" name="subscribe" onclick="myFunction()" /> Tôi muốn đổi mật khẩu
                        </label>

                        <div class="row" id="changepas" style="display: none;">
                            <div class="col-md-4">
                                <div class="form-group">

                                    <input type="password" name="password_old" id="password_old" class="form-control" placeholder="Mật khẩu hiện tại" disabled>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">

                                    <input type="password" name="password" id="password" class="form-control" placeholder="Mật khẩu mới" disabled>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">

                                    <input type="password" name="re_password" id="re_password" class="form-control" placeholder="Xác nhận lại mật khẩu" disabled>

                                </div>
                            </div>
                        </div>
                        <!-- END MAT KHAU -->

                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-template-outlined"><i class="fa fa-save"></i> Lưu thay đổi</button>
                        </div>

                        <!-- Xac nhan khach hang muon doi mat khau -->
                        <script type="text/javascript">

                            function myFunction() {
                                var x = document.getElementById("changepas");
                                var checkbox = document.getElementById('want');
                                if (checkbox.checked === true) {
                                    x.style.display = "block";
                                    $(":password").attr("disabled",false);
                                }
                                else {
                                    x.style.display = "none";
                                    $(":password").attr("disabled",true);
                                }
                            }
                        </script>
                    </form>
                </div>

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
                                <a class="nav-link active">
                                    <i class="fa fa-user"></i> Thông tin cá nhân</a>
                                </li>
                                
                                <li class="nav-item">
                                    <a href="{{route('lich-su')}}" class="nav-link">
                                        <i class="fa fa-list"></i> Lịch sử giao dịch</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('phim-da-xem')}}" class="nav-link">
                                            <i class="fa fa-heart"></i> Phim đã xem</a>
                                        </li>


                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endsection