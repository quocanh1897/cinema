@extends('master') @section('content')

<div id="heading-breadcrumbs">
    <div class="container">
        <div class="row d-flex align-items-center flex-wrap">
            <div class="col-md-7">
                <h1 class="h2">Đăng ký tài khoản mới</h1>
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

@if(Session::has('thanhcong'))
    <div role="alert" class="alert alert-success">{{Session::get('thanhcong')}}</div>
@endif

<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-9">
                <div class="box">
                    <h2 class="text-uppercase">New account</h2>
                    <p class="lead">Not our registered customer yet?</p>
                    <p>With registration with us new world of fashion, fantastic discounts and much more opens to you! The whole
                        process will not take you more than a minute!</p>
                    <p class="text-muted">If you have any questions, please feel free to
                        <a href="contact">contact us</a>, our customer service center is working for you 24/7.</p>
                    <hr>
                    <form action="{{route('dang-ky')}}" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input name="name" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input name="email" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password">Mật khẩu</label>
                            <input name="password" type="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="re_password">Nhập lại mật khẩu</label>
                            <input name="re_password" type="password" class="form-control">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-template-outlined">
                                <i class="fa fa-user-md"></i>Đăng ký
                            </button>
                        </div>
                    </form>
                </div>
            </div>
             
        </div>
    </div>
</div>
@endsection