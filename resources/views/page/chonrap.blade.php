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
                     
                        <ul class="nav nav-pills nav-fill">
                            <li class="nav-item">
                                <a   class="nav-link disabled">
                                    <i class="fa fa-map-marker"></i>
                                    <br>Chọn phim</a>
                            </li>
                            <li class="nav-item">
                                <a   class="nav-link active">
                                    <i class="fa fa-truck"></i>
                                    <br>Chọn rạp</a>
                            </li>
                            <li class="nav-item">
                                <a   class="nav-link disabled">
                                    <i class="fa fa-money"></i>
                                    <br>Suất chiếu</a>
                            </li>
                        </ul>
                        <div class="container">
                            <div class="row portfolio text-center">
                                @foreach($rap as $rap)
                                <div class="col-md-6">
                                    <div class="box-image">
                                        <div class="image">
                                            <img src="{{$rap->hinh_anh}} " alt="" class="img-fluid">
                                            <div class="overlay d-flex align-items-center justify-content-center">
                                                <div class="content">
                                                    <div class="name">
                                                        <h4>
                                                            <a href="{{route('rap',$rap->marap)}}" target="_blank"><b>{{$rap->tenrap}}</b></a>
                                                           
                                                        </h4>
                                                    </div>
                                                    <div class="text">
                                                        
                                                        <form action="{{route('chon-suat-chieu')}}" method="post">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <p class="buttons">
                                                            <select hidden name="idrap"><option value="{{$rap->marap}}"></option> </select>
                                                            <button type="submit" name="idphim" value="{{$phimDaChon->first()->maphim}}" class="btn btn-template-outlined-white">
                                                                Chọn
                                                            </button>
                                                        
                                                        </p>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                        <div class="box-footer d-flex flex-wrap align-items-center justify-content-between">
                            <div class="left-col">
                                <form action="{{route('chon-phim')}}" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" name="idphim" value="{{$phimDaChon->first()->maphim}} " class="btn btn-secondary mt-0">
                                    <i class="fa fa-chevron-left"></i>Quay lại
                                </button>
                                </form>

                            </div>
                            <div class="right-col">
                                <button type="submit" class="btn btn-template-main" disabled>Bước kế
                                    <i class="fa fa-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                     
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
                                    <th>{{$phimDaChon->first()->tenphim}}</th>
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
<style>
.img-fluid {
    width: 300px;
    min-height: 250px;
    max-height: 250px;
    float: left;
    margin:0px;
    padding: 10px;
}

</style>
@endsection