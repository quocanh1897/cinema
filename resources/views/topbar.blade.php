<!-- Top bar    -->
<div class="top-bar">
    <div class="container">
        <div class="row d-flex align-items-center">
            <div class="col-md-6 d-md-block d-none">
                <p></p>
            </div>
            <div class="col-md-6">
                <div class="d-flex justify-content-md-end justify-content-between">
                    

                    @if(Auth::check())

                    <div class="login">
                        <a >Xin chào {{Auth::user()->name}},   </a>
                        <a ></a>
                        <a href="profile" class="profile-btn">
                            <i class="fa fa-user"></i>
                            <span class="d-none d-md-inline-block">Tài khoản</span>
                        </a>
                        <a href="{{route('dang-xuat')}}" class="signout-btn">
                            <i class="fa fa-sign-out"></i>
                            <span class="d-none d-md-inline-block">Đăng xuất</span>
                        </a>
                    </div>



                    @else

                    <div class="login">
                        <a href="" data-toggle="modal" data-target="#login-modal" class="login-btn">
                            <i class="fa fa-sign-in"></i>
                            <span class="d-none d-md-inline-block">Đăng nhập</span>
                        </a>
                        <a href="dang-ky" class="signup-btn">
                            <i class="fa fa-user"></i>
                            <span class="d-none d-md-inline-block">Đăng ký</span>
                        </a>
                    </div>

                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Top bar end-->
<!-- Login Modal-->
<div id="login-modal" tabindex="-1" role="dialog" aria-labelledby="login-modalLabel" aria-hidden="true" class="modal fade">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="login-modalLabel" class="modal-title">ĐĂNG NHẬP</h4>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="{{route('dang-nhap')}}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <input name="email" id="email_modal" type="text" placeholder="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <input name="password" id="password_modal" type="password" placeholder="password" class="form-control">
                    </div>
                    <p class="text-center">
                        <button type="submit" class="btn btn-template-outlined">
                            <i class="fa fa-sign-in"></i>Đăng nhập</button>
                    </p>
                </form>
                <p class="text-center text-muted">Chưa có tài khoản?</p>
                <p class="text-center text-muted">
                    <a href="{{route('dang-ky')}}">
                        <strong>Đăng ký ngay!</strong>
                    </a>Trở thành thành viên để nhận được ưu đãi hấp dẫn!</p>
            </div>
        </div>
    </div>
</div>
<!-- Login modal end-->