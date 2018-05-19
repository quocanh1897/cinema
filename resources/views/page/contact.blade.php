@extends('master') 
@section('content')

<div id="heading-breadcrumbs" class="brder-top-0 border-bottom-0">
    <div class="container">
        <div class="row d-flex align-items-center flex-wrap">
            <div class="col-md-7">
                <h1 class="h2">Liên hệ</h1>
            </div>
            <div class="col-md-5">
                <ul class="breadcrumb d-flex justify-content-end">
                    <li class="breadcrumb-item">
                        <a href="#">Trang chủ</a>
                    </li>
                    <li class="breadcrumb-item active">Liên hệ</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div id="content">
    <div id="contact" class="container">
        <section class="bar">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading">
                        <h2>Mọi thắc mắc xin vui lòng liên hệ tại:</h2>
                    </div>     
                </div>
            </div>
        </section>
        <section>
            <div class="row text-center">
                <div class="col-md-4">
                    <div class="box-simple">
                        <div class="icon-outlined">
                            <i class="fa fa-map-marker"></i>
                        </div>
                        <h3 class="h4">địa chỉ</h3>
                        <p>
                            Nhà A3, trường Đại học Bách Khoa, đường Lý Thường Kiệt, quận 10, thành phố Hồ Chí Minh
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box-simple">
                        <div class="icon-outlined">
                            <i class="fa fa-phone"></i>
                        </div>
                        <h3 class="h4">tổng đài</h3>
                        <p>Tổng đài online 24/24<br>
                        
                            <strong>01639 876 888</strong>
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box-simple">
                        <div class="icon-outlined">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <h3 class="h4">Hộp thư</h3>
                        <p>
                            Hệ thống tiếp nhận phản hồi khách hàng<br>
                            <a href="mailto:"><strong>bkCinema@gmail.com</strong></a>   
                        </p>
                        
                    </div>
                </div>
            </div>
        </section>
 
    </div>
 
</div>

@endsection