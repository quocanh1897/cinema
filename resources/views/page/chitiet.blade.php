@extends('master') @section('content')

<div id="heading-breadcrumbs">
  <div class="container">
    <div class="row d-flex align-items-center flex-wrap">
      <div class="col-md-7">
        <h1 class="h2">{{$phim->first()->tenphim}} </h1>
      </div>

    </div>
  </div>
</div>
<div id="content">
  <div class="container">
    <div class="row bar">
      <!-- LEFT COLUMN _________________________________________________________-->
      <div class="col-lg-18">
        <p class="lead">
          <b>Nội dung phim: </b>{{$phim->first()->mota}} </p>
        <div id="productMain" class="row">
          <div class="col-sm-4">
            <div>
              <br><br>
              <img src="{{$phim->first()->hinhanh}} " alt="" class="img-fluid">
            </div>
            <p class="text-center">
              <a href="{{route('chon-phim',$phim->first()->maphim)}}" class="btn btn-template-main">Đặt vé ngay</a>
            </p>
          </div>
          <div class="col-sm-8">
            <div id="details" class="box mb-4 mt-4">
              <h4>Đạo diễn</h4>
              <p style="padding-left: 1.8em">{{$phim->first()->daodien}}</p>
              <h4>Diễn viên</h4>
              <p style="padding-left: 1.8em"> 
                @foreach($dienvien as $dv)
                  {{$dv->dienvien}},

                @endforeach
              
              </p>
              <h4>Thể loại</h4>
              <p style="padding-left: 1.8em">
              @foreach($theloai as $th)
                  {{$th->theloai}},

                @endforeach
              
              </p>
              <h4>Ngày khởi chiếu</h4>
              <p style="padding-left: 1.8em">{{$phim->first()->batdau}}</p>
              <h4>Thời lượng</h4>
              <p style="padding-left: 1.8em">{{$phim->first()->thoiluong}}</p>
              <h4>Đối tượng</h4>
              <p style="padding-left: 1.8em">{{$phim->first()->doituong}}</p>
            </div>

          </div>
        </div>
<!--
        <div id="product-social" class="box social text-center mb-5 mt-5">
          <h4 class="heading-light">Chia sẻ với bạn bè</h4>
          <ul class="social list-inline">
            <li class="list-inline-item">
              <a href="#" data-animate-hover="pulse" class="external facebook">
                <i class="fa fa-facebook"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#" data-animate-hover="pulse" class="external gplus">
                <i class="fa fa-google-plus"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#" data-animate-hover="pulse" class="external twitter">
                <i class="fa fa-twitter"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#" data-animate-hover="pulse" class="email">
                <i class="fa fa-envelope"></i>
              </a>
            </li>
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
              <div class="image">
                <a href="#">
                  <img src="sources/img/product2.jpg" alt="" class="img-fluid image1">
                </a>
              </div>
            </div>
          </div>
          <div class="col-lg-2 col-md-6">
            <div class="product">
              <div class="image">
                <a href="#">
                  <img src="sources/img/product3.jpg" alt="" class="img-fluid image1">
                </a>
              </div>
            </div>
          </div>
          <div class="col-lg-2 col-md-6">
            <div class="product">
              <div class="image">
                <a href="#">
                  <img src="sources/img/product1.jpg" alt="" class="img-fluid image1">
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
-->
    </div>
  </div>
</div>
</div>

@endsection