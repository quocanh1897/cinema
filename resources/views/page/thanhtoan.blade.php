@extends('master') 

@section('content')
<div id="content1">
    <div class="container">
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6 text-center">
                <h3>THÔNG TIN VÉ</h3> 
            </div>
        </div>
        <div class="row ">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div id="order-summary" class="box mt-0 mb-4 p-0">
                    <div class="box-header mt-0" align="center">
                        <h3>
                            <img src="{{$phimDaChon->first()->hinhanh}} " alt="phim" class="img-fluid">
                        </h3>
                    </div>
                    <p class="text-muted" align="center">{{$phimDaChon->first()->tenphim}} </p>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Rạp:</td>
                                    <th>{{$rapDaChon->first()->tenrap}} </th>
                                </tr>
                                <tr>
                                    <td>Suất chiếu:</td>
                                    <th>{{$ngay}} | {{$gio}} </th>
                                </tr>
                                <tr>
                                    <td>Ghế: </td>
                                    <th> {{$gheso}}</th>
                                    
                                </tr>
                                <tr>
                                    <td>Định dạng: </td>
                                    <th> {{$loaiphong}} </th>
                                </tr>
                                <tr>
                                    <td>Phòng số: </td>
                                    <th>{{$phong->first()->maphong}} </th>
                                </tr>
                                <tr class="total">
                                    <td >Tổng tiền: </td>
                                     <th>  {{$tongcong}}</th> 

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                 
            </div>
        </div>
    </div>
</div>
<div>
    <h5>Trang web sẽ tự chuyển sau <a id="countDown"></a> giây</h5>
</div>
<script type="text/javascript">   
    var count = 5;
    setInterval(function () {
        count--;
        document.getElementById('countDown').innerHTML = count;
        if (count == 0) {
            window.location = 'index';
        }
    }, 1000);
</script>
@endsection