@extends('master') @section('content')

<div id="heading-breadcrumbs">
        <div class="container">
          <div class="row d-flex align-items-center flex-wrap">
            <div class="col-md-7">
              <h1 class="h2">Tên phim</h1>
            </div>
            <div class="col-md-5">
              <ul class="breadcrumb d-flex justify-content-end">
                <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="#">Phim</a></li>
                <li class="breadcrumb-item active">Tên phim</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div id="content">
        <div class="container">
          <div class="row bar">
            <!-- LEFT COLUMN _________________________________________________________-->
            <div class="col-lg-18">
              <p class="lead"><b>Nội dung phim:</b> Ngày xửa ngày xưa ... cái kết có hậu.</p>
              <div id="productMain" class="row">
                <div class="col-sm-4">
                    <div> <img src="sources/img/detailbig1.jpg" alt="" class="img-fluid"></div>
                    <p class="text-center">
                        <a href="#" class="btn btn-template-main">Đặt vé ngay</a>
                    </p>
                </div>
                <div class="col-sm-8">
                    <div id="details" class="box mb-4 mt-4">
                      <h4>Đạo diễn</h4>
                      <p style="padding-left: 1.8em">Người 0</p>
                      <h4>Diễn viên</h4>
                      <p style="padding-left: 1.8em">Người 1, Người 2, Người 3</p>
                      <h4>Thể loại</h4>
                      <p style="padding-left: 1.8em">Kinh dị</p>
                      <h4>Ngày khởi chiếu</h4>
                      <p style="padding-left: 1.8em">16/8/2018</p>
                      <h4>Thời lượng</h4>
                      <p style="padding-left: 1.8em">150 phút</p>
                      <h4>Đối tượng</h4>
                      <p style="padding-left: 1.8em">15+</p>
                    </div>
                  
                </div>
              </div>
              
              <div id="product-social" class="box social text-center mb-5 mt-5">
                <h4 class="heading-light">Chia sẻ với bạn bè</h4>
                <ul class="social list-inline">
                  <li class="list-inline-item"><a href="#" data-animate-hover="pulse" class="external facebook"><i class="fa fa-facebook"></i></a></li>
                  <li class="list-inline-item"><a href="#" data-animate-hover="pulse" class="external gplus"><i class="fa fa-google-plus"></i></a></li>
                  <li class="list-inline-item"><a href="#" data-animate-hover="pulse" class="external twitter"><i class="fa fa-twitter"></i></a></li>
                  <li class="list-inline-item"><a href="#" data-animate-hover="pulse" class="email"><i class="fa fa-envelope"></i></a></li>
                </ul>
              </div>
              <div class="row">
                <div class="col-lg-2 col-md-6">
                  <div class="box text-uppercase mt-0 mb-small">
                    <h3>Có thể bạn quan tâm</h3>
                  </div>
                </div>
                <div class="col-lg-2 col-md-6">
                  <div class="product">
                    <div class="image"><a href="#"><img src="sources/img/product2.jpg" alt="" class="img-fluid image1"></a></div>
                  </div>
                </div>
                <div class="col-lg-2 col-md-6">
                  <div class="product">
                    <div class="image"><a href="#"><img src="sources/img/product3.jpg" alt="" class="img-fluid image1"></a></div>
                  </div>
                </div>
                <div class="col-lg-2 col-md-6">
                  <div class="product">
                    <div class="image"><a href="#"><img src="sources/img/product1.jpg" alt="" class="img-fluid image1"></a></div>
                  </div>
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>
</div>      

@endsection