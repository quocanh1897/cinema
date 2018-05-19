@extends('master') @section('content')
<!-- SLIDER Start-->
<script src="sources/js/jssor.slider-27.1.0.min.js" type="text/javascript"></script>
<script type="text/javascript">
  jssor_1_slider_init = function () {

    var jssor_1_SlideoTransitions = [
      [{
        b: -1,
        d: 1,
        o: -0.7
      }],
      [{
        b: 900,
        d: 2000,
        x: -379,
        e: {
          x: 7
        }
      }],
      [{
        b: 900,
        d: 2000,
        x: -379,
        e: {
          x: 7
        }
      }],
      [{
        b: -1,
        d: 1,
        o: -1,
        sX: 2,
        sY: 2
      }, {
        b: 0,
        d: 900,
        x: -171,
        y: -341,
        o: 1,
        sX: -2,
        sY: -2,
        e: {
          x: 3,
          y: 3,
          sX: 3,
          sY: 3
        }
      }, {
        b: 900,
        d: 1600,
        x: -283,
        o: -1,
        e: {
          x: 16
        }
      }]
    ];

    var jssor_1_options = {
      $AutoPlay: 1,
      $SlideDuration: 800,
      $SlideEasing: $Jease$.$OutQuint,
      $CaptionSliderOptions: {
        $Class: $JssorCaptionSlideo$,
        $Transitions: jssor_1_SlideoTransitions
      },
      $ArrowNavigatorOptions: {
        $Class: $JssorArrowNavigator$
      },
      $BulletNavigatorOptions: {
        $Class: $JssorBulletNavigator$
      }
    };

    var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

    /*#region responsive code begin*/

    var MAX_WIDTH = 3000;

    function ScaleSlider() {
      var containerElement = jssor_1_slider.$Elmt.parentNode;
      var containerWidth = containerElement.clientWidth;

      if (containerWidth) {

        var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);

        jssor_1_slider.$ScaleWidth(expectedWidth);
      } else {
        window.setTimeout(ScaleSlider, 30);
      }
    }

    ScaleSlider();

    $Jssor$.$AddEvent(window, "load", ScaleSlider);
    $Jssor$.$AddEvent(window, "resize", ScaleSlider);
    $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
    /*#endregion responsive code end*/
  };
</script>
<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300italic,regular,italic,700,700italic&subset=latin-ext,greek-ext,cyrillic-ext,greek,vietnamese,latin,cyrillic"
  rel="stylesheet" type="text/css" />
<style>
  /*jssor slider loading skin spin css*/

  .jssorl-009-spin img {
    animation-name: jssorl-009-spin;
    animation-duration: 1.6s;
    animation-iteration-count: infinite;
    animation-timing-function: linear;
  }

  @keyframes jssorl-009-spin {
    from {
      transform: rotate(0deg);
    }
    to {
      transform: rotate(360deg);
    }
  }

  /*jssor slider bullet skin 032 css*/

  .jssorb032 {
    position: absolute;
  }

  .jssorb032 .i {
    position: absolute;
    cursor: pointer;
  }

  .jssorb032 .i .b {
    fill: #fff;
    fill-opacity: 0.7;
    stroke: #000;
    stroke-width: 1200;
    stroke-miterlimit: 10;
    stroke-opacity: 0.25;
  }

  .jssorb032 .i:hover .b {
    fill: #000;
    fill-opacity: .6;
    stroke: #fff;
    stroke-opacity: .35;
  }

  .jssorb032 .iav .b {
    fill: #000;
    fill-opacity: 1;
    stroke: #fff;
    stroke-opacity: .35;
  }

  .jssorb032 .i.idn {
    opacity: .3;
  }

  /*jssor slider arrow skin 051 css*/

  .jssora051 {
    display: block;
    position: absolute;
    cursor: pointer;
  }

  .jssora051 .a {
    fill: none;
    stroke: #fff;
    stroke-width: 360;
    stroke-miterlimit: 10;
  }

  .jssora051:hover {
    opacity: .8;
  }

  .jssora051.jssora051dn {
    opacity: .5;
  }

  .jssora051.jssora051ds {
    opacity: .3;
    pointer-events: none;
  }
</style>
<div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:1300px;height:700px;overflow:hidden;visibility:hidden;">
  <!-- Loading Screen -->
  <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
    <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="sources/img/spin.svg">
  </div>
  <!-- Slider img -->
  <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:1300px;height:700px;overflow:hidden;">
    @foreach($km as $km)
    <div data-p="225.00">
      <img data-u="image" src="{{$km->hinhanh}}">

    </div>
    @endforeach
  </div>
  <!-- Bullet Navigator -->
  <div data-u="navigator" class="jssorb032" style="position:absolute;bottom:12px;right:12px;" data-autocenter="1" data-scale="0.5"
    data-scale-bottom="0.75">
    <div data-u="prototype" class="i" style="width:16px;height:16px;">
      <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
        <circle class="b" cx="8000" cy="8000" r="5800"></circle>
      </svg>
    </div>
  </div>
  <!-- Arrow Navigator -->
  <div data-u="arrowleft" class="jssora051" style="width:65px;height:65px;top:0px;left:25px;" data-autocenter="2" data-scale="0.75"
    data-scale-left="0.75">
    <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
      <polyline class="a" points="11040,1920 4960,8000 11040,14080 "></polyline>
    </svg>
  </div>
  <div data-u="arrowright" class="jssora051" style="width:65px;height:65px;top:0px;right:25px;" data-autocenter="2" data-scale="0.75"
    data-scale-right="0.75">
    <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
      <polyline class="a" points="4960,1920 11040,8000 4960,14080 "></polyline>
    </svg>
  </div>
</div>
<script type="text/javascript">
  jssor_1_slider_init();
</script>
<!-- END SLIDER -->


<div>
  <section class="bar bg-gray no-mb text-md-center">
    <div class="container" >
      <ul id="pills-tab" role="tablist" class="nav nav-pills nav-justified" >
        <li class="nav-item">
          <a id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true" 
          class="nav-link active">PHIM ĐANG CHIẾU</a>
        </li>
        <li class="nav-item">
          <a id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false"
            class="nav-link ">PHIM SẮP CHIẾU</a>
        </li>

      </ul>
      <div id="pills-tabContent" class="tab-content"  >
        <div id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" class="tab-pane fade show active">

          <div class="row portfolio text-center" >
            @foreach($new_phim as $new)

            <div class="col-md-6">
              <div class="box-image">
                <div class="image">
                  <img src="{{$new->hinhanh}} " alt="" class="img-fluid" height="100" width="300">
                  <div class="overlay d-flex align-items-center justify-content-center">
                    <div class="content">
                      <div class="name">
                        <h3>
                          <a href="{{route('chi-tiet',$new->maphim)}}" class="color-white">{{$new->tenphim}} </a>
                        </h3>
                      </div>
                       
                        <form action="{{route('chon-phim')}}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        
                          <a href="{{route('chi-tiet',$new->maphim)}}" class="btn btn-template-outlined-white">Chi tiết</a>
                          <button name="idphim" type="submit" value="{{$new->maphim}}"  class="btn btn-template-outlined-white">Chọn</button>
                          
                        
                        </form>
                       
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
            @foreach($pre_phim as $pr)

            <div class="col-md-6">
              <div class="box-image">
                <div class="image">
                  <img src="{{$pr->hinhanh}} " alt="" class="img-fluid" height="100" width="300">
                  <div class="overlay d-flex align-items-center justify-content-center">
                    <div class="content">
                      <div class="name">
                        <h3>
                          <a href="{{route('chi-tiet',$pr->maphim)}}" class="color-white">{{$pr->tenphim}} </a>
                        </h3>
                      </div>
                      <form action="{{route('chon-phim')}}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        
                          <a href="{{route('chi-tiet',$pr->maphim)}}" class="btn btn-template-outlined-white">Chi tiết</a>
                          <button name="idphim" type="submit" value="{{$pr->maphim}}"  class="btn btn-template-outlined-white">Chọn</button>
                          
                        
                        </form>
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
  </section>
</div>



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