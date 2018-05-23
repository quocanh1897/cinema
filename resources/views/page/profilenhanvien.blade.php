@extends('master') @section('content')
<div id="heading-breadcrumbs">
	<div class="container">
		<div class="row d-flex align-items-center flex-wrap">
			<div class="col-md-7">
				
				<h1 class="h2">Trang cá nhân</h1>
				
			</div>

		</div>
	</div>
</div>

@if(count($errors) > 0)

@foreach($errors->all() as $err)
<div role="alert" class=" alert alert-danger">
	{{$err}}
	<br>   
</div>
@endforeach

@endif

@if(Session::has('flag'))
<div role="alert" class="alert alert-{{Session::get('flag')}} alert-dismissible">
	<button type="button" data-dismiss="alert" class="close">
		<span aria-hidden="true">×</span>
		<span class="sr-only">Đóng</span>
	</button>{{Session::get('mes')}}
</div>
@endif

<script type="text/javascript">
	$('header').hide().prop("disabled",true);
	$('footer').hide().prop("disabled",true);
</script>

<div id="content">
	<div class="container">
		<div class="row bar">
			<div id="employee-account" class="col-lg-9 clearfix">

				<div class="bo3">
					<!-- THONG TIN CA NHAN -->
					<div class="heading">
						<h3 class="text-uppercase">Thông tin cá nhân</h3>
					</div>
					<div class="row">
						<div class="col-sm-4">

							<p class="text-center"><img src="http://lh5.googleusercontent.com/-SJWvFVdVHOc/V9cAgV8W_TI/AAAAAAAA5Bg/kaDMqDifvGsuUuhYYxUIejwftUAXGhU1gCLcB/s1600/ohgai.net-0089120916.jpg" alt="" class="rounded-circle img-fluid"></p>

							<p class="text-center"><a href="javascript:void(null)">Đổi ảnh đại diện</a></p>
						</div>
						<div class="col-sm-8">
							<div id="details" class="mb-4 mt-4">
								<style type="text/css">
								th {
									padding: 10px;
									font-weight: normal;
									font-size: 16px;
								}
								th#thduy {
									color: gray;
									font-weight: bold;
								}
							</style>

							<table>
								<tr>
									<th id="thduy">Họ và tên</th>
									<th>{{Auth::user()->name}}</th>
								</tr>

								<tr>
									<th id="thduy">Email</th>
									<th>{{Auth::user()->email}}</th>
								</tr>
								<tr>
									<th id="thduy">Ngày sinh</th>
									<th>{{Auth::user()->ngaysinh}}</th>
								</tr>
								<tr>
									<th id="thduy">Giới tính</th>
									<th>{{Auth::user()->gioitinh}}</th>
								</tr>
								<tr>
									<th id="thduy">Chứng minh thư</th>
									<th>{{Auth::user()->cmnd}}</th>
								</tr>

							</table>
							<hr> 
							<form action="{{route('changePassNhanvien')}}" method="post">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<label>
									<input id="want" type="checkbox" name="subscribe" onclick="myFunction()" /> Tôi muốn đổi mật khẩu
								</label>

								<div class="row" id="changepas" style="display: none;">
									<div class="col-md-5">
										<div class="form-group">

											<input type="password" name="password_old" id="password_old" class="form-control" placeholder="Mật khẩu hiện tại" disabled>

										</div>
									</div>
									<div class="col-md-5">
										<div class="form-group">

											<input type="password" name="password" id="password" class="form-control" placeholder="Mật khẩu mới" disabled>

										</div>
									</div>
									<div class="col-md-5">
										<div class="form-group">

											<input type="password" name="re_password" id="re_password" class="form-control" placeholder="Xác nhận lại mật khẩu" disabled>

										</div>
									</div>
									<div class="col-md-5 text-center">
										<button type="submit" class="btn btn-template-outlined"><i class="fa fa-save"></i> Lưu thay đổi</button>
									</div>
								</div>



								<!-- Xac nhan khach hang muon doi mat khau -->
								<script type="text/javascript">

									function myFunction() {
										var x = document.getElementById("changepas");
										var checkbox = document.getElementById('want');
										if (checkbox.checked === true) {
											x.style.display = "block";
											$(":password").attr("disabled",false);
										}
										else {
											x.style.display = "none";
											$(":password").attr("disabled",true);
										}
									}
								</script>
							</form>
						</div>
					</div>
				</div>



				
			</div>



		</div>

		<div class="col-lg-3 mt-4 mt-lg-0">
			<!-- CUSTOMER MENU -->
			<div class="panel panel-default sidebar-menu">
				<div class="panel-heading">
					<h3 class="h4 panel-title">Nhân viên</h3>
				</div>
				<div class="panel-body">
					<ul class="nav nav-pills flex-column text-sm">
						<li class="nav-item">
							<a class="nav-link active"><i class="fa fa-user"></i> Thông tin cá nhân</a>
						</li>					
					</ul>
				</div>
			</div>
			<div class="panel panel-default sidebar-menu">
				<div class="panel-heading">
					<h3 class="h4 panel-title">Công việc</h3>
				</div>
				<div class="panel-body">
					<ul class="nav nav-pills flex-column text-sm">
						<li class="nav-item">
							<a href="{{route('dieuchinhkhuyenmai')}}" class="nav-link"><i class="fa fa-list"></i>  Điều chỉnh khuyến mãi</a>
						</li>

						<li class="nav-item">
							<a href="{{route('lich-su')}}" class="nav-link"><i class="fa fa-list"></i> Điều chỉnh giá vé</a>
						</li>
						<li class="nav-item">
							<a href="{{route('dieuchinhdv')}}" class="nav-link"><i class="fa fa-list"></i> Điều chỉnh giá dịch vụ</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
</div>

@endsection