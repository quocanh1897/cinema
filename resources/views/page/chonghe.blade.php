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
                                        <td> 1</td>
                                        <td> 2</td>
                                        <td> 3</td>
                                        <td> 4</td>
                                        <td> 5</td>
                                        <td> 6</td>
                                        <td> 7</td>
                                        <td> 8</td>
                                        <td> 9</td>
                                        <td>10</td>
                                        <td>11</td>
                                        <td>12</td>
                                    </tr>
                                    
                                    @foreach($tatcaghe as $ghe)
                                    @if($ghe->soghe == "A1")
                                    <tr>
                                        <td>A</td>
                                    @endif

                                    @if($ghe->soghe == "B1")
                                    <tr>
                                        <td>B</td>
                                    @endif

                                    @if($ghe->soghe == "C1")
                                    <tr>
                                        <td>C</td>
                                    @endif

                                    @if($ghe->soghe == "D1")
                                    <tr>
                                        <td>D</td>
                                    @endif

                                    @if($ghe->soghe == "E1")
                                    <tr>
                                        <td>E</td>
                                    @endif
                                    @if($ghe->soghe == "F1")
                                    <tr>
                                        <td>F</td>
                                    @endif

                                    @if($ghe->soghe == "G1")
                                    <tr>
                                        <td>G</td>
                                    @endif

                                    @if($ghe->soghe == "H1")
                                    <tr>
                                        <td>H</td>
                                    @endif

                                    @if($ghe->soghe == "I1")
                                    <tr>
                                        <td>I</td>
                                    @endif

                                    @if($ghe->soghe == "J1")
                                    <tr>
                                        <td>J</td>
                                        <td>
                                                @if($ghe->tinhtrang == "1")
                                                <input type="checkbox" class="redBox" checked value="{{$ghe->soghe}}">
                                                @else 
                                                <input type="checkbox" class="seats" value="{{$ghe->soghe}}">
                                                @endif
                                        </td>   
                                    
                                    @elseif($ghe->soghe == "J12")
                                        <td>
                                            @if($ghe->tinhtrang == "1")
                                            <input type="checkbox" class="redBox" checked value="{{$ghe->soghe}}">
                                            @else 
                                            <input type="checkbox" class="seats" value="{{$ghe->soghe}}">
                                            @endif
                                        </td> 
                                    
                                    @else
                                        <td>
                                                @if($ghe->tinhtrang == "1")
                                                <input type="checkbox" class="redBox" checked value="{{$ghe->soghe}}">
                                                @else 
                                                <input type="checkbox" class="seats" value="{{$ghe->soghe}}">
                                                @endif
                                        </td>  
                                    @endif

                                    
                                    
                                    @endforeach

                                   
                                </table>


                                <div class="row">
                                    <input type="hidden" id="giaghe" value="{{$giaghe}} ">
                                    <input type="hidden" id="giadv" value="{{$giadv}} ">
                                    <div class="col-md-4"><button class="btn btn-template-outlined" onclick="updateTextArea()">Xác nhận chọn ghế</button></div>
                                    <div class="col-md-4"><input type="text" id="seatsDisplay" value="" disabled></input></div>
                                    <div class="col-md-4"><input type="text" id="seatsDisplayBill" value="" disabled></input></div>
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
                            <button type="submit" class="btn btn-template-outlined" id="db_btn">Đi đến thanh toán
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

tableS,td {
margin: 0;
padding: 10px;
border: 0;
font-size: 100%;
font: inherit;
vertical-align: baseline;
}

input[type=checkbox] {
    width: 15px;
    margin-right: 5px;
    cursor: pointer;
}

input[type=checkbox]:before {
    content: "";
    width: 30px;
    height: 30px;
    display: inline-block;
    vertical-align: middle;
    text-align: center;
    border: 1px solid #ff9800;
    box-shadow: inset 0px 2px 3px 0px rgba(0, 0, 0, .3), 0px 1px 0px 0px rgba(255, 255, 255, .8);
    -moz-box-shadow: inset 0px 2px 3px 0px rgba(0, 0, 0, .3), 0px 1px 0px 0px rgba(255, 255, 255, .8);
    -webkit-box-shadow: inset 0px 2px 3px 0px rgba(0, 0, 0, .3), 0px 1px 0px 0px rgba(255, 255, 255, .8);
    background-color: #ffffff;
}

input[type=checkbox]:checked:before {
    background-color: Green;
    font-size: 15px;
}

h2.wthree {
	text-align: center;
    padding: 0.8em;
    font-size: 1.2em;
	color: black;
	background-color: tomato;
    text-transform: uppercase;
    font-weight: 600;
    letter-spacing: 7px;
    word-spacing: 10px;
}

.tableS {
    display: table;
    border-collapse: separate;
    border-spacing: 10px;
    border-color: grey;
}

.seats {
    border: 1px solid red;
    background: yellow;
}


.redBox:checked:before {
	background-color: Red !important;
	font-size: 15px;
}

.seatGap {
    width: 40px;
}

.displayerBoxes {
    margin-top: 2em;
}
.seatVGap {
    height: 40px;
}

.Displaytable td,
.Displaytable th {
    width: 100%;
    padding: 7px 10px;
    color: #000;
    font-weight: 600;
}

table.Displaytable tr {
    background: #fff;
    color: #fff;
}

td {
    width: 40px;
    font-weight: 600;
    font-size: 1em;
    padding-top: 7px;
    height: 24px;
    color: rgb(0, 0, 0);
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
        console.log( $("input.seats:checked"));
        
        //console.log(selectedSeats);
        if ($("input.seats:checked").length) {
            $(".seatStructure *").prop("disabled", true);

            var allSeatsVals = [];
            
            $('input.seats:checked').each(function () {
                allSeatsVals.push($(this).val());
            });

            var giaghe = document.getElementById("giaghe").value;
            var giadv = document.getElementById("giadv").value;
            //display
            $('#seatsDisplay').val(allSeatsVals);
            $('#seatsDisplayBill').val(parseFloat( allSeatsVals.length*giaghe) + " VNĐ" );
            $('#gheso').val(allSeatsVals);
            $('#tongcong').val(parseFloat(parseFloat( allSeatsVals.length*giaghe) +parseFloat( giadv)) + " VNĐ")
        } else {
            alert("Bạn chưa chọn ghế")
        }
    }


    function myFunction() {
        alert($("input.seats:checked").length);
    }
    //END CHON GHE


    
</script>


@endsection