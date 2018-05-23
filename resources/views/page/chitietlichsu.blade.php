@extends('master') @section('content')
<div id="heading-breadcrumbs">
  <div class="container">
    <div class="row d-flex align-items-center flex-wrap">
      <div class="col-md-6">
        <h1 class="h2">Giao dịch # {{$hoadon->first()->mahoadon}} </h1>
      </div>
       
    </div>
  </div>
</div>

<div id="content">
  <div class="container">
    <div class="row bar">
      <!-- thông tin giao dịch  -->
      <div class="col-lg-8 mt-4 mt-lg-0">
        <div class="project-more">
          <div class="heading">
            <h3>Thông tin giao dịch</h3>
          </div>
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th colspan="2" class="border-top-0">Tên</th> <!-- phim hoặc đồ ăn thức uống -->
                  <th class="border-top-0">Số lượng</th>
                  <th class="border-top-0">Đơn giá</th> <!-- giá cho một đơn vị -->
                  <th class="border-top-0">Mã khuyến mãi</th>
                  <th class="border-top-0">Thành tiền</th>
                </tr>
              </thead>
              <tbody>
                @foreach($ve as $ve)
                <tr>
                  <td><a href="#"><img src="" class="img-fluid"></a></td>
                  <td><a href="#">Ghế Thường</a></td>
                  <td>2</td>
                  <td>$123.00</td>
                  <td>#</td>
                  <td>$#</td>
                </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <th colspan="5" class="text-right">Tổng cộng</th>
                  <th>{{$hoadon->first()->tongtien}} </th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
      <!-- end thông tin giao dịch -->
      <!-- thông tin vé -->
      <div class="col-lg-4 mt-4 mt-lg-0">
        <div class="project-more">
          <div class="heading">
            <h3>Thông tin vé</h3>
          </div>
          <div class="table-responsive">
            <table class="table">                 
              <tr>
                <th>Phim</th> <!-- phim hoặc đồ ăn thức uống -->
                <td>{{$phim->first()->tenphim}} </td>                     
              </tr>
              <tr>
                <th>Rạp chiếu</th>                       
                <td>{{$rap->first()->tenrap}} </td>
              </tr>
              <tr>
                <th>Ghế ngồi</th> <!-- giá cho một đơn vị -->
                <td>
                  @foreach($soghe as $sg)
                    {{$sg}},
                  @endforeach
                </td>
              </tr>
              <tr>
                <th >Suất chiếu</th>
                <td>{{$khunggio->first()->batdau}} </td>   
              </tr>
              <tr>
                <th>Ngày</th>
                <td>{{$suatchieu->first()->ngaychieu}} </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <!-- end thông tin vé -->
    </div>
    <p class="lead-duy text-muted">Nếu có bất kì thắc mắc, vui lòng liên hệ với chúng tôi tại <a href="contact"><strong>đây</strong></a>, hệ thống chăm sóc khách hàng luôn sẵn sàng hỗ trợ bạn 24/7.</p>
  </div>
</div>

@endsection