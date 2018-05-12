@extends('master') @section('content')
<div id="heading-breadcrumbs">
        <div class="container">
          <div class="row d-flex align-items-center flex-wrap">
            <div class="col-md-7">
              <h1 class="h2">Giao dịch của tôi</h1>
            </div>
             
          </div>
        </div>
      </div>
      <div id="content">
        <div class="container">
          <div class="row bar mb-0">
            <div id="customer-orders" class="col-md-9">
              <p class="text-muted lead">If you have any questions, please feel free to <a href="contact.html">contact us</a>, our customer service center is working for you 24/7.</p>
              <div class="box mt-0 mb-lg-0">
                <div class="table-responsive">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>Order</th>
                        <th>Date</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th># 1735</th>
                        <td>22/06/2013</td>
                        <td>$ 150.00</td>
                        <td><span class="badge badge-info">Being prepared</span></td>
                        <td><a href="{{route('chi-tiet-lich-su')}}" class="btn btn-template-outlined btn-sm">View</a></td>
                      </tr>
                      <tr>
                        <th># 1735</th>
                        <td>22/06/2013</td>
                        <td>$ 150.00</td>
                        <td><span class="badge badge-info">Being prepared</span></td>
                        <td><a href="{{route('chi-tiet-lich-su')}}" class="btn btn-template-outlined btn-sm">View</a></td>
                      </tr>
                      <tr>
                        <th># 1735</th>
                        <td>22/06/2013</td>
                        <td>$ 150.00</td>
                        <td><span class="badge badge-success">Received</span></td>
                        <td><a href="{{route('chi-tiet-lich-su')}}" class="btn btn-template-outlined btn-sm">View</a></td>
                      </tr>
                      <tr>
                        <th># 1735</th>
                        <td>22/06/2013</td>
                        <td>$ 150.00</td>
                        <td><span class="badge badge-danger">Cancelled</span></td>
                        <td><a href="{{route('chi-tiet-lich-su')}}" class="btn btn-template-outlined btn-sm">View</a></td>
                      </tr>
                      <tr>
                        <th># 1735</th>
                        <td>22/06/2013</td>
                        <td>$ 150.00</td>
                        <td><span class="badge badge-warning">On hold</span></td>
                        <td><a href="{{route('chi-tiet-lich-su')}}" class="btn btn-template-outlined btn-sm">View</a></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="col-md-3 mt-4 mt-md-0">
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

                        </ul>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
@endsection