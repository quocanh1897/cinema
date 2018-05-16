@extends('master') 
@section('content')

<!-- PHIM DANG CHIEU -->
<div id="heading-breadcrumbs">
  <div class="container">
    <div class="row d-flex align-items-center flex-wrap">
      <div class="col-md-7">
        <h1 class="h2">LỊCH CHIẾU THEO PHIM</h1>
      </div>
      <div class="col-md-5">
        <ul class="breadcrumb d-flex justify-content-end">
          <li class="breadcrumb-item active">PHIM SẮP CHIẾU</li>
          <li class="breadcrumb-item">
            <a href="phim-dang-chieu">PHIM ĐANG CHIẾU</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<!-- END PHIM DANG CHIEU -->

<div id="content">
  <div class="container">
    <div class="row bar">
      <div class="col-md-12">
        
        <div class="row portfolio text-center">
          <div class="col-md-3">
            <div class="box-image">
              <div class="image"><img src="sources/img/product1.jpg" alt="" class="img-fluid">
                <div class="overlay d-flex align-items-center justify-content-center">
                  <div class="content">
                    <div class="name mb-small">
                      <h3><a class="color-white">Phim 1</a></h3>
                    </div>
                    <div class="text">
                      <p class="buttons"><a href="{{route('chi-tiet')}}" class="btn btn-template-outlined-white">CHI TIẾT</a><a href="https://www.youtube.com/watch?v=6ZfuNTqbHE8" class="btn btn-template-outlined-white">TRAILER</a></p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="ribbon-holder">
                <div class="ribbon sale">KM</div>
                <div class="ribbon new">HOT</div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="box-image">
              <div class="image"><img src="sources/img/product2.jpg" alt="" class="img-fluid">
                <div class="overlay d-flex align-items-center justify-content-center">
                  <div class="content">
                    <div class="name mb-small">
                      <h3><a class="color-white">Phim 2</a></h3>
                    </div>
                    <div class="text">
                      <p class="d-none">Ghi chú</p>
                      <p class="buttons"><a href="#" class="btn btn-template-outlined-white">Chi tiết</a><a href="#" class="btn btn-template-outlined-white">Trailer</a></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="box-image">
              <div class="image"><img src="sources/img/product3.jpg" alt="" class="img-fluid">
                <div class="overlay d-flex align-items-center justify-content-center">
                  <div class="content">
                    <div class="name mb-small">
                      <h3><a class="color-white">Phim 3</a></h3>
                    </div>
                    <div class="text">
                      <p class="d-none">Ghi chú</p>
                      <p class="buttons"><a href="#" class="btn btn-template-outlined-white">Chi tiết</a><a href="#" class="btn btn-template-outlined-white">Trailer</a></p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="ribbon-holder">
                <div class="ribbon new">HOT</div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="box-image">
              <div class="image"><img src="sources/img/product4.jpg" alt="" class="img-fluid">
                <div class="overlay d-flex align-items-center justify-content-center">
                  <div class="content">
                    <div class="name mb-small">
                      <h3><a class="color-white">Phim 4</a></h3>
                    </div>
                    <div class="text">
                      <p class="d-none">Ghi chú</p>
                      <p class="buttons"><a href="#" class="btn btn-template-outlined-white">Chi tiết</a><a href="#" class="btn btn-template-outlined-white">Trailer</a></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="box-image">
              <div class="image"><img src="sources/img/product2.jpg" alt="" class="img-fluid">
                <div class="overlay d-flex align-items-center justify-content-center">
                  <div class="content">
                    <div class="name mb-small">
                      <h3><a class="color-white">Phim 4</a></h3>
                    </div>
                    <div class="text">
                      <p class="d-none">Ghi chú</p>
                      <p class="buttons"><a href="#" class="btn btn-template-outlined-white">Chi tiết</a><a href="#" class="btn btn-template-outlined-white">Trailer</a></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="box-image">
              <div class="image"><img src="sources/img/product2.jpg" alt="" class="img-fluid">
                <div class="overlay d-flex align-items-center justify-content-center">
                  <div class="content">
                    <div class="name mb-small">
                      <h3><a class="color-white">Phim 4</a></h3>
                    </div>
                    <div class="text">
                      <p class="d-none">Ghi chú</p>
                      <p class="buttons"><a href="#" class="btn btn-template-outlined-white">Chi tiết</a><a href="#" class="btn btn-template-outlined-white">Trailer</a></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          @foreach($phim as $phim)
          <div class="col-md-3">
            <div class="box-image">
              <div class="image">
                <img src="{{$phim->hinhanh}} " alt="" class="img-fluid"  height="100" width="300">
                <div class="overlay d-flex align-items-center justify-content-center">
                  <div class="content">
                    <div class="name mb-small">
                      <h3>
                        <a class="color-white">{{$phim->tenphim}} </a>
                      </h3>
                    </div>
                    <div class="text">
                      <p class="buttons">
                        <a href="{{route('chi-tiet')}}" class="btn btn-template-outlined-white">CHI TIẾT</a>
                        <a href="{{route('chon-phim',$phim->maphim)}} " class="btn btn-template-outlined-white">Chọn</a>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="ribbon-holder">
                <div class="ribbon sale">KM</div>
                <div class="ribbon new">HOT</div>
              </div>
            </div>
          </div>
          @endforeach
          
        </div>
        
        <div class="row">
          <div class="col-md-12 banner mb-small text-center">
            <a href="#">
              <img src="sources/img/banner2.jpg" alt="" class="img-fluid">
            </a>
          </div>
        </div>
        <div class="pages">
          <p class="loadMore text-center">
            <a href="#" class="btn btn-template-outlined">
              <i class="fa fa-chevron-down"></i> Xem thêm</a>
            </p>
            <nav aria-label="Page navigation example" class="d-flex justify-content-center">
              <ul class="pagination">
                <li class="page-item">
                  <a href="#" class="page-link">
                    <i class="fa fa-angle-double-left"></i>
                  </a>
                </li>
                <li class="page-item active">
                  <a href="#" class="page-link">1</a>
                </li>
                <li class="page-item">
                  <a href="#" class="page-link">2</a>
                </li>
                <li class="page-item">
                  <a href="#" class="page-link">3</a>
                </li>
                <li class="page-item">
                  <a href="#" class="page-link">4</a>
                </li>
                <li class="page-item">
                  <a href="#" class="page-link">5</a>
                </li>
                <li class="page-item">
                  <a href="#" class="page-link">
                    <i class="fa fa-angle-double-right"></i>
                  </a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>

  @endsection