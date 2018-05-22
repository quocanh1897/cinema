@extends('master') 
@section('content')

<!-- RAP CHIEU -->
<div id="heading-breadcrumbs">
    <div class="container">
        <div class="row d-flex align-items-center flex-wrap">
            <div class="col-md-7">
                <h1 class="h2">HỆ THỐNG RẠP</h1>
            </div>
            <div class="col-md-5">
                <ul class="breadcrumb d-flex justify-content-end">
                    <li class="breadcrumb-item">
                        <a href="#">Trang chủ</a>
                    </li>
                    <li class="breadcrumb-item active">Rạp</li>
                </ul>
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
                                 
                                    <a href="{{route('rap',$rap->marap)}}" class="mytheatre">
                                        <img src="{{$rap->hinh_anh}} " style="height:200px; width:200px"alt="" class="img-fluid">
                                    </a>
                                
                                <div class="text">
                                    <h4 class="h5">
                                        <a href="{{route('rap',$rap->marap)}}">{{$rap->tenrap}} </a>
                                    </h4>
                                        <p>{{$rap->daichi}} </p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        
                    </div>
                </div>
                <!--
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
            -->
            </div>
        </div>
    </div>
</div>

@endsection