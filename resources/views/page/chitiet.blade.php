@extends('master') @section('content')

<div id="heading-breadcrumbs">
  <div class="container">
    <div class="row d-flex align-items-center flex-wrap">
      <div class="col-md-7">
        <h1 class="h2">{{$phim->first()->tenphim}} </h1>
      </div>
      <div class="col-md-5">
        <ul class="breadcrumb d-flex justify-content-end">
          <li class="breadcrumb-item">
            <a href="index.html">Trang chủ</a>
          </li>
          <li class="breadcrumb-item">
            <a href="phim-dang-chieu">Phim</a>
          </li>
          <li class="breadcrumb-item active">{{$phim->first()->tenphim}}</li>
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
        
          <div id="productMain" class="row">
            <!-- Poster phim -->
            <div class="col-sm-4">
              <div data-slider-id="1" class="owl-carousel shop-detail-carousel">
                <div> <img src="{{$phim->first()->hinhanh}} " alt="" class="img-fluid"></div>
              </div>
            </div>
            <!-- Chi tiet phim -->
            <div class="col-sm-duy">
              <div id="details" class="box mb-4 mt-4">
                <style type="text/css">
                th{
                  padding: 10px;
                  font-weight: normal;
                  font-size: 16px;
                }
                th#thduy{
                  color: gray ;
                  font-weight: bold;
                }
              </style>
              <table style="padding: 15px">
                <tr>
                  <th id="thduy">Đạo diễn</th>
                  <th>{{$phim->first()->daodien}}</th>
                </tr>
                <tr>
                  <th id="thduy">Thể loại</th>
                  <th>
                    @foreach($theloai as $th)
                    {{$th->theloai}},
                    @endforeach
                  </th>                
                </tr>
                <tr>
                  <th id="thduy">Diễn viên</th>
                  <th>
                    @foreach($dienvien as $dv)
                    {{$dv->dienvien}},
                    @endforeach
                  </th>
                </tr>
                <tr>
                  <th id="thduy">Khởi chiếu</th>
                  <th>{{$phim->first()->batdau}}</th>
                </tr>
                <tr>
                  <th id="thduy">Thời lượng</th>
                  <th>{{$phim->first()->thoiluong}}</th>
                </tr>
                <tr>
                  <th id="thduy">Đối tượng</th>
                  <th>{{$phim->first()->doituong}}</th>
                </tr>
              </table>
              <p>
                <a href="{{route('chon-phim',$phim->first()->maphim)}}" class="btn btn-template-main">Đặt vé ngay</a>
                <a href="{{$phim->first()->trailer}}" class="btn btn-template-main">Trailer</a>
              </p>
            </div>       
          </div>
          <!-- End chi tiet phim -->

          <div class="col-md-duy">
            <!-- PAGES MENU -->
            <div class="panel panel-default sidebar-menu">
              <div class="panel-heading">
                <h3 class="h4 panel-title">Khuyến mãi</h3>
              </div>            
            </div>

            <div class="banner">
              <a href="index" class="text-center"><img src="sources/img/template-easy-code.png" alt="" class="img-fluid">Khuyến mãi 1</a>
            </div>

            

          </div>

        </div>
        <p class="lead">
          <b>Nội dung phim: </b>{{$phim->first()->mota}} </p>
      </div>
    </div>
  </div>
</div>

@endsection