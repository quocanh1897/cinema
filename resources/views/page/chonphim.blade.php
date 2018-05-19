@extends('master') @section('content')
<div id="heading-breadcrumbs">
    <div class="container">
        <div class="row d-flex align-items-center flex-wrap">
            <div class="col-md-7">
                <h1 class="h2">Mua vé</h1>
            </div>

        </div>
    </div>
</div>
<div id="content">
    <div class="container">
        <div class="row">
            <div id="checkout" class="col-lg-8">
                <div class="box border-bottom-0">
                    <form action="{{route('chon-rap')}}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <ul class="nav nav-pills nav-fill">
                            <li class="nav-item">
                                <a class="nav-link active">
                                    <i class="fa fa-map-marker"></i>
                                    <br>Chọn phim</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link disabled">
                                    <i class="fa fa-truck"></i>
                                    <br>Chọn rạp</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link disabled">
                                    <i class="fa fa-money"></i>
                                    <br>Suất chiếu</a>
                            </li>
                        </ul>
                        <div class="container">
                            <div class="row portfolio text-center">
                                <div class="col-md-6">
                                    <div class="box-image">
                                        <div class="image">
                                            <img src="{{$phimDaChon->first()->hinhanh}} " alt="" class="img-fluid">
                                            <div class="overlay d-flex align-items-center justify-content-center">
                                                <div class="content">
                                                    <div class="name">
                                                        <h3>
                                                            <a href="{{route('chi-tiet',$phimDaChon->first()->maphim)}}" class="color-white">{{$phimDaChon->first()->tenphim}} </a>
                                                        </h3>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="box-footer d-flex flex-wrap align-items-center justify-content-between">
                            <div class="left-col">
                                <a href="index" class="btn btn-secondary mt-0">
                                    <i class="fa fa-chevron-left"></i>Quay về trang chủ</a>
                            </div>
                            <div class="right-col">
                                <button name="idphim" value="{{$phimDaChon->first()->maphim}}" type="submit" class="btn btn-template-main">
                                    Bước kế
                                    <i class="fa fa-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-4">
                <div id="order-summary" class="box mb-4 p-0">
                    <div class="box-header mt-0">
                        <h4>Thông tin vé</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Phim</td>
                                    <th>{{$phimDaChon->first()->tenphim}} </th>
                                </tr>
                                <tr>
                                    <td>Rạp</td>
                                    <th>Chưa chọn</th>
                                </tr>
                                <tr>
                                    <td>Suất chiếu</td>
                                    <th>Chưa chọn</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive" align="center">
                        <button type="submit" class="btn btn-template-main" disabled>Thanh toán
                            <i class="fa fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection