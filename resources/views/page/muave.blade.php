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
                                        <th>Số lượng</th>
                                        <th>Đơn giá</th>
                                        <th colspan="2">Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <form id="forms"onsubmit="return false;">
                                    @foreach($dichvu as $dv)
                                    <tr>
                                        <td>
                                            
                                            <img src="{{$dv->hinhanh}} " alt="dichvu" class="img-fluid">
                                            
                                        </td>
                                        <td>
                                            <a >{{$dv->tendv}} </a>
                                        </td>
                                        <td>
                                            <input id="soluong_{{$dv->madv}}" class="cacsl" type="number" value="0" step="1" min="0" max="10" style="font: 20pt Courier" >
                                        </td>
                                        <td><input type="text" class="form-control" id="gia_{{$dv->madv}}" value="{{$dv->gia}}" disabled></td>
                                        <td><input type="text" class="form-control" id="tong_{{$dv->madv}}" value="" disabled></td>
                                    </tr>
                                    @endforeach
                                    </form>                                    

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="4">Tổng</th>
                                        <th colspan="2" ><input id="tong" type="text" class="form-control" value="" disabled></th>
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
                         
                            <div id="selectseat" class="main">
                                <div class="demo col-lg-12">
                                    <div id="seat-map">
                                        <div class="front">MÀN HÌNH</div>
                                    </div>
                                    <div class="booking-details">
                                        <ul class="book-left">
                                            <li>Số lượng</li>
                                            <li>Thành tiền:</li>
                                            <li>Ghế số:</li>
                                        </ul>
                                        <ul class="book-right">

                                            <li>:
                                                <span id="counter">0</span>
                                            </li>
                                            <li>:
                                                <b>
                                                    
                                                    <span id="total">0</span>
                                                    <i>VNĐ</i>
                                                </b>
                                            </li>
                                        </ul>
                                        <div class="clear"></div>
                                        <ul id="selected-seats" ></ul>


                                        
                                        <div id="legend"></div>
                                    </div>
                                    <div style="clear:both"></div>
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
                    <div class="box-header mt-0"  align="center">
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
                                <tr class="total">
                                    <td colspan="3"><input type="text" id="tongcong" class="form-control" value="" disabled></td> 
                                     
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
    //tinh toan gia ghe
    var price = 45000; //price
    $(document).ready(function ($) {
        var $cart = $('#selected-seats'), //Sitting Area
            $counter = $('#counter'), //Votes
            $total = $('#total'); //Total money
        var sc = $('#seat-map').seatCharts({
            map: [ //Seating chart
                'Aaaaaaaaaa',
                'Baaaaaaaaa',
                'aaaaaaaaaa',
                'aaaaaaaaaa',
                'aaaaaaaaaa',
                'aaaaaaaaaa',
                'aaaaaaaaaa',
                'aaaaaaaaaa',
                
            ],
            naming: {
                top: false,
                getLabel: function (character, row, column) {
                    return column;
                }
            },
            legend: { //Definition legend
                node: $('#legend'),
                items: [
                    ['a', 'available', 'Ghế trống'],
                    ['a', 'unavailable', 'Có người'],
                    ['a', 'selected', 'Chọn'],
                    ['a', '4dx', "4DX"]
                ]
            },
            click: function () { //Click event
                if (this.status() == 'available') { //optional seat
                    $('<li>Row' + (this.settings.row + 1) + ' Seat' + this.settings.label +
                            '</li>')
                        .attr('id', 'cart-item-' + this.settings.id)
                        .data('seatId', this.settings.id)
                        .appendTo($cart);
                    $counter.text(sc.find('selected').length + 1);
                    $total.text(recalculateTotal(sc) + price);
                    return 'selected';
                } else if (this.status() == 'selected') { //Checked
                    //Update Number
                    $counter.text(sc.find('selected').length - 1);
                    //update totalnum
                    $total.text(recalculateTotal(sc) - price);
                    //Delete reservation
                    $('#cart-item-' + this.settings.id).remove();
                    //optional
                    return 'available';
                } else if (this.status() == 'unavailable') { //sold
                    return 'unavailable';
                } else {
                    return this.style();
                }
            }
        });
        //sold seat
        sc.get(['1_2', '4_4', '4_5', '6_6', '6_7', '8_5', '8_6', '8_7', '8_8', '10_1', '10_2']).status(
            'unavailable');
    });
    //sum total money
    function recalculateTotal(sc) {
        var total = 0;
        sc.find('selected').each(function () {
            total += price;
        });
        globalt = total;
        return total;
    }
    //CALCULATE TOTAL BILL
    var cacsl = document.getElementsByClassName("cacsl");
    var num = cacsl.length;
    var soluong = [];
    for (i = 1; i <= num; i++) {
        soluong.push('#soluong_' + i);
    }
    var getTotal = function () {
        var tong=[];
        document.getElementById("tong").value = 0;
        for (i = 1; i <= num; i++) {
            
            var soluong = document.getElementById("soluong_" + i).value;
            
            var dongia = document.getElementById("gia_" + i).value;
            tong.push(soluong*dongia);
            var thanhtien = document.getElementById("tong_" + i).value = soluong * dongia + " VNĐ";
            
           
        }
        const reducer = (accumulator, currentValue) => accumulator + currentValue;
        document.getElementById("tong").value = tong.reduce(reducer) + " VNĐ";
        console.log(globalt);
        document.getElementById("tongcong").value = parseFloat(tong.reduce(reducer) + globalt)+ " VNĐ" ;
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