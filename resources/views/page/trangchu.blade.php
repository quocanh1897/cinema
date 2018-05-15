@extends('master') @section('content')
<section style="background: url('sources/img/photogrid.jpg') center center repeat; background-size: cover;" class="bar background-white relative-positioned">
<div class="container">
  <!-- SLIDER Start-->
  <div class="home-carousel">
    <div class="dark-mask mask-primary"></div>
    <div class="container">
      <div class="homepage owl-carousel">
        @foreach($km as $km)
        <div class="item">
          <div class="row">
            <div class="col-md-5 text-right">

              <h1>{{$km->tenkm}} </h1>

            </div>
            <div class="col-md-7">
              <img src="{{$km->hinhanh}} " alt="" class="img-fluid">
            </div>
          </div>
        </div>
        @endforeach
      </div>
     
    </div>
  </div>
  <!-- END SLIDER -->
</div>
</section>

<div class="col-md-12"><section class="bar bg-gray no-mb text-md-center">
  <div class="container">
    <ul id="pills-tab" role="tablist" class="nav nav-pills nav-justified">
      <li class="nav-item">
        <a id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"
          class="nav-link active">PHIM ĐANG CHIẾU</a>
      </li>
      <li class="nav-item">
        <a id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false"
          class="nav-link ">PHIM SẮP CHIẾU</a>
      </li>
      
    </ul>
    <div id="pills-tabContent" class="tab-content">
<div id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" class="tab-pane fade show active">
  
<div class="row portfolio text-center">
  @foreach($new_phim as $new)

  <div class="col-md-6">
    <div class="box-image"  >
      <div class="image">
        <img src="{{$new->hinhanh}} " alt="" class="img-fluid" height="100" width="300">
        <div class="overlay d-flex align-items-center justify-content-center">
          <div class="content">
            <div class="name">
              <h3>
                <a href="{{route('chi-tiet')}}" class="color-white">{{$new->tenphim}} </a>
              </h3>
            </div>
            <div class="text">
              <p class="d-none d-sm-block"> </p>
              <p class="buttons">
                <a href="{{route('chi-tiet')}}" class="btn btn-template-outlined-white">Chi tiết</a>
                <a href="{{route('chon-phim',$new->maphim)}}" class="btn btn-template-outlined-white">Chọn</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
 
  @endforeach
</div>
</div>
      <div id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" class="tab-pane fade">
      <div class="row portfolio text-center">
  @foreach($pre_phim as $pre)

  <div class="col-md-6">
    <div class="box-image">
      <div class="image">
        <img src="{{$pre->hinhanh}} " alt="" class="img-fluid" height="100" width="300">
        <div class="overlay d-flex align-items-center justify-content-center">
          <div class="content">
            <div class="name">
              <h3>
                <a href="{{route('chi-tiet')}}" class="color-white">{{$pre->tenphim}} </a>
              </h3>
            </div>
            <div class="text">
              <p class="d-none d-sm-block"> </p>
              <p class="buttons">
                <a href="{{route('chi-tiet')}}" class="btn btn-template-outlined-white">Chi tiết</a>
                <a href="{{route('chon-phim',$pre->maphim)}}" class="btn btn-template-outlined-white">Chọn</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
 
  @endforeach
</div>
    </div>
      
    </div>
  </div>
</section></div>



<section style="background: url('sources/img/fixed-background-2.jpg') center top no-repeat; background-size: cover;" class="bar no-mb color-white text-center bg-fixed relative-positioned">
  <div class="dark-mask"></div>
  <div class="container">
    <div class="icon icon-outlined icon-lg">
      <i class="fa fa-file-code-o"></i>
    </div>
    <h3 class="text-uppercase">Bạn muốn nhận ưu đãi?</h3>
    <p class="lead">Hãy đăng ký thành viên để được hưởng những khuyến mãi hấp dẫn nhất! </p>
    <p class="text-center">
      <a href="dang-ky" class="btn btn-template-outlined-white btn-lg">Đăng ký ngay</a>
    </p>
  </div>
</section>

@endsection