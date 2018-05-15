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
                                                <img src="img/detailsquare.jpg" alt="White Blouse Armani" class="img-fluid">
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
                                                <img src="img/basketsquare.jpg" alt="Black Blouse Armani" class="img-fluid">
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
                                                <img src="img/detailsquare.jpg" alt="White Blouse Armani" class="img-fluid">
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
                                                <img src="img/basketsquare.jpg" alt="Black Blouse Armani" class="img-fluid">
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
                                                <img src="img/basketsquare.jpg" alt="Black Blouse Armani" class="img-fluid">
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
                            <img src="img/basketsquare.jpg" alt="Black Blouse Armani" class="img-fluid">
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
<div id="content2">
    <div class="container">
        <div class="row bar">
            <div class="col-lg-12">
                <p class="text-muted lead">Chọn ghế ngồi</p>
            </div>
            <div id="basket" class="col-lg-9">
                <div class="box mt-0 pb-0 no-horizontal-padding">
                    <form method="get">
                        <div class="bg-primary bar padding-horizontal ">
                            <div class="panel-body" align="center">
                                <ul class="tag-cloud list-inline">
                                    <li class="list-inline-item">A</li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">1</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">2</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">3</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">4</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">5</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">6</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">7</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">8</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">9</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">10</button>
                                    </li>
                                    <li class="list-inline-item">A</li>
                                </ul>
                                <ul class="tag-cloud list-inline">
                                    <li class="list-inline-item">B</li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">1</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">2</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">3</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">4</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">5</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">6</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">7</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">8</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">9</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">10</button>
                                    </li>
                                    <li class="list-inline-item">B</li>
                                </ul>
                                <ul class="tag-cloud list-inline">
                                    <li class="list-inline-item">C</li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">1</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">2</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">3</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">4</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">5</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">6</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">7</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">8</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">9</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">10</button>
                                    </li>
                                    <li class="list-inline-item">C</li>
                                </ul>
                                <ul class="tag-cloud list-inline">
                                    <li class="list-inline-item">D</li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">1</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">2</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">3</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">4</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">5</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">6</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">7</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">8</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">9</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">10</button>
                                    </li>
                                    <li class="list-inline-item">D</li>
                                </ul>
                                <ul class="tag-cloud list-inline">
                                    <li class="list-inline-item">E</li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">1</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">2</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">3</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">4</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">5</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">6</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">7</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">8</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">9</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">10</button>
                                    </li>
                                    <li class="list-inline-item">E</li>
                                </ul>
                                <ul class="tag-cloud list-inline">
                                    <li class="list-inline-item">F</li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">1</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">2</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">3</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">4</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">5</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">6</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">7</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">8</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">9</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">10</button>
                                    </li>
                                    <li class="list-inline-item">F</li>
                                </ul>
                                <ul class="tag-cloud list-inline">
                                    <li class="list-inline-item">G</li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">1</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">2</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">3</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">4</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">5</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">6</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">7</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">8</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">9</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">10</button>
                                    </li>
                                    <li class="list-inline-item">G</li>
                                </ul>
                                <ul class="tag-cloud list-inline">
                                    <li class="list-inline-item">H</li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">1</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">2</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">3</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">4</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">5</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">6</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">7</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">8</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">9</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-template-outlined-white">10</button>
                                    </li>
                                    <li class="list-inline-item">H</li>
                                </ul>
                            </div>


                        </div>
                        <div class="box-footer d-flex justify-content-between align-items-center">
                            <div class="left-col">
                                <a href="index.html" class="btn btn-secondary mt-0">
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
                            <img src="img/basketsquare.jpg" alt="Black Blouse Armani" class="img-fluid">
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
<script language="javascript">
    document.getElementById("content2").style.display = 'none';
    document.getElementById("db_btn").onclick = function () {
        document.getElementById("content1").style.display = 'none';
        document.getElementById("content2").style.display = 'block';
    };
</script>

@endsection