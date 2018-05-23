<!-- NOSticky menu, add "make-sticky" to stick menu on top-->
<header class="nav-holder ">
  <div id="navbar" role="navigation" class="navbar navbar-expand-lg">
    <div class="container">
      <a @if($muave == 1) href="index" @endif class="navbar-brand home">
        <img  src="sources/img/db-logo.png" alt="Universal logo" class="d-none d-md-inline-block">
        <img src="sources/img/db-logo-small.png" alt="Universal logo" class="d-inline-block d-md-none">
        <span class="sr-only">Welcome to BK Cinema</span>
      </a>
      <!-- <button type="button" data-toggle="collapse" data-target="#navigation" class="navbar-toggler btn-template-outlined">
        <span class="sr-only">Toggle navigation</span>
        <i class="fa fa-align-justify"></i>
      </button> -->
      <div id="navigation" class="navbar-collapse collapse">
        <ul class="nav navbar-nav ml-auto">
          <!-- MUA VE -->
          @if($muave != "0")
          <li class="nav-item">
            <a href="{{route('mua-ve-menu')}}">Mua vé
              <b class="caret"></b>
            </a>
          </li>
          
          <!-- END MUA VE -->

          <!-- LICH CHIEU -->
          <li class="nav-item dropdown menu-large">
            <a href="404" data-toggle="dropdown" class="dropdown-toggle">LỊCH CHIẾU
              <b class="caret"></b>
            </a>
            <ul class="dropdown-menu megamenu">
              <li>
                <div class="row">
                  @foreach($newest as $nw)
                  <div class="col-lg-3">
                    <a href="chi-tiet/{{$nw->maphim}} ">
                    <img src="{{$nw->hinhanh}} " class="img-fluid d-none d-lg-block">
                    </a>
                  </div>
                  @endforeach
                  <div class="col-lg-3 col-md-6">
                    <h5>XEM THEO PHIM</h5>
                    <ul class="list-unstyled mb-3">
                      <li class="nav-item">
                        <a href="phim-dang-chieu" class="nav-link">Phim đang chiếu</a>
                      </li>
                      <li class="nav-item">
                        <a href="phim-sap-chieu" class="nav-link">Phim sắp chiếu</a>
                      </li>
                    </ul>
                  </div>
                  <div class="col-lg-3 col-md-6">
                    <h5>XEM THEO RẠP</h5>
                    <ul class="list-unstyled mb-3">
                      <li>
                        <a href="404" class="nav-link">Tp. Hồ Chí Minh</a>
                      </li>
                      <li class="nav-item">
                        <a href="404" class="nav-link">Hà Nội</a>
                      </li>
                      <li class="nav-item">
                        <a href="404" class="nav-link">Xem tất cả</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </li>
            </ul>
          </li>
          <!-- END LICH CHIEU -->

          <!-- HE THONG RAP -->
          <li class="nav-item ">
            <a href="he-thong-rap">Hệ thống rạp
              <b class="caret"></b>
            </a>
          </li>
          <!-- END HE THONG RAP -->

          <!-- KHUYEN MAI -->
          <li class="nav-item dropdown menu-large">
            <a href="" data-toggle="dropdown" class="dropdown-toggle">KHUYẾN MÃI
              <b class="caret"></b>
            </a>
            <ul class="dropdown-menu megamenu">
              <li>
                <div class="row">
                  @foreach($khuyenmai as $km)
                  <div class="col-lg-3">
                    <a href="{{$km->hinhanh}}">
                      <img src="{{$km->hinhanh}} " style="width:300px;height:150px" class="img-fluid d-none d-lg-block">
                    </a>
                  </div>
                  @endforeach
                  
                  
                  <div class="col-lg-3 col-md-1 nav-link">
                    <a href="{{route('khuyen-mai')}} " class="nav-link">XEM TẤT CẢ</a>
                  </div>
                </div>
              </li>
            </ul>
          </li>
          <!-- END KHUYEN MAI -->
          
          <!-- GIOI THIEU  -->
          <li class="nav-item ">
            <a href="about">Giới thiệu</a>
          </li>
          <!-- END GIOI THIEU -->
          @endif
        </ul>
      </div>
      <!-- <div id="search" class="collapse clearfix">
        <form role="search" class="navbar-form">
          <div class="input-group">
            <input type="text" placeholder="Search" class="form-control">
            <span class="input-group-btn">
              <button type="submit" class="btn btn-template-main">
                <i class="fa fa-search"></i>
              </button>
            </span>
          </div>
        </form>
      </div> -->
    </div>
  </div>
</header>
<!-- END NOSticky menu -->
