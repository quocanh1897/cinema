@extends('master') @section('content')

<div id="heading-breadcrumbs">
    <div class="container">
        <div class="row d-flex align-items-center flex-wrap">
            <div class="col-md-7">
                <h1 class="h2">New Account / Sign In</h1>
            </div>
            <div class="col-md-5">
                <ul class="breadcrumb d-flex justify-content-end">
                    <li class="breadcrumb-item">
                        <a href="index.html">Home</a>
                    </li>
                    <li class="breadcrumb-item active">New Account / Sign In</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="box">
                    <h2 class="text-uppercase">New account</h2>
                    <p class="lead">Not our registered customer yet?</p>
                    <p>With registration with us new world of fashion, fantastic discounts and much more opens to you! The whole
                        process will not take you more than a minute!</p>
                    <p class="text-muted">If you have any questions, please feel free to
                        <a href="contact.html">contact us</a>, our customer service center is working for you 24/7.</p>
                    <hr>
                    <form action="customer-orders.html" method="get">
                        <div class="form-group">
                            <label for="name-login">Name</label>
                            <input id="name-login" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email-login">Email</label>
                            <input id="email-login" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password-login">Password</label>
                            <input id="password-login" type="password" class="form-control">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-template-outlined">
                                <i class="fa fa-user-md"></i> Register</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="box">
                    <h2 class="text-uppercase">Login</h2>
                    <p class="lead">Already our customer?</p>
                    <p class="text-muted">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum
                        tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam
                        egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
                    <hr>
                    <form action="customer-orders.html" method="get">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input id="password" type="password" class="form-control">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-template-outlined">
                                <i class="fa fa-sign-in"></i> Log in</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection