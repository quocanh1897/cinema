@extends('master') @section('content')
<div id="heading-breadcrumbs">
    <div class="container">
        <div class="row d-flex align-items-center flex-wrap">
            <div class="col-md-7">
                <h1 class="h2">Mua vé</h1>
            </div>
            <div class="col-md-5">
                <ul class="breadcrumb d-flex justify-content-end">
                    <li class="breadcrumb-item">
                        <a href="#">Trang chủ</a>
                    </li>
                    <li class="breadcrumb-item active">Mua vé</li>
                </ul>
            </div>
        </div>
    </div>
</div>


<div id="content">
    <div class="container">
        <div class="row">
            <div id="checkout" class="col-lg-9">
                <div class="box border-bottom-0" style="margin-top: 25px">

                    <ul class="nav nav-pills nav-fill">
                        <li class="nav-item"><a href="javascript:void(null);" class="nav-link active" id="1"> <i class="fa fa-film"></i><br><b>Chọn phim</b></a></li>
                        <li class="nav-item"><a href="javascript:void(null);" class="nav-link disabled" id="2"><i class="fa fa-bank"></i><br><b>Chọn rạp</b></a></li>
                        <li class="nav-item"><a href="javascript:void(null);" class="nav-link disabled" id="3"><i class="fa fa-calendar-check-o"></i><br><b>Chọn suất</b></a></li>
                        <li class="nav-item"><a href="javascript:void(null);" class="nav-link disabled" id="4"><i class="fa fa-wheelchair-alt"></i><br><b>Chọn ghế</b></a></li>
                        <li class="nav-item"><a href="javascript:void(null);" class="nav-link disabled" id="5"><i class="fa fa-cart-plus"></i><br><b>Xác nhận</b></a></li>
                    </ul>
                    <div class="content">
                        <!-- Bảng chọn phim -->
                        <div class="table-responsive" id="bangchon1">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th colspan="3">Phim</th>
                                        <th>Đối tượng</th>
                                        <th>Thời lượng</th>
                                        <th>Lựa chọn</th>
                                    </tr>
                                </thead>
                                <tbody id="bangPhim">
                                    @foreach($phim as $phim)
                                    <tr class="active">
                                        <td><img src="{{$phim->hinhanh}}" alt="Poster phim"></td>
                                        <td colspan="2">
                                            <a href="{{route('chi-tiet',$phim->maphim)}}" target="_blank"><b>{{$phim->tenphim}}</b></a>
                                        </td>
                                        <td>{{$phim->doituong}}</td>
                                        <td>{{$phim->thoiluong}}</td>
                                        <td><a href="javascript:void(null);" onclick="myFunc1()"><b>Chọn</b></a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- Bảng chọn rạp -->
                        <div class="table-responsive" id="bangchon2" hidden>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th colspan="3">Rạp</th>
                                        <th colspan="3">Địa chỉ</th>                                       
                                        <th>Lựa chọn</th>
                                    </tr>
                                </thead>
                                <tbody id="bangRap">
                                    @foreach($rap as $rap)
                                    <tr class="active">                                       
                                        <td colspan="3">
                                            <a href="{{route('rap',$rap->marap)}}" target="_blank"><b>{{$rap->tenrap}}</b></a>
                                        </td>
                                        <td colspan="3">{{$rap->daichi}}</td>                                       
                                        <td><a href="javascript:void(null);" onclick="myFunc2()"><b>Chọn</b></a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- Bảng chọn suất chiếu -->
                        <div class="table-responsive" id="bangchon3" hidden>
                            <table class="table">
                                <thead>
                                    <tr>                                        
                                        <th>Suất chiếu</th>                                       
                                        <th>Lựa chọn</th>
                                    </tr>
                                </thead>
                                <tbody id="bangSuat">
                                    @foreach($khung_gio as $khung_gio)
                                    <tr class="active">
                                        <td>{{$khung_gio->batdau}}</td>                                       
                                        <td><a href="javascript:void(null);" onclick="myFunc3()"><b>Chọn</b></a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- Bảng chọn ghế -->
                        
                    </div>
                </div>
            </div>

            <script type="text/javascript">
                function myFunc1() {
                    $('#bangPhim tr').click(function(e) {
                        $('#bangPhim tr').removeClass('duyduy1');
                        $('#bangPhim tr').css('background-color','transparent');
                        $(this).addClass('duyduy1');
                        $(this).css('background-color','#eaebef');
                        $('th#phimduocchon').text($('.duyduy1 td:eq(1)').text());
                    });
                }

                function myFunc2() {
                    $('#bangRap tr').click(function(e) {
                        $('#bangRap tr').removeClass('duyduy2');
                        $('#bangRap tr').css('background-color','transparent');
                        $(this).addClass('duyduy2');
                        $(this).css('background-color','#eaebef');
                        $('th#rapduocchon').text($('.duyduy2 td:eq(1)').text());
                    });
                } 

                function myFunc3() {
                    $('#bangSuat tr').click(function(e) {
                        $('#bangSuat tr').removeClass('duyduy3');
                        $('#bangSuat tr').css('background-color','transparent');
                        $(this).addClass('duyduy3');
                        $(this).css('background-color','#eaebef');
                        $('th#suatduocchon').text($('.duyduy3 td:eq(0)').text());
                    });
                }                   
                

                function nextStage() {               
                    var x = Number($('li.nav-item a.active').prop("id")); 
                    var y = Number(x)+1;    
                    $("button#next").click(function(e){ 

                            // $('li#' + Number(y)).prop( "disabled", false );
                            // $('li#' + Number(x)).prop( "disabled", true );
                            $('li.nav-item a#' + Number(y)).addClass('active').removeClass('disabled');                           
                            $('li.nav-item a#' + Number(x)).removeClass('active').addClass('disabled');
                            $('div#bangchon' + Number(y)).prop("hidden",false);
                            $('div#bangchon' + Number(x)).prop("hidden",true);                      
                        });
                    if (x == 4) {
                        $("button#next").prop( "disabled", true );
                        $("button#confirm").prop("disabled", false);
                    }

                }                            
            </script>

            <div class="col-lg-3">
                <div id="order-summary" class="box mb-4 p-0" style="margin-top: 25px">
                    <div class="box-header mt-0">
                        <h4>Thông tin vé</h4>
                    </div>
                    <form>
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Phim</td>
                                        <th id="phimduocchon">--</th>
                                    </tr>
                                    <tr>
                                        <td>Rạp</td>
                                        <th id="rapduocchon">--</th>
                                    </tr>
                                    <tr>
                                        <td>Suất</td>
                                        <th id="suatduocchon">--</th>
                                    </tr>
                                    <tr>
                                        <td>Ghế</td>
                                        <th id="gheduocchon">--</th>
                                    </tr>
                                </tbody>
                            </table>
                            <button id="confirm" type="submit" class="btn btn-success" style="width: 100%" disabled>Thanh toán</button>
                        </div>
                    </form>
                    <hr>
                    <button id="next" class="btn btn-success" style="width: 100%" onclick="nextStage()">Bước kế</button>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection