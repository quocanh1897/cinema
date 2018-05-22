@extends('master') @section('content')

<div id="heading-breadcrumbs">
  <div class="container">
    <div class="row d-flex align-items-center flex-wrap">
       
        <h1 class="h2">{{$phim->first()->tenphim}} </h1>
       
       
    </div>
  </div>
</div>
<div id="content">
  <div class="container">
    <div class="row bar">
      <!-- LEFT COLUMN _________________________________________________________-->
      <div class="col-lg-18">

        <div id="productMain" class="row" style="position: relative;">
          <!-- Poster phim -->
          <div class="col-sm-3">
            <div data-slider-id="1" class="owl-carousel shop-detail-carousel" >
              <div class="myposter">
                <img src="{{$phim->first()->hinhanh}} " alt="" class="img-fluid">
              </div>
            </div>

          </div>
          <!-- Chi tiet phim -->
          <div class="col-sm-7">
            <div id="details" class="mb-4 mt-4">
              <style type="text/css">
              th {
                padding: 10px;
                font-weight: normal;
                font-size: 16px;
              }
              th#thduy {
                color: gray;
                font-weight: bold;
              }
            </style>

            <table>
              <tr>
                <th id="thduy">Đạo diễn</th>
                <th>{{$phim->first()->daodien}}</th>
              </tr>
              <tr>
                <th id="thduy">Thể loại</th>
                <th>
                  @foreach($theloai as $th) {{$th->theloai}}, @endforeach
                </th>
              </tr>
              <tr>
                <th id="thduy">Diễn viên</th>
                <th>
                  @foreach($dienvien as $dv) {{$dv->dienvien}}, @endforeach
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
            <hr>
            <table>
              <tr>
                <th>
                  <form action="{{route('chon-phim')}}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button name="idphim" type="submit" value="{{$phim->first()->maphim}}" class="btn btn-template-main">Đặt vé ngay</button>
                  </form>
                </th>
                <th>
                  <a href="{{$phim->first()->trailer}}" target="_blank" class="btn btn-template-main">Trailer</a>
                </th>
              </tr>
            </table>      

          </div>
        </div>
        <!-- End chi tiet phim -->

        <div class="col-sm-10">
          <p class="lead">
            <b>Nội dung phim: </b>{{$phim->first()->mota}} 
          </p>
        </div>

        <div class="col-sm-2" style=" position: absolute;right: 0; top: 0">
          <!-- PAGES MENU -->
          <div class="panel panel-default sidebar-menu">
            <div class="panel-heading">
              <h3 class="h4 panel-title">Khuyến mãi</h3>
            </div>
          </div>
          @foreach($khuyenmai as $km)
          <div class="banner">
            <a href="index" class="text-center">
              <img src="{{$km->hinhanh}} " alt="" class="img-fluid">{{$km->tenkm}}
            </a>
          </div>
          @endforeach
        </div>        
      </div>
    </div>
  </div>
</div>
</div>

@endsection