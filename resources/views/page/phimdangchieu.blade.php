@extends('master') @section('content')

<!-- PHIM DANG CHIEU -->
<div id="heading-breadcrumbs">
  <div class="container">
    <div class="row d-flex align-items-center flex-wrap">
      <div class="col-md-7">
        <h1 class="h2">LỊCH CHIẾU THEO PHIM</h1>
      </div>
      <div class="col-md-5">
        <ul class="breadcrumb d-flex justify-content-end">
          <li class="breadcrumb-item">
            <a href="phim-sap-chieu">PHIM SẮP CHIẾU</a>
          </li>
          <li class="breadcrumb-item active">PHIM ĐANG CHIẾU</li>
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
          @foreach($phim as $phim)
          <div class="col-md-3">
            <div class="box-image">
              <div class="image">
                <img src="{{$phim->hinhanh}} " alt="" class="img-fluid" height="100" width="300">
                <div class="overlay d-flex align-items-center justify-content-center">
                  <div class="content">
                    <div class="name mb-small">
                      <h3>
                        <a class="color-white">{{$phim->tenphim}} </a>
                      </h3>
                    </div>
                    <form action="{{route('chon-phim')}}" method="post">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <a href="{{route('chi-tiet',$phim->maphim)}}" class="btn btn-template-outlined-white">Chi tiết</a>
                      <button name="idphim" type="submit" value="{{$phim->maphim}}" class="btn btn-template-outlined-white">Chọn</button>
                    </form>

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