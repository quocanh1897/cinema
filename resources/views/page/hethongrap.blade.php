@extends('master') 
@section('content')

<!-- RAP CHIEU -->
<div id="heading-breadcrumbs">
    <div class="container">
        <div class="row d-flex align-items-center flex-wrap">
            <div class="col-md-7">
                <h1 class="h2">HỆ THỐNG RẠP</h1>
            </div>
            
        </div>
    </div>
</div>
<!-- END RAP CHIEU -->

<div id="content">
    <div class="container">
        <div class="row bar">
            <div class="col-md-12">
                 
                <div class="products-big">
                    <div class="row products">

                        @foreach($rap as $rap)
                        <div class="col-lg-3 col-md-4">
                            <div class="product">
                                <div class="image">
                                    <a href="shop-detail.html">
                                        <img src="sources/img/rapchieu.jpg" alt="" class="img-fluid image1">
                                    </a>
                                </div>
                                <div class="text">
                                    <h3 class="h5">
                                        <a href="shop-detail.html">{{$rap->tenrap}} </a>
                                    </h3>
                                        <p>{{$rap->daichi}} </p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        
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