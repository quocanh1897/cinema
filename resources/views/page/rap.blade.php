@extends('master') @section('content')

<div id="heading-breadcrumbs">
  <div class="container">
    <div class="row d-flex align-items-center flex-wrap">
      <div class="col-md-7">
        <h1 class="h2">{{$rap->first()->tenrap}} </h1>
      </div>
      <div class="col-md-5">
        <ul class="breadcrumb d-flex justify-content-end">
          <li class="breadcrumb-item">
            <a href="#">Trang chủ</a>
          </li>
          <li class="breadcrumb-item">
            <a href="he-thong-rap">Rạp</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>

<div id="content">
  <div class="container">
    <section class="bar">
      <div class="row portfolio-project">
        <div class="col-sm-8">
          <div class="project owl-carousel mb-4">
            <div class="item"><img src="sources/img/ok.jpg" alt="" class="img-fluid"></div>
            <div class="item"><img src="sources/img/a.jpg" alt="" class="img-fluid"></div>
            <div class="item"><img src="sources/img/b.jpg" alt="" class="img-fluid"></div>
            <div class="item"><img src="sources/img/c.jpg" alt="" class="img-fluid"></div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="heading">
            <h4>Thông tin chi tiết</h4>
          </div>
          <div class="project-more">
            <h4>Địa điểm</h4>
            <p>{{$rap->first()->daichi}}</p>
            <h4>Số điện thoại</h4>
            <p>{{$rap->first()->sodt}}</p>
            <h4>Phòng chiếu</h4>
            <p>{{$rap->first()->soluongphong}} phòng</p>
            <h4>Giờ mở cửa</h4>
            <p>{{$rap->first()->giomo}} - {{$rap->first()->giodong}}</p>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="heading">
            <h3>Mô tả</h3>
          </div>
          <p>Đến với {{$rap->first()->tenrap}}, khán giả sẽ được thưởng thức các siêu phẩm của điện ảnh Việt Nam và thế giới tại một hệ thống rạp chiếu phim hiện đại đạt chuẩn Hollywood gồm {{$rap->first()->soluongphong}} phòng chiếu công nghệ 2D &3D cùng hệ thống âm thanh Dolby 7.1 tiêu chuẩn quốc tế theo đúng tiêu chí “Mang Hollywood đến gần bạn”.</p>
          <p>Có thiết kế trẻ trung, dịch vụ thân thiện, bkCinema mong muốn sẽ là địa điểm tụ họp của những người đam mê màn ảnh rộng, muốn thỏa sức vùng vẫy trong không gian điện ảnh vô cùng sống động và tận hưởng những bộ phim mới phim hay cùng lúc với các mọt phim thế giới.</p>
          <p>Là thương hiệu dành cho giới trẻ, bkCinema ghi điểm ở mức giá “kinh tế” cũng như dịch vụ thân thiện hàng đầu Việt Nam. Ngoài ra, không gian rạp chiếu phim ấn tượng và đậm chất điện ảnh còn giúp {{$rap->first()->tenrap}} trở thành điểm đến khó thể bỏ qua vào dịp cuối tuần.</p>         
        </div>

        <div class="col-sm-6">
          <div class="heading">
            <h3>Bảng giá</h3>
          </div>
          <div class="myprice">
            <img src="sources/img/giave1.png" alt="" class="img-fluid">
          </div>
        </div>

      </div>
    </section>
  </div>
</div>

@endsection