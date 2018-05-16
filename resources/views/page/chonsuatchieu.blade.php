@extends('master') 
@section('content')
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
            <div id="checkout" class="col-lg-9">
                <div class="box border-bottom-0">
                    <form method="get" action="shop-checkout2.html">
                        <ul class="nav nav-pills nav-fill">
                            <li class="nav-item">
                                <a   class="nav-link disabled">
                                    <i class="fa fa-map-marker"></i>
                                    <br>Chọn phim</a>
                            </li>
                            <li class="nav-item">
                                <a  class="nav-link disabled">
                                    <i class="fa fa-truck"></i>
                                    <br>Chọn rạp</a>
                            </li>
                            <li class="nav-item">
                                <a  class="nav-link active">
                                    <i class="fa fa-money"></i>
                                    <br>Chọn ngày</a>
                            </li>
                        </ul>
                        <section>
                            <div id="accordion" role="tablist">

                            @foreach($suatchieu as $sc)
                                <div class="card card-primary">
                                    <div id="headingOne" role="tab" class="card-header">
                                        <h5 class="mb-0 mt-0">
                                            <a data-toggle="collapse" href="#{{$day}}" aria-expanded="false" aria-controls="{{$day}}">{{$sc->ngaychieu}} </a>
                                        </h5>
                                    </div>
                                    <div id="{{$day}}" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion" class="collapse">
                                        <div id="suatchieu-btn" class="card-body portfolio row">
                                            @foreach($suatchieu as $sc)
                                            <button type="button" class="btn btn-outline-dark">{{$sc->khunggio}} </button>
                                            
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach   
                            </div>

                        </section>
                        <div class="box-footer d-flex flex-wrap align-items-center justify-content-between">
                            <div class="left-col">
                                <a href="{{route('chon-rap',$phimDaChon->first()->maphim)}}" class="btn btn-secondary mt-0">
                                    <i class="fa fa-chevron-left"></i>Quay lại</a>
                            </div>
                            <div class="right-col">
                                <button type="submit" class="btn btn-template-main">Bước kế
                                    <i class="fa fa-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-3">
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
                                    <th>{{$rapDaChon->first()->tenrap}}</th>
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

<script>
// Add active class to the current button (highlight it)
var header = document.getElementById("suatchieu-btn");
var btns = document.getElementsByClassName("btn-outline-dark");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
    var current = document.getElementsByClassName("active");
    current[0].className = current[0].className.replace(" active", "");
    this.className += " active";
  });
}
</script>
@endsection