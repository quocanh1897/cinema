@extends('master') @section('content')
<div id="heading-breadcrumbs">
  <div class="container">
    <div class="row d-flex align-items-center flex-wrap">
      <div class="col-md-6">
        <h1 class="h2">Giao dịch # 1735</h1>
      </div>
      <div class="col-md-6">
        <ul class="breadcrumb d-flex justify-content-end">
          <li class="breadcrumb-item">
            <a href="index.html">Trang chủ</a>
          </li>
          <li class="breadcrumb-item active">
            <a href="profile">Tài khoản</a>
          </li>
          <li class="breadcrumb-item">
            <a href="lich-su">Lịch sử giao dịch</a>
          </li>
          <li class="breadcrumb-item">Chi tiết</li>
        </ul>
      </div>  
    </div>
  </div>
</div>

<div id="content">
  <div class="container">
    <div class="row bar">
      <!-- thông tin giao dịch  -->
      <div class="col-lg-9 mt-4 mt-lg-0">
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
                <tr>
                  <td><a href="#"><img src="sources/img/detailsquare.jpg" alt="White Blouse Armani" class="img-fluid"></a></td>
                  <td><a href="#">Vé (loại)</a></td>
                  <td>2</td>
                  <td>$123.00</td>
                  <td>ABCXYZ</td>
                  <td>$246.00</td>
                </tr>
                <tr>
                  <td><a href="#"><img src="sources/img/basketsquare.jpg" alt="Black Blouse Armani" class="img-fluid"></a></td>
                  <td><a href="#">Combo 1</a></td>
                  <td>1</td>
                  <td>$200.00</td>
                  <td>XYZABC</td>
                  <td>$200.00</td>
                </tr>
              </tbody>
              <tfoot>
                <tr>
                  <th colspan="5" class="text-right">Tổng cộng</th>
                  <th>$446.00</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
      <!-- end thông tin giao dịch -->
      <!-- thông tin vé -->
      <div class="col-lg-3 mt-4 mt-lg-0">
        <div class="project-more">
          <div class="heading">
            <h3>Thông tin vé</h3>
          </div>
          <div class="table-responsive">
            <table class="table">                 
              <tr>
                <th>Phim</th> <!-- phim hoặc đồ ăn thức uống -->
                <td>Naruto Shippuden</td>                     
              </tr>
              <tr>
                <th >Rạp chiếu</th>                       
                <td>Aeon Tân Phú</td>
              </tr>
              <tr>
                <th >Ghế ngồi</th> <!-- giá cho một đơn vị -->
                <td>A1,A2</td>
              </tr>
              <tr>
                <th >Suất chiếu</th>
                <td>9:00</td>   
              </tr>
              <tr>
                <th>Ngày suất</th>
                <td>22/6/2013</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <!-- end thông tin vé -->
    </div>
    <p class="lead-duy text-muted">Nếu có bất kì thắc mắc, vui lòng liên hệ với chúng tôi tại <a href="contact.html"><strong>đây</strong></a>, hệ thống chăm sóc khách hàng luôn sẵn sàng hỗ trợ bạn 24/7.</p>
  </div>
</div>

@endsection