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
              <p class="text-muted lead">Bạn đã thực hiện {{count($hoadon)}}  giao dịch.</p>
              <div class="box mt-0 mb-lg-0">
                <div class="table-responsive">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>Mã giao dịch</th> <!-- cột mahoadon trong database -->
                        <th>Ngày giao dịch</th>
                        <th>Vé</th>
                        <th>Dịch vụ</th>                        
                        <th>Tổng tiền</th>
                        <th>Chi tiết</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($hoadon as $hd)
                      <tr>
                        <th>#{{$hd->mahoadon}}  </th>
                        <td>{{$hd->ngayxuat}} </td>
                        <td>#</td>
                        
                        <td>#</td>
                        <td>{{$hd->tongtien}} </td>
                        <form action="{{route('chi-tiet-lich-su')}}" method="POST" >
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <input type="hidden" name="idhoadon" value="{{$hd->mahoadon}}">
                        <td><button  type="submit" class="btn btn-template-outlined btn-sm">Xem</button></td>
                        </form>
                      </tr>
                      @endforeach
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
                                <a href="{{route('profile')}}" class="nav-link">
                                    <i class="fa fa-user"></i> Thông tin cá nhân</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active">
                                    <i class="fa fa-list"></i> Lịch sử giao dịch</a>
                            </li>
                            <li class="nav-item">
                                <a  href="{{route('phim-da-xem')}}" class="nav-link ">
                                    <i class="fa fa-heart"></i> Phim đã xem</a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
@endsection