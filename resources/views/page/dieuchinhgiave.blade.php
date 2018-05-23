@extends('master') @section('content')
<div id="heading-breadcrumbs">
	<div class="container">
		<div class="row d-flex align-items-center flex-wrap">
			<div class="col-md-7">
				
				<h1 class="h2">Giá vé</h1>
				
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
			<div id="customer-account" class="col-lg-9 clearfix">
				
				<div class="bo3">


					<div class="row">
						<div class="col-lg-6">
							<div class="heading">
								<h4 class="text-uppercase">Loại phòng</h4>
								<div style=" position: absolute;right: 0; top: 0">
									<button type="button" class="btn btn-sm btn-success" onclick="addphong()">Thêm</button>
									<button type="button" class="btn btn-sm btn-info" onclick="modifyphong()">Sửa</button>
									<button type="button" class="btn btn-sm btn-danger" onclick="removephong()">Xóa</button>
								</div> 	
							</div>
							<div class="table-responsive" id="bangchon1">
								<table class="table">
									<thead>
										<tr>

											<th>Tên loại</th>
											<th>Giá</th>
											<th>Nháy đúp</th>
										</tr>
									</thead>
									<tbody id="bangloaiphong">
										@foreach($loaiphong as $loaiphong)
										<tr class="active">

											<td>{{$loaiphong->tenloai}}</td>
											<td>{{$loaiphong->gia}}</td> 
											<td><a href="javascript:void(null);" onclick="myFunc1()"><b>Chọn</b></a></td>

										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
							<!-- Form thêm loại phòng -->					
							<div style="display: none" id="addphong">
								<hr>
								<form action="{{route('themLoaiphong')}}" method="post" id="themLoaiphong">
									<input type="hidden" name="_token" value="{{ csrf_token() }}"> 
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label for="tenloai">Tên loại phòng mới(*)</label>
												<input name="tenloai" id="tenloai" type="text" class="form-control">
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label for="gia">Giá(*)</label><br>
												<input type="number" name="gia" id="gia" class="form-control">

											</div>
										</div>

									</div>

									<div class="col-sm-12 text-center">
										<button type="submit" class="btn btn-template-outlined"><i class="fa fa-save"></i> Xác nhận</button>
										<input type="button" class="btn btn-template-outlined" name="cancel" onclick="cancelAddphong()" value="Hủy bỏ">
									</div>

								</form>
							</div>

							<!-- Form chỉnh sửa loại phòng -->                    
							<div style="display: none" id="modifyphong">
								<hr>
								<form action="{{route('suaLoaiphong')}}" method="post" id="sualoaiphong">
									<input type="hidden" name="_token" value="{{ csrf_token() }}"> 
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label for="mtenloai">Tên loại ghế</label>
												<input name="mtenloai" id="mtenloai" type="text" class="form-control">
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label for="mgia">Giá</label><br>
												<input type="number" name="mgia" id="mgia" class="form-control">

											</div>
										</div>

									</div>

									<div class="col-sm-12 text-center">
										<button type="submit" class="btn btn-template-outlined"><i class="fa fa-save"></i> Xác nhận</button>
										<input type="button" class="btn btn-template-outlined" name="cancel" onclick="cancelModifyphong()" value="Hủy bỏ">
									</div>

								</form>
							</div>

						</div>

						<div class="col-lg-6">
							<div class="heading">
								<h4 class="text-uppercase">Loại ghế</h4>
								<div style=" position: absolute;right: 0; top: 0">
									<button type="button" class="btn btn-sm btn-success" onclick="addghe()">Thêm</button>
									<button type="button" class="btn btn-sm btn-info" onclick="modifyghe()">Sửa</button>
									<button type="button" class="btn btn-sm btn-danger" onclick="removeghe()">Xóa</button>
								</div> 	
							</div>
							<div class="table-responsive" id="bangchon2">
								<table class="table">
									<thead>
										<tr>
											<th>Tên loại</th>
											<th>Giá</th>
											<th>Nháy đúp</th>
										</tr>
									</thead>
									<tbody id="bangloaighe">
										@foreach($loaighe as $loaighe)
										<tr class="active">

											<td>{{$loaighe->tenloai}}</td>
											<td>{{$loaighe->gia}}</td> 
											<td><a href="javascript:void(null);" onclick="myFunc2()"><b>Chọn</b></a></td>

										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
							<!-- Form thêm loại ghế -->					
							<div style="display: none" id="addghe">
								<hr>
								<form action="{{route('themLoaighe')}}" method="post" id="themLoaiphong">
									<input type="hidden" name="_token" value="{{ csrf_token() }}"> 
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label for="tenloai">Tên loại ghế mới(*)</label>
												<input name="tenloai" id="tenloai" type="text" class="form-control">
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label for="gia">Giá(*)</label><br>
												<input type="number" name="gia" id="gia" class="form-control">

											</div>
										</div>

									</div>

									<div class="col-sm-12 text-center">
										<button type="submit" class="btn btn-template-outlined"><i class="fa fa-save"></i> Xác nhận</button>
										<input type="button" class="btn btn-template-outlined" name="cancel" onclick="cancelAddghe()" value="Hủy bỏ">
									</div>

								</form>
							</div>

							

						</div>
					</div>
					<hr>


					<script type="text/javascript">
						function myFunc1() {
							$('#bangloaiphong tr').click(function(e) {
								$(this).toggleClass('duyduy1');
								if ($(this).hasClass('duyduy1')) {
									$(this).css('background-color','#eaebef');
								} 
								else {
									$(this).css('background-color','transparent');
								}
							});
						}

						function myFunc2() {
							$('#bangloaighe tr').click(function(e) {
								$(this).toggleClass('duyduy2');
								if ($(this).hasClass('duyduy2')) {
									$(this).css('background-color','#eaebef');
								} 
								else {
									$(this).css('background-color','transparent');
								}
							});
						}

                    	function addphong() {
                    		var x = document.getElementById("addphong");
                    		var y = document.getElementById("bangchon1");
                    		x.style.display="block";
                    		y.style.display="none";
                    		$(":button.btn-success").prop("disabled",true);
                    		$(":button.btn-info").prop("disabled",true);
                    		$(":button.btn-danger").prop("disabled",true);
                    	}

                    	function cancelAddphong() {
                    		var x = document.getElementById("addphong");
                    		var y = document.getElementById("bangchon1");
                    		x.style.display="none";
                    		y.style.display="block";
                    		$(":button.btn-success").prop("disabled",false);
                    		$(":button.btn-info").prop("disabled",false);
                    		$(":button.btn-danger").prop("disabled",false);
                    	}

                    	function addghe() {
                    		var x = document.getElementById("addghe");
                    		var y = document.getElementById("bangchon2");
                    		x.style.display="block";
                    		y.style.display="none";
                    		$(":button.btn-success").prop("disabled",true);
                    		$(":button.btn-info").prop("disabled",true);
                    		$(":button.btn-danger").prop("disabled",true);
                    	}

                    	function cancelAddghe() {
                    		var x = document.getElementById("addghe");
                    		var y = document.getElementById("bangchon2");
                    		x.style.display="none";
                    		y.style.display="block";
                    		$(":button.btn-success").prop("disabled",false);
                    		$(":button.btn-info").prop("disabled",false);
                    		$(":button.btn-danger").prop("disabled",false);
                    	}

                    	function modifyphong() {
                    		var x = $("#bangloaiphong tr.duyduy1").length;
                    		if (x < 1) {
                    			alert('Chưa chọn mục cần chỉnh sửa. Vui lòng thử lại!');
                    		} 
                    		else if (x > 1) {
                    			alert('Chỉ được chỉnh sửa 1 mục/lần. Vui lòng thử lại');
                    		}
                    		else {
                    			var x = document.getElementById("modifyphong");
                    			var y = document.getElementById("bangchon1");
                    			x.style.display="block";
                    			y.style.display="none";
                    			$(":button.btn-info").prop("disabled",true);
                    			$(":button.btn-success").prop("disabled",true);
                    			$(":button.btn-danger").prop("disabled",true);
                    			
                    			$("#mtenloai").attr("value",$("#bangloaiphong tr.duyduy1 td:eq(0)").text());
                    			$("#mgia").attr("value",$("#bangloaiphong tr.duyduy1 td:eq(1)").text());
                    			
                    		}
                    	}

                    	function cancelModifyphong() {
                    		var x = document.getElementById("modifyphong");
                    		var y = document.getElementById("bangchon1");
                    		x.style.display="none";
                    		y.style.display="block";
                    		$(":button.btn-info").prop("disabled",false);
                    		$(":button.btn-success").prop("disabled",false);
                    		$(":button.btn-danger").prop("disabled",false);
                    	}

                     //     /* TODO: find a way to put a valid argument into route call
                     //     Hint: DB::table('users')->whereIn('id', $ids_to_delete)->delete();
                     //     Notice that you have to add use Illuminate\Support\Facades\DB; to PageController.php file.
                     //     Reference: https://laracasts.com/discuss/channels/eloquent/how-to-delete-multiple-records-using-laravel-eloquent */

                     //     function removephong() {
                     //     	var x = $("#bangKm tr.duyduy1").length;
                     //     	if (x < 1) {
                     //     		alert('Chưa chọn mục cần xóa. Vui lòng thử lại!');
                     //     	} 
                     //     	else {
                     //     		if (confirm('Xác nhận xóa (các) mục đã chọn?')) {
                     //     			$("#bangKm tr.duyduy1").each(function (argument) {

                     //     			});
                     //     		} 
                     //     		else {
                     //     			$("#bangKm tr.duyduy1").removeClass("duyduy1");
                     //     		}                                  
                     //     	}
                     //     }
                 </script>



               	

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
         					<a href="{{route('dieuchinhkhuyenmai')}}" class="nav-link"><i class="fa fa-list"></i>  Điều chỉnh khuyến mãi</a>
         				</li>

         				<li class="nav-item">
         					<a class="nav-link active"><i class="fa fa-list"></i> Điều chỉnh giá vé</a>
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