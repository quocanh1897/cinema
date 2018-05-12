@extends('master') 
@section('content')

<!-- PHIM DANG CHIEU -->
<div id="heading-breadcrumbs">
    <div class="container">
        <div class="row d-flex align-items-center flex-wrap">
            <div class="col-md-7">
                <h1 class="h2">LỊCH CHIẾU THEO PHIM</h1>
            </div>
            <div class="col-md-5">
                <ul class="breadcrumb d-flex justify-content-end">
                    <li class="breadcrumb-item">
                        <a href="phim-sap-chieu">PHIM SẮP CHIẾU</a>
                    </li>
                    <li class="breadcrumb-item active">PHIM ĐANG CHIẾU</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- END PHIM DANG CHIEU -->

<div id="content">
    <div class="container">
        <div class="row bar">
            <div class="col-md-12">
                <p class="text-muted lead text-center">In our Ladies department we offer wide selection of the best products we have found and carefully selected
                    worldwide. Pellentesque habitant morbi tristique senectus et netuss.</p>
                <div class="products-big">
                    <div class="row products">
                        <div class="col-lg-3 col-md-4">
                            <div class="product">
                                <div class="image">
                                    <a href="{{route('chi-tiet')}}">
                                        <img src="sources/img/product1.jpg" alt="" class="img-fluid image1">
                                    </a>
                                </div>
                                <div class="text">
                                    <h3 class="h5">
                                        <a href="{{route('chi-tiet')}}">PHIM NÀY ĐANG CHIẾU</a>
                                    </h3>
                                    <p class="price">$143.00</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4">
                            <div class="product">
                                <div class="image">
                                    <a href="{{route('chi-tiet')}}">
                                        <img src="sources/img/product2.jpg" alt="" class="img-fluid image1">
                                    </a>
                                </div>
                                <div class="text">
                                    <h3 class="h5">
                                        <a href="{{route('chi-tiet')}}">White Blouse Armani</a>
                                    </h3>
                                    <p class="price">
                                        <del>$280</del> $143.00
                                    </p>
                                </div>
                                <div class="ribbon-holder">
                                    <div class="ribbon sale">SALE</div>
                                    <div class="ribbon new">NEW</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4">
                            <div class="product">
                                <div class="image">
                                    <a href="{{route('chi-tiet')}}">
                                        <img src="sources/img/product3.jpg" alt="" class="img-fluid image1">
                                    </a>
                                </div>
                                <div class="text">
                                    <h3 class="h5">
                                        <a href="{{route('chi-tiet')}}">Black Blouse Versace</a>
                                    </h3>
                                    <p class="price">$143.00</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4">
                            <div class="product">
                                <div class="image">
                                    <a href="{{route('chi-tiet')}}">
                                        <img src="sources/img/product4.jpg" alt="" class="img-fluid image1">
                                    </a>
                                </div>
                                <div class="text">
                                    <h3 class="h5">
                                        <a href="{{route('chi-tiet')}}">Black Blouse Versace</a>
                                    </h3>
                                    <p class="price">$143.00</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4">
                            <div class="product">
                                <div class="image">
                                    <a href="{{route('chi-tiet')}}">
                                        <img src="sources/img/product3.jpg" alt="" class="img-fluid image1">
                                    </a>
                                </div>
                                <div class="text">
                                    <h3 class="h5">
                                        <a href="{{route('chi-tiet')}}">White Blouse Armani</a>
                                    </h3>
                                    <p class="price">
                                        <del>$280</del> $143.00
                                    </p>
                                </div>
                                <div class="ribbon-holder">
                                    <div class="ribbon sale">SALE</div>
                                    <div class="ribbon new">NEW</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4">
                            <div class="product">
                                <div class="image">
                                    <a href="{{route('chi-tiet')}}">
                                        <img src="sources/img/product4.jpg" alt="" class="img-fluid image1">
                                    </a>
                                </div>
                                <div class="text">
                                    <h3 class="h5">
                                        <a href="{{route('chi-tiet')}}">White Blouse Versace</a>
                                    </h3>
                                    <p class="price">$143.00</p>
                                </div>
                                <div class="ribbon-holder">
                                    <div class="ribbon new">NEW</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4">
                            <div class="product">
                                <div class="image">
                                    <a href="{{route('chi-tiet')}}">
                                        <img src="sources/img/product2.jpg" alt="" class="img-fluid image1">
                                    </a>
                                </div>
                                <div class="text">
                                    <h3 class="h5">
                                        <a href="{{route('chi-tiet')}}">White Blouse Versace</a>
                                    </h3>
                                    <p class="price">$143.00</p>
                                </div>
                                <div class="ribbon-holder">
                                    <div class="ribbon new">NEW</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4">
                            <div class="product">
                                <div class="image">
                                    <a href="{{route('chi-tiet')}}">
                                        <img src="sources/img/product1.jpg" alt="" class="img-fluid image1">
                                    </a>
                                </div>
                                <div class="text">
                                    <h3 class="h5">
                                        <a href="{{route('chi-tiet')}}">Fur coat</a>
                                    </h3>
                                    <p class="price">$143.00</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 banner mb-small text-center">
                        <a href="#">
                            <img src="sources/img/banner2.jpg" alt="" class="img-fluid">
                        </a>
                    </div>
                </div>
                <div class="pages">
                    <p class="loadMore text-center">
                        <a href="#" class="btn btn-template-outlined">
                            <i class="fa fa-chevron-down"></i> Load more</a>
                    </p>
                    <nav aria-label="Page navigation example" class="d-flex justify-content-center">
                        <ul class="pagination">
                            <li class="page-item">
                                <a href="#" class="page-link">
                                    <i class="fa fa-angle-double-left"></i>
                                </a>
                            </li>
                            <li class="page-item active">
                                <a href="#" class="page-link">1</a>
                            </li>
                            <li class="page-item">
                                <a href="#" class="page-link">2</a>
                            </li>
                            <li class="page-item">
                                <a href="#" class="page-link">3</a>
                            </li>
                            <li class="page-item">
                                <a href="#" class="page-link">4</a>
                            </li>
                            <li class="page-item">
                                <a href="#" class="page-link">5</a>
                            </li>
                            <li class="page-item">
                                <a href="#" class="page-link">
                                    <i class="fa fa-angle-double-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection