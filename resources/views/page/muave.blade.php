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
                                    <th >SL</th>
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
                                            <input type="text" class="form-control" id="gia_{{$dv->madv}}" value="{{$dv->gia}}"
                                                disabled>
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
                                    <th colspan="2">Chọn ghế</th>

                                </tr>
                            </thead>

                        </table>
                    </div>

                    <!-- SELECT SEATS -->
                    <div class="container">

                        <div>
                            
                            <!-- seat availabilty list -->

                            <p>
                                <button class="btn btn-success"></button> Ghế chọn </p>

                            <p>
                                <button class="btn btn-template-outlined" disabled></button> Ghế trống</p>

                            <p>
                                <button class="btn btn-danger"></button> Ghế có người ngồi</p>
                            <hr>
                            <!-- seat availabilty list -->
                            <!-- seat layout -->
                            <div class="seatStructure txt-center" style="overflow-x:auto;">
                                <div>
                                    <h2 class="wthree">MÀN HÌNH</h2>
                                </div>
                                <table id="seatsBlock" class="tableS">
                                    <p id="notification"></p>
                                    <tr>
                                        <td></td>
                                        <td>1</td>
                                        <td>2</td>
                                        <td>3</td>
                                        <td>4</td>
                                        <td>5</td>
                                        <td>6</td>
                                        <td></td>
                                        <td>7</td>
                                        <td>8</td>
                                        <td>9</td>
                                        <td>10</td>
                                        <td>11</td>
                                        <td>12</td>
                                    </tr>
                                    <tr>
                                        <td>A</td>
                                        <td>
                                            <input type="checkbox" class="seats" value="A1">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="A2">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="A3">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="A4">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="A5">
                                        </td>
                                        
                                        <td>
                                            <input type="checkbox" class="seats" value="A6">
                                        </td><td class="seatGap"></td>
                                        <td>
                                            <input type="checkbox" class="seats" value="A7">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="A8">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="A9">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="A10">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="A11">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="A12">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>B</td>
                                        <td>
                                            <input type="checkbox" checked class="seats redBox" value="B1" disabled>
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="B2">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="B3">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="B4">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="B5">
                                        </td>
                                        
                                        <td>
                                            <input type="checkbox" class="seats" value="B6">
                                        </td><td></td>
                                        <td>
                                            <input type="checkbox" class="seats" value="B7">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="B8">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="B9">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="B10">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="B11">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="B12">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>C</td>
                                        <td>
                                            <input type="checkbox" class="seats" value="C1">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="C2">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="C3">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="C4">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="C5">
                                        </td>
                                       
                                        <td>
                                            <input type="checkbox" class="seats" value="C6">
                                        </td> <td></td>
                                        <td>
                                            <input type="checkbox" class="seats" value="C7">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="C8">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="C9">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="C10">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="C11">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="C12">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>D</td>
                                        <td>
                                            <input type="checkbox" class="seats" value="D1">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="D2">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="D3">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="D4">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="D5">
                                        </td>
                                        
                                        <td>
                                            <input type="checkbox" class="seats" value="D6">
                                        </td><td></td>
                                        <td>
                                            <input type="checkbox" class="seats" value="D7">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="D8">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="D9">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="D10">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="D11">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="D12">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>E</td>
                                        <td>
                                            <input type="checkbox" class="seats" value="E1">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="E2">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="E3">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="E4">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="E5">
                                        </td>
                                        
                                        <td>
                                            <input type="checkbox" class="seats" value="E6">
                                        </td><td></td>
                                        <td>
                                            <input type="checkbox" class="seats" value="E7">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="E8">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="E9">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="E10">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="E11">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="E12">
                                        </td>
                                    </tr>

                                    

                                    <tr>
                                        <td>F</td>
                                        <td>
                                            <input type="checkbox" class="seats" value="F1">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="F2">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="F3">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="F4">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="F5">
                                        </td>
                                        
                                        <td>
                                            <input type="checkbox" class="seats" value="F6">
                                        </td><td></td>
                                        <td>
                                            <input type="checkbox" class="seats" value="F7">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="F8">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="F9">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="F10">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="F11">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="F12">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>G</td>
                                        <td>
                                            <input type="checkbox" class="seats" value="G1">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="G2">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="G3">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="G4">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="G5">
                                        </td>
                                        
                                        <td>
                                            <input type="checkbox" class="seats" value="G6">
                                        </td><td></td>
                                        <td>
                                            <input type="checkbox" class="seats" value="G7">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="G8">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="G9">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="G10">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="G11">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="G12">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>H</td>
                                        <td>
                                            <input type="checkbox" class="seats" value="H1">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="H2">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="H3">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="H4">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="H5">
                                        </td>
                                        
                                        <td>
                                            <input type="checkbox" class="seats" value="H6">
                                        </td><td></td>
                                        <td>
                                            <input type="checkbox" class="seats" value="H7">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="H8">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="H9">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="H10">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="H11">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="H12">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>I</td>
                                        <td>
                                            <input type="checkbox" class="seats" value="I1">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="I2">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="I3">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="I4">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="I5">
                                        </td>
                                        
                                        <td>
                                            <input type="checkbox" class="seats" value="I6">
                                        </td><td></td>
                                        <td>
                                            <input type="checkbox" class="seats" value="I7">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="I8">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="I9">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="I10">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="I11">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="I12">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>J</td>
                                        <td>
                                            <input type="checkbox" class="seats" value="J1">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="J2">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="J3">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="J4">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="J5">
                                        </td>
                                       
                                        <td>
                                            <input type="checkbox" class="seats" value="J6">
                                        </td> <td></td>
                                        <td>
                                            <input type="checkbox" class="seats" value="J7">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="J8">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="J9">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="J10">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="J11">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="seats" value="J12">
                                        </td>
                                    </tr>
                                </table>


                                <div class="row">
                                    <div class="col-md-4"><button class="btn btn-template-outlined" onclick="updateTextArea()">Xác nhận chọn ghế</button></div>
                                    <div class="col-md-8"><input type="text" id="seatsDisplay" value="" disabled></input></div>
                                </div>
                                
                                
                            </div>
                            <!-- //seat layout -->
                            
                            <!-- //details after booking displayed here -->
                        </div>
                    </div>





                    <div class="box-footer d-flex justify-content-between align-items-center">
                        <div class="left-col">
                            <a href="index" class="btn btn-secondary mt-0">
                                <i class="fa fa-chevron-left"></i> Hủy bỏ giao dịch</a>
                        </div>
                        <div class="right-col">
                            <button type="submit" class="btn btn-template-outlined" id="db_btn">Xác nhận
                                <i class="fa fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>

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
                                <tr>
                                    <td>Ghế: </td>
                                    <th> <input type="text" id="gheso" class="form-control" value="" disabled> </th>
                                    </tr>
                                <tr class="total">
                                    <td colspan="3">
                                        <input type="text" id="tongcong" class="form-control" value="" disabled>
                                    </td>

                                </tr>
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
<style>
    #selectseat {
        border: 0px;
        padding: 0px;
        margin: 0px;
        width: auto !important;
        width: 100%;
        max-width: 100%;
    }
</style>

<script>
    //khong cho nhap vao o so luong
    $("[type='number']").keypress(function (evt) {
        evt.preventDefault();
    });
    var globalt = 0;

    //CHON GHE


    function updateTextArea() {

        if ($("input:checked").length) {
            $(".seatStructure *").prop("disabled", true);

            var allSeatsVals = [];
            
            $('#seatsBlock :checked').each(function () {
                allSeatsVals.push($(this).val());
            });

            
            //$('#NumberDisplay').val(allNumberVals);
            $('#seatsDisplay').val(allSeatsVals);
        } else {
            alert("Bạn chưa chọn ghế")
        }
    }


    function myFunction() {
        alert($("input:checked").length);
    }
    //END CHON GHE


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
        document.getElementById("tong").value = tong.reduce(reducer) + " VNĐ";
        console.log(globalt);
        document.getElementById("tongcong").value = parseFloat(tong.reduce(reducer) + globalt) + " VNĐ";
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