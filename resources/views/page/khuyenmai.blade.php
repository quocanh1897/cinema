@extends('master') 
@section('content')

<!-- km CHIEU -->
<div id="heading-breadcrumbs">
    <div class="container">
        <div class="row d-flex align-items-center flex-wkm">
            <div class="col-md-7">
                <h1 class="h2">KHUYẾN MÃI</h1>
            </div>
            
        </div>
    </div>
</div>
<!-- END km CHIEU -->

<div id="content">
    <div class="container">
        <div class="row bar">
            <div class="col-md-12">
                 
                <div class="products-big">
                    <div class="row products">

                        @foreach($khuyenmai as $km)
                        <div class="col-lg-3 col-md-4">
                            <div class="product">
                                
                                    <a href="{{$km->hinhanh}}" class="mytheatre">
                                        <img src="{{$km->hinhanh}} " style="height:150px; width:300px"alt="" class="img-fluid">
                                    </a>
                                
                                <div class="text">
                                    <h4 class="h5">
                                        <a href="{{$km->hinhanh}}">{{$km->tenkm}} </a>
                                    </h4>
                                        
                                        <p>Từ ngày {{$km->batdau}}</p>  
                                        <p>đến ngày {{$km->ketthuc}} </p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection