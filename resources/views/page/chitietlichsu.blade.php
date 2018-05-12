@extends('master') @section('content')
<div id="heading-breadcrumbs">
        <div class="container">
          <div class="row d-flex align-items-center flex-wrap">
            <div class="col-md-7">
              <h1 class="h2">Order # 1735</h1>
            </div>
             
          </div>
        </div>
      </div>
      <div id="content">
        <div class="container">
          <div class="row bar">
            <div id="customer-order" class="col-lg-9">
              <p class="lead">Order #1735 was placed on <strong>22/06/2013</strong> and is currently <strong>Being prepared</strong>.</p>
              <p class="lead text-muted">If you have any questions, please feel free to <a href="contact.html">contact us</a>, our customer service center is working for you 24/7.</p>
              <div class="box">
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th colspan="2" class="border-top-0">Product</th>
                        <th class="border-top-0">Quantity</th>
                        <th class="border-top-0">Unit price</th>
                        <th class="border-top-0">Discount</th>
                        <th class="border-top-0">Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><a href="#"><img src="img/detailsquare.jpg" alt="White Blouse Armani" class="img-fluid"></a></td>
                        <td><a href="#">White Blouse Armani</a></td>
                        <td>2</td>
                        <td>$123.00</td>
                        <td>$0.00</td>
                        <td>$246.00</td>
                      </tr>
                      <tr>
                        <td><a href="#"><img src="img/basketsquare.jpg" alt="Black Blouse Armani" class="img-fluid"></a></td>
                        <td><a href="#">Black Blouse Armani</a></td>
                        <td>1</td>
                        <td>$200.00</td>
                        <td>$0.00</td>
                        <td>$200.00</td>
                      </tr>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th colspan="5" class="text-right">Order subtotal</th>
                        <th>$446.00</th>
                      </tr>
                      <tr>
                        <th colspan="5" class="text-right">Shipping and handling</th>
                        <th>$10.00</th>
                      </tr>
                      <tr>
                        <th colspan="5" class="text-right">Tax</th>
                        <th>$0.00</th>
                      </tr>
                      <tr>
                        <th colspan="5" class="text-right">Total</th>
                        <th>$456.00</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
                <div class="row addresses">
                  <div class="col-md-6 text-right">
                    <h3 class="text-uppercase">Invoice address</h3>
                    <p>John Brown<br>					    13/25 New Avenue<br>					    New Heaven<br>					    45Y 73J<br>					    England<br>					    Great Britain</p>
                  </div>
                  <div class="col-md-6 text-right">
                    <h3 class="text-uppercase">Shipping address</h3>
                    <p>John Brown<br>					    13/25 New Avenue<br>					    New Heaven<br>					    45Y 73J<br>					    England<br>					    Great Britain</p>
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
                                <a  class="nav-link active">
                                    <i class="fa fa-list"></i> Lịch sử giao dịch</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('phim-da-xem')}}" class="nav-link">
                                    <i class="fa fa-heart"></i> Phim đã xem</a>
                            </li>
                            <li class="nav-item">
                                <a  href="{{route('profile')}}" class="nav-link ">
                                    <i class="fa fa-user"></i> Cài đặt</a>
                            </li>
                            <li class="nav-item">
                                <a  href="{{route('lich-su')}}" class="nav-link ">
                                    <i class="fa fa-undo"></i> Quay lại</a>
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