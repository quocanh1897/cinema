@extends('master') @section('content')

      <div id="heading-breadcrumbs">
        <div class="container">
          <div class="row d-flex align-items-center flex-wrap">
            <div class="col-md-7">
              <h1 class="h2">My Wishlist</h1>
            </div>
             
          </div>
        </div>
      </div>
      <div id="content">
        <div class="container">
          <div class="row bar">
            <div class="col-lg-9">
              <p class="lead">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
              <div class="row products">
                <div class="col-lg-3 col-md-4">
                  <div class="product">
                    <div class="image"><a href="shop-detail.html"><img src="img/product1.jpg" alt="" class="img-fluid image1"></a></div>
                    <div class="text">
                      <h3 class="h5"><a href="shop-detail.html">Fur coat with very but very very long name</a></h3>
                      <p class="price">$143.00</p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-4">
                  <div class="product">
                    <div class="image"><a href="shop-detail.html"><img src="img/product2.jpg" alt="" class="img-fluid image1"></a></div>
                    <div class="text">
                      <h3 class="h5"><a href="shop-detail.html">White Blouse Armani</a></h3>
                      <p class="price">
                        <del>$280</del> $143.00
                      </p>
                    </div>
                    <div class="ribbon-holder">
                      <div class="ribbon sale">SALE</div>
                      <div class="ribbon new">NEW</div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-4">
                  <div class="product">
                    <div class="image"><a href="shop-detail.html"><img src="img/product3.jpg" alt="" class="img-fluid image1"></a></div>
                    <div class="text">
                      <h3 class="h5"><a href="shop-detail.html">Black Blouse Versace</a></h3>
                      <p class="price">$143.00</p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-4">
                  <div class="product">
                    <div class="image"><a href="shop-detail.html"><img src="img/product4.jpg" alt="" class="img-fluid image1"></a></div>
                    <div class="text">
                      <h3 class="h5"><a href="shop-detail.html">Black Blouse Versace</a></h3>
                      <p class="price">$143.00</p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-4">
                  <div class="product">
                    <div class="image"><a href="shop-detail.html"><img src="img/product3.jpg" alt="" class="img-fluid image1"></a></div>
                    <div class="text">
                      <h3 class="h5"><a href="shop-detail.html">White Blouse Armani</a></h3>
                      <p class="price">
                        <del>$280</del> $143.00
                      </p>
                    </div>
                    <div class="ribbon-holder">
                      <div class="ribbon sale">SALE</div>
                      <div class="ribbon new">NEW</div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-4">
                  <div class="product">
                    <div class="image"><a href="shop-detail.html"><img src="img/product4.jpg" alt="" class="img-fluid image1"></a></div>
                    <div class="text">
                      <h3 class="h5"><a href="shop-detail.html">White Blouse Versace</a></h3>
                      <p class="price">$143.00</p>
                    </div>
                    <div class="ribbon-holder">
                      <div class="ribbon new">NEW</div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-4">
                  <div class="product">
                    <div class="image"><a href="shop-detail.html"><img src="img/product2.jpg" alt="" class="img-fluid image1"></a></div>
                    <div class="text">
                      <h3 class="h5"><a href="shop-detail.html">White Blouse Versace</a></h3>
                      <p class="price">$143.00</p>
                    </div>
                    <div class="ribbon-holder">
                      <div class="ribbon new">NEW</div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-4">
                  <div class="product">
                    <div class="image"><a href="shop-detail.html"><img src="img/product1.jpg" alt="" class="img-fluid image1"></a></div>
                    <div class="text">
                      <h3 class="h5"><a href="shop-detail.html">Fur coat</a></h3>
                      <p class="price">$143.00</p>
                    </div>
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
                                <a href="{{route('lich-su')}}" class="nav-link ">
                                    <i class="fa fa-list"></i> Lịch sử giao dịch</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active">
                                    <i class="fa fa-heart"></i> Phim đã xem</a>
                            </li>
                            <li class="nav-item">
                                <a  href="{{route('profile')}}" class="nav-link ">
                                    <i class="fa fa-user"></i> Cài đặt</a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            </div>
          </div>
        </div>
      </div>
@endsection