@extends('master') @section('content')
<div id="heading-breadcrumbs">
	<div class="container">
		<div class="row d-flex align-items-center flex-wrap">
			<div class="col-md-7">
				
				<h1 class="h2">Khuyến mãi</h1>
				
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

<div id="content">
	<div class="container">
		<div class="row bar">
			<div class="col-lg-9">
				<div class="heading">
					<h3 class="text-uppercase">Thông tin khuyến mãi</h3>
				</div>
				<div id="accordion" role="tablist" class="mb-5">
					@foreach($khuyenmai as $khuyen_mai)
					<div class="card">
						<div id="heading1" role="tab" class="card-header">
							<h5 class="mb-0"><a data-toggle="collapse" href="#collapse1" aria-expanded="true" aria-controls="collapse1">{{$khuyen_mai->tenkm}}</a></h5>
						</div>
						<div id="collapse1" role="tabpanel" aria-labelledby="heading1" data-parent="#accordion" class="collapse show">
							<div class="card-body">
								<div class="row">
									<div class="col-md-4"><img src="{{$khuyen_mai->hinhanh}}" alt="" class="img-fluid"></div>
									<div class="col-md-8">
										<p>{{$khuyen_mai->mota}}</p>
										<p>Thời gian: {{$khuyen_mai->batdau}} - {{$khuyen_mai->ketthuc}}</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					@endforeach
					<script type="text/javascript">
						$(document).ready(function(){
							$("[id=heading1]").each(function(index) {
								$(this).attr("id","heading"+index);
							});
							$("[href=#collapse1]").each(function(index) {
								$(this).attr("href","#collapse"+index);
								$(this).attr("aria-controls","collapse"+index);
							});
							$("[role=tabpane]").each(function(index) {
								$(this).attr("id","collapse"+index);
								$(this).attr("aria-labelledby","heading"+index);
							});
						});
					</script>
				</div>
				<!-- <div class="row">
					<div class="col-lg-6">
						<div id="accordionTwo" role="tablist">
							<div class="card">
								<div id="headingFour" role="tab" class="card-header">
									<h5 class="mb-0"><a data-toggle="collapse" href="#collapseFour" aria-expanded="true" aria-controls="collapseFour">Collapsible group 1</a></h5>
								</div>
								<div id="collapseFour" role="tabpanel" aria-labelledby="headingFour" data-parent="#accordionTwo" class="collapse show">
									<div class="card-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
								</div>
							</div>
							<div class="card">
								<div id="headingFive" role="tab" class="card-header">
									<h5 class="mb-0"><a data-toggle="collapse" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive" class="collapsed">Collapsible group 1</a></h5>
								</div>
								<div id="collapseFive" role="tabpanel" aria-labelledby="headingFive" data-parent="#accordionTwo" class="collapse">
									<div class="card-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. <br>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
								</div>
							</div>
							<div class="card">
								<div id="headingSix" role="tab" class="card-header">
									<h5 class="mb-0"><a data-toggle="collapse" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix" class="collapsed">Collapsible group 1</a></h5>
								</div>
								<div id="collapseSix" role="tabpanel" aria-labelledby="headingSix" data-parent="#accordionTwo" class="collapse">
									<div class="card-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div id="accordionThree" role="tablist">
							<div class="card">
								<div id="headingSeven" role="tab" class="card-header">
									<h5 class="mb-0"><a data-toggle="collapse" href="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven">Collapsible group 1</a></h5>
								</div>
								<div id="collapseSeven" role="tabpanel" aria-labelledby="headingSeven" data-parent="#accordionThree" class="collapse show">
									<div class="card-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
								</div>
							</div>
							<div class="card">
								<div id="headingEight" role="tab" class="card-header">
									<h5 class="mb-0"><a data-toggle="collapse" href="#collapseEight" aria-expanded="false" aria-controls="collapseEight" class="collapsed">Collapsible group 1</a></h5>
								</div>
								<div id="collapseEight" role="tabpanel" aria-labelledby="headingEight" data-parent="#accordionThree" class="collapse">
									<div class="card-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. <br>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
								</div>
							</div>
							<div class="card">
								<div id="headingNine" role="tab" class="card-header">
									<h5 class="mb-0"><a data-toggle="collapse" href="#collapseNine" aria-expanded="false" aria-controls="collapseNine" class="collapsed">Collapsible group 1</a></h5>
								</div>
								<div id="collapseNine" role="tabpanel" aria-labelledby="headingNine" data-parent="#accordionThree" class="collapse">
									<div class="card-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
								</div>
							</div>
						</div>
					</div>
				</div> -->
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
								<a  href="{{route('profilenhanvien')}}" class="nav-link"><i class="fa fa-user"></i> Thông tin cá nhân</a>
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
								<a class="nav-link active"><i class="fa fa-user"></i>  Điều chỉnh khuyến mãi</a>
							</li>

							<li class="nav-item">
								<a href="{{route('lich-su')}}" class="nav-link"><i class="fa fa-list"></i> Điều chỉnh giá vé</a>
							</li>
							<li class="nav-item">
								<a href="{{route('phim-da-xem')}}" class="nav-link"><i class="fa fa-heart"></i> Điều chỉnh giá dịch vụ</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection