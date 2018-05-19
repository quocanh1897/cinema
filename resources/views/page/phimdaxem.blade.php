@extends('master') @section('content')

<div id="heading-breadcrumbs">
  <div class="container">
    <div class="row d-flex align-items-center flex-wrap">
      <div class="col-md-7">
        <h1 class="h2">Phim đã xem</h1>
      </div>
      <div class="col-md-5">
        <ul class="breadcrumb d-flex justify-content-end">
          <li class="breadcrumb-item">
            <a href="#">Trang chủ</a>
          </li>
          <li class="breadcrumb-item active">
            <a href="profile">Tài khoản</a>
          </li>
          <li class="breadcrumb-item">
            Phim đã xem
          </li>
        </ul>
      </div> 
    </div>
  </div>
</div>

<div id="content">
  <div class="container">
    <div class="row bar">
      <div class="col-lg-9">
        <p class="lead">Bạn đã xem <strong>n</strong> phim.</p>
        <!-- danh sách phim đã xem -->
        <div class="row products">
          <!-- phim 1 -->
          <div class="col-lg-3 col-md-4">
            <div class="product">
              <div class="image"><a href="shop-detail.html"><img src="sources/img/product1.jpg" alt="" class="img-fluid image1"></a></div>
              <div class="text">
                <h4 class="h6"><a href="shop-detail.html">Naruto Shippuden <br>(1 lần)</a></h4>              
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-4">
            <div class="product">
              <div class="image"><a href="shop-detail.html"><img src="sources/img/product1.jpg" alt="" class="img-fluid image1"></a></div>
              <div class="text">
                <h4 class="h6"><a href="shop-detail.html">Naruto Shippuden <br>(1 lần)</a></h4>              
              </div>
              <div class="ribbon-holder">
                <div class="ribbon hot">HOT</div>
                <div class="ribbon newduy">NEW</div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-4">
            <div class="product">
              <div class="image"><a href="shop-detail.html"><img src="sources/img/product1.jpg" alt="" class="img-fluid image1"></a></div>
              <div class="text">
                <h4 class="h6"><a href="shop-detail.html">Naruto Shippuden <br>(1 lần)</a></h4>              
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-4">
            <div class="product">
              <div class="image"><a href="shop-detail.html"><img src="sources/img/product1.jpg" alt="" class="img-fluid image1"></a></div>
              <div class="text">
                <h4 class="h6"><a href="shop-detail.html">Naruto Shippuden <br>(1 lần)</a></h4>              
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-4">
            <div class="product">
              <div class="image"><a href="shop-detail.html"><img src="sources/img/product1.jpg" alt="" class="img-fluid image1"></a></div>
              <div class="text">
                <h4 class="h6"><a href="shop-detail.html">Naruto Shippuden <br>(1 lần)</a></h4>              
              </div>
              <div class="ribbon-holder">
                
                <div class="ribbon newduy">NEW</div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-4">
            <div class="product">
              <div class="image"><a href="shop-detail.html"><img src="sources/img/product1.jpg" alt="" class="img-fluid image1"></a></div>
              <div class="text">
                <h4 class="h6"><a href="shop-detail.html">Naruto Shippuden <br>(1 lần)</a></h4>              
              </div>
              <div class="ribbon-holder">
                <div class="ribbon newduy">NEW</div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-4">
            <div class="product">
              <div class="image"><a href="shop-detail.html"><img src="sources/img/product1.jpg" alt="" class="img-fluid image1"></a></div>
              <div class="text">
                <h4 class="h6"><a href="shop-detail.html">Naruto Shippuden <br>(1 lần)</a></h4>              
              </div>
              <div class="ribbon-holder">
                <div class="ribbon newduy">NEW</div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-4">
            <div class="product">
              <div class="image"><a href="shop-detail.html"><img src="sources/img/product1.jpg" alt="" class="img-fluid image1"></a></div>
              <div class="text">
                <h4 class="h6"><a href="shop-detail.html">Naruto Shippuden <br>(1 lần)</a></h4>              
              </div>
            </div>
          </div>
        </div>

        <div class="pages">
          <p class="loadMore text-center"><a href="#" class="btn btn-template-outlined"><i class="fa fa-chevron-down"></i> Load more</a></p>
          <nav aria-label="Page navigation example" class="d-flex justify-content-center">
            <ul class="pagination">
              <li class="page-item"><a href="#" class="page-link"> <i class="fa fa-angle-double-left"></i></a></li>
              <li class="page-item active"><a href="#" class="page-link">1</a></li>
              <li class="page-item"><a href="#" class="page-link">2</a></li>
              <li class="page-item"><a href="#" class="page-link">3</a></li>
              <li class="page-item"><a href="#" class="page-link">4</a></li>
              <li class="page-item"><a href="#" class="page-link">5</a></li>
              <li class="page-item"><a href="#" class="page-link"><i class="fa fa-angle-double-right"></i></a></li>
            </ul>
          </nav>
        </div>

      </div>
      <div class="col-lg-3 mt-4 mt-lg-0">

       <div class="panel panel-default sidebar-menu">
        <div class="panel-heading">
          <h3 class="h4 panel-title">Khách hàng</h3>
        </div>
        <div class="panel-body">
          <ul class="nav nav-pills flex-column text-sm">
            <li class="nav-item">
              <a href="{{route('profile')}}" class="nav-link">
                <i class="fa fa-user"></i> Thông tin cá nhân</a>
              </li>
              <li class="nav-item">
                <a href="{{route('lich-su')}}" class="nav-link">
                  <i class="fa fa-list"></i> Lịch sử giao dịch</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active">
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