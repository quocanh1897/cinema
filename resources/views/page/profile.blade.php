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



<div id="content">
    <div class="container">
        <div class="row bar">
            <div id="customer-account" class="col-lg-9 clearfix">

                <div class="card card-primary">
                    <div id="headingTwo" role="tab" class="heading">

                        <a data-toggle="collapse" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">


                            <h3 class="text-uppercase">Personal details</h3>


                        </a>

                    </div>
                    <div id="collapseTwo" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion" class="collapse show">
                        <div class="card-body">
                            <form>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="firstname">Firstname</label>
                                            <input id="firstname" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="lastname">Lastname</label>
                                            <input id="lastname" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="company">Company</label>
                                            <input id="company" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="street">Street</label>
                                            <input id="street" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-lg-3">
                                        <div class="form-group">
                                            <label for="city">Company</label>
                                            <input id="city" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-3">
                                        <div class="form-group">
                                            <label for="zip">ZIP</label>
                                            <input id="zip" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-3">
                                        <div class="form-group">
                                            <label for="state">State</label>
                                            <select id="state" class="form-control"></select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-3">
                                        <div class="form-group">
                                            <label for="country">Country</label>
                                            <select id="country" class="form-control"></select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone">Telephone</label>
                                            <input id="phone" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email_account">Email</label>
                                            <input id="email_account" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-template-outlined">
                                            <i class="fa fa-save"></i> Save changes</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

                <div class="card card-primary">
                    <div id="headingOne" role="tab" class="heading">

                        <a data-toggle="collapse" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            <div class="heading">
                                <h3 class="text-uppercase">Change password</h3>
                            </div>
                        </a>

                    </div>
                    <div id="collapseOne" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion" class="collapse ">
                        <div class="card-body">
                            <form>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password_old">Old password</label>
                                            <input id="password_old" type="password" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password_1">New password</label>
                                            <input id="password_1" type="password" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password_2">Retype new password</label>
                                            <input id="password_2" type="password" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-template-outlined">
                                        <i class="fa fa-save"></i> Save new password</button>
                                </div>
                            </form>

                        </div>
                    </div>
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
                                <a href="{{route('lich-su')}}" class="nav-link">
                                    <i class="fa fa-list"></i> Lịch sử giao dịch</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('phim-da-xem')}}" class="nav-link">
                                    <i class="fa fa-heart"></i> Phim đã xem</a>
                            </li>
                            <li class="nav-item">
                                <a  class="nav-link active">
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