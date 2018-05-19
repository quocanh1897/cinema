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
                    <form method="get">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th colspan="2">Loại ghế</th>
                                        <th>Số lượng</th>
                                        <th>Đơn giá</th>
                                        <th colspan="2">Tổng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <a href="#">
                                                <img src="sources/img/detailsquare.jpg" alt="White Blouse Armani" class="img-fluid">
                                            </a>
                                        </td>
                                        <td>
                                            <a href="#">Ghế loại 1</a>
                                        </td>
                                        <td>
                                            <input type="number" value="2" class="form-control">
                                        </td>
                                        <td>75,000 VNĐ</td>
                                        <td>150,000 VNĐ</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="#">
                                                <img src="sources/img/basketsquare.jpg" alt="Black Blouse Armani" class="img-fluid">
                                            </a>
                                        </td>
                                        <td>
                                            <a href="#">Ghế loại 2</a>
                                        </td>
                                        <td>
                                            <input type="number" value="1" class="form-control">
                                        </td>
                                        <td>50,000 VNĐ</td>
                                        <td>50,000 VNĐ</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="4">Tổng cộng</th>
                                        <th colspan="2">200,000 VNĐ</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th colspan="2">Dịch vụ</th>
                                        <th>Số lượng</th>
                                        <th>Đơn giá</th>
                                        <th colspan="2">Tổng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <a href="#">
                                                <img src="sources/img/detailsquare.jpg" alt="White Blouse Armani" class="img-fluid">
                                            </a>
                                        </td>
                                        <td>
                                            <a href="#">Combo 1</a>
                                        </td>
                                        <td>
                                            <input type="number" value="2" class="form-control">
                                        </td>
                                        <td>75,000 VNĐ</td>
                                        <td>150,000 VNĐ</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="#">
                                                <img src="sources/img/basketsquare.jpg" alt="Black Blouse Armani" class="img-fluid">
                                            </a>
                                        </td>
                                        <td>
                                            <a href="#">Combo 2</a>
                                        </td>
                                        <td>
                                            <input type="number" value="1" class="form-control">
                                        </td>
                                        <td>50,000 VNĐ</td>
                                        <td>50,000 VNĐ</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="#">
                                                <img src="sources/img/basketsquare.jpg" alt="Black Blouse Armani" class="img-fluid">
                                            </a>
                                        </td>
                                        <td>
                                            <a href="#">Combo 3</a>
                                        </td>
                                        <td>
                                            <input type="number" value="1" class="form-control">
                                        </td>
                                        <td>60,000 VNĐ</td>
                                        <td>60,000 VNĐ</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="4">Tổng cộng</th>
                                        <th colspan="2">260,000 VNĐ</th>
                                    </tr>
                                </tfoot>
                            </table>
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
                    </form>
                </div>
            </div>
            <div class="col-lg-3">
                <div id="order-summary" class="box mt-0 mb-4 p-0">
                    <div class="box-header mt-0">
                        <h3>
                            <img src="sources/img/basketsquare.jpg" alt="Black Blouse Armani" class="img-fluid">
                        </h3>
                    </div>
                    <p class="text-muted" align="center">Tên phim</p>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Rạp:</td>
                                    <th>Aeon Mall</th>
                                </tr>
                                <tr>
                                    <td>Suất chiếu</td>
                                    <th>Ngày | Giờ</th>
                                </tr>
                                <tr class="total">
                                    <td>Total</td>
                                    <th>460,000 VNĐ</th>
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
                    <form>
                        <div class="input-group">
                            <input type="text" class="form-control">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-template-main">
                                    <i class="fa fa-gift"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SELECT SEATS -->
<div>

    <div class="main">

         
            <div id="seat-map">
                <div class="front">MÀN HÌNH</div>
            </div>
            <div class="booking-details">
                <ul class="book-left">
                    <li>Số lượng</li>
                    <li>Giá</li>
                    <li>Ghế số:</li>
                </ul>
                <ul class="book-right">

                    <li>:
                        <span id="counter">0</span>
                    </li>
                    <li>:
                        <b>
                            <i>$</i>
                            <span id="total">0</span>
                        </b>
                    </li>
                </ul>
                <div class="clear"></div>
                <ul id="selected-seats" class="scrollbar scrollbar1"></ul>


                <button class="checkout-button">Book Now</button>
                <div id="legend"></div>
            </div>
            <div style="clear:both"></div>
        


    </div>
    
</div>

<script>
    var price = 10; //price
    $(document).ready(function ($) {
        var $cart = $('#selected-seats'), //Sitting Area
            $counter = $('#counter'), //Votes
            $total = $('#total'); //Total money

        var sc = $('#seat-map').seatCharts({
            map: [ //Seating chart
                'aaaaaaaaaa',
                'aaaaaaaaaa',
                '__________',
                'aaaaaaaa__',
                'aaaaaaaaaa',
                'aaaaaaaaaa',
                'aaaaaaaaaa',
                'aaaaaaaaaa',
                'aaaaaaaaaa',
                '__aaaaaa__'
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
                    ['a', 'available', 'Available'],
                    ['a', 'unavailable', 'Sold'],
                    ['a', 'selected', 'Selected']
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

        return total;
    }
</script>
<script src="sources/js/jquery.nicescroll.js"></script>
<script src="sources/js/scripts.js"></script>

@endsection