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
<div id="content1">
    <div class="container">
        <div class="row bar">

            <div id="basket" class="col-lg-9">
                <div class="box mt-0 pb-0 no-horizontal-padding">

                    <div class="table-responsive">

                        <table id="table1" class="table">
                            <thead>
                                <tr>
                                    <th colspan="2">Dịch vụ</th>
                                    <th>SL</th>
                                    <th>Đơn giá</th>
                                    <th colspan="2">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <form id="forms" onsubmit="return false;">
                                    @foreach($dichvu as $dv)
                                    <tr>
                                        <td>

                                            <img src="{{$dv->hinhanh}} " alt="dichvu" class="img-fluid">

                                        </td>
                                        <td>
                                            <a>{{$dv->tendv}} </a>
                                        </td>
                                        <td>
                                            <input id="soluong_{{$dv->madv}}" class="cacsl" type="number" value="0" step="1" min="0" max="10" style="font: 20pt Courier">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" id="gia_{{$dv->madv}}" value="{{$dv->gia}}" disabled>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" id="tong_{{$dv->madv}}" value="" disabled>
                                        </td>
                                    </tr>
                                    @endforeach
                                </form>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4">Tổng</th>
                                    <th colspan="2">
                                        <input id="tong" type="text" class="form-control" value="" disabled>
                                    </th>
                                </tr>
                            </tfoot>
                        </table>



                        <table class="table">
                            <thead>
                                <tr>
                                    <th colspan="2">Loại phòng</th>
                                    
                                    <th > Đơn giá</th>

                                </tr>
                            </thead>
                            <tr>

                                <td>
                                    <select name="loaiphong" id="chonlp" onchange="giveSelection(this.value)" class="form-control">
                                        <option value="--" selected hidden></option>
                                        @foreach($loaiphong as $lp)
                                        <option value="{{$lp->tenloai}}" >{{$lp->tenloai}}</option>
                                        @endforeach
                                    </select>    
                                </td>
                                <td></td>                                   
                                 
                                <td>
                                    <input type="text" class="form-control" id="displayGiaphong" value="" disabled>
                                    @foreach($loaiphongall as $lp)
                                    <input type="hidden" class="form-control" id="gia_{{$lp->tenloai}}" value="{{$lp->gia}}" >
                                    @endforeach
                                </td>

                            </tr>
                        </table>
                    </div>

                    <form action="{{route('chon-ghe')}} " method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="idphim" value="{{$phimDaChon->first()->maphim}}">
                        <input type="hidden" name="idrap" value="{{$rapDaChon->first()->marap}}">
                        <input type="hidden" name="ngay" value="{{$ngay}}  ">
                        <input type="hidden" name="gio" value="{{$gio}}  ">
                        <input type="hidden" name="loaiphong" id="loaiphong" value="">
                        <input type="hidden" name="giaghe" id="giaghe" value="">
                        <input type="hidden" name="giadv" id="giadv" value="">
                        <div class="box-footer d-flex justify-content-between align-items-center">
                            <div class="left-col">
                                <a href="index" class="btn btn-secondary mt-0">
                                    <i class="fa fa-chevron-left"></i> Hủy bỏ giao dịch</a>
                            </div>
                            <div class="right-col">
                                <button type="submit" class="btn btn-template-outlined" id="db_btn" disabled >Bước kế
                                    <i class="fa fa-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-3">
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
                                    <td>Suất chiếu</td>
                                    <th>{{$ngay}} | {{$gio}} </th>
                                </tr>
<!--
                                <tr class="total">
                                    <td colspan="3">
                                        <input type="text" id="tongcong" class="form-control" value="" disabled>
                                    </td>

                                </tr>
                            -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box box mt-0 mb-4 p-0">
                    <div class="box-header mt-0">
                        <h4>Mã khuyến mãi</h4>
                    </div>
                    <p class="text-muted">Nhập mã khuyến mãi để nhận ưu đãi bất ngờ.</p>

                    <div class="input-group">
                        <input type="text" class="form-control">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-template-main">
                                <i class="fa fa-gift"></i>
                            </button>
                        </span>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="sources/js/jquery-2.2.3.min.js"></script>

<script>
    //khong cho nhap vao o so luong
    $("[type='number']").keypress(function (evt) {
        evt.preventDefault();
    });
    var globalt = 0;

    //GIVE SELECTION FOR LOAIPHONG
    var lp = document.querySelector('#chonlp');

    function giveSelection(chonlp) {
        var x = document.getElementById('gia_'+ lp.value).value;
        
        document.getElementById("displayGiaphong").value = x + " VNĐ";
        document.getElementById("giaghe").value = parseInt( x);
        document.getElementById("giadv").value = parseInt( globalt);
        document.getElementById("loaiphong").value = lp.value;
        document.getElementById("db_btn").disabled = false;
    }


    //CALCULATE TOTAL BILL
    var cacsl = document.getElementsByClassName("cacsl");
    var num = cacsl.length;
    var soluong = [];
    for (i = 1; i <= num; i++) {
        soluong.push('#soluong_' + i);
    }
    var getTotal = function () {
        var tong = [];
        document.getElementById("tong").value = 0;
        for (i = 1; i <= num; i++) {

            var soluong = document.getElementById("soluong_" + i).value;

            var dongia = document.getElementById("gia_" + i).value;
            tong.push(soluong * dongia);
            var thanhtien = document.getElementById("tong_" + i).value = soluong * dongia + " VNĐ";


        }
        const reducer = (accumulator, currentValue) => accumulator + currentValue;
        
        globalt = tong.reduce(reducer) ;
        document.getElementById("tong").value = tong.reduce(reducer) + " VNĐ";
    }

    var calculate = function () {
        var temp, i = 1;
        do {
            temp = document.getElementById("soluong_" + i).onchange = getTotal;
            i++;
        } while (temp);
        calculate();
    };
    window.onload = calculate;
</script>


@endsection