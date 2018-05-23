@extends('master') @section('content')
<div id="heading-breadcrumbs">
	<div class="container">
		<div class="row d-flex align-items-center flex-wrap">
			<div class="col-md-7">
				
				<h1 class="h2">Dịch vụ</h1>
				
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
                    <!-- THONG TIN CA NHAN -->
                    <div class="heading">
                    	<h3 class="text-uppercase">Danh sách dịch vụ</h3>
                    	<div style=" position: absolute;right: 0; top: 0">
                    		<button type="button" class="btn btn-sm btn-success" onclick="add()">Thêm</button>
                    		<button type="button" class="btn btn-sm btn-info" onclick="modify()">Sửa</button>
                    		<button type="button" class="btn btn-sm btn-danger" onclick="remove()">Xóa</button>
                    	</div> 	
                    </div>
                    <div class="table-responsive" id="bangchon1">
                    	<table class="table">
                    		<thead>
                    			<tr>
                    				<th>Hình ảnh</th>
                    				<th style="max-width: 170px">Tên</th>
                    				<th style="max-width: 300px">Mô tả</th>
                    				<th>Giá</th>
                    				
                    				<th>Nháy đúp</th>
                    			</tr>
                    		</thead>
                    		<tbody id="bangKm">
                    			@foreach($dichvu as $dichvu)
                    			<tr class="active">
                    				<td><img src="{{$dichvu->hinhanh}}" alt="Poster phim"></td>
                    				<td style="max-width: 170px"><b>{{$dichvu->tendv}}</b></td>
                    				<td style="max-width: 280px">{{$dichvu->loaidv}}</td>
                    				<td>{{$dichvu->gia}}</td>
                    				 
                    				<td><a href="javascript:void(null);" onclick="myFunc1()"><b>Chọn</b></a></td>
                    				<td hidden>{{$dichvu->makm}}</td>                  			
                    			</tr>
                    			@endforeach
                    		</tbody>
                    	</table>
                    </div>

                    <script type="text/javascript">
                    	function myFunc1() {
                    		$('#bangKm tr').click(function(e) {
                    			$(this).toggleClass('duyduy1');
                    			if ($(this).hasClass('duyduy1')) {
                    				$(this).css('background-color','#eaebef');
                    			} 
                    			else {
                    				$(this).css('background-color','transparent');
                    			}
                    		});
                    	}

                    	function add() {
                    		var x = document.getElementById("addKm");
                              var y = document.getElementById("bangchon1");
                              x.style.display="block";
                              y.style.display="none";
                    		$(":button.btn-info").prop("disabled",true);
                    		$(":button.btn-danger").prop("disabled",true);
                    	}

                    	function cancalAdd() {
                    		var x = document.getElementById("addKm");
                              var y = document.getElementById("bangchon1");
                              x.style.display="none";
                              y.style.display="block";
                    		$(":button.btn-info").prop("disabled",false);
                    		$(":button.btn-danger").prop("disabled",false);
                    	}

                    	function modify() {
                    		var x = $("#bangKm tr.duyduy1").length;
                    		if (x < 1) {
                    			alert('Chưa chọn mục cần chỉnh sửa. Vui lòng thử lại!');
                    		} 
                    		else if (x > 1) {
                    			alert('Chỉ được chỉnh sửa 1 mục/lần. Vui lòng thử lại');
                    		}
                    		else {
                    			var x = document.getElementById("modifyKm");
                                   var y = document.getElementById("bangchon1");
                    			x.style.display="block";
                                   y.style.display="none";
                    			$(":button.btn-success").prop("disabled",true);
                    			$(":button.btn-danger").prop("disabled",true);
                    			$("#mhinhanh").attr("value",$("#bangKm tr.duyduy1 td:eq(0) img").attr("src"));
                    			$("#mtenkm").attr("value",$("#bangKm tr.duyduy1 td:eq(1)").text());
                    			$("#mmota").attr("value",$("#bangKm tr.duyduy1 td:eq(2)").text());
                    			$("#mbatdau").attr("value",$("#bangKm tr.duyduy1 td:eq(3)").text());
                    			$("#mketthuc").attr("value",$("#bangKm tr.duyduy1 td:eq(4)").text());
                    			$("#mmakm").attr("value",$("#bangKm tr.duyduy1 td:eq(5)").text());
                    		}
                    	}

                    	function cancelModify() {
                    		var x = document.getElementById("modifyKm");
                              var y = document.getElementById("bangchon1");
                    		x.style.display="none";
                              y.style.display="block";
                    		$(":button.btn-success").prop("disabled",false);
                    		$(":button.btn-danger").prop("disabled",false);
                    	}

                         /* TODO: find a way to put a valid argument into route call
                         Hint: DB::table('users')->whereIn('id', $ids_to_delete)->delete();
                         Notice that you have to add use Illuminate\Support\Facades\DB; to PageController.php file.
                         Reference: https://laracasts.com/discuss/channels/eloquent/how-to-delete-multiple-records-using-laravel-eloquent */

                         function remove() {
                              var x = $("#bangKm tr.duyduy1").length;
                              if (x < 1) {
                                   alert('Chưa chọn mục cần xóa. Vui lòng thử lại!');
                              } 
                              else {
                                   if (confirm('Xác nhận xóa (các) mục đã chọn?')) {
                                        $("#bangKm tr.duyduy1").each(function (argument) {
                                             
                                        });
                                   } 
                                   else {
                                        $("#bangKm tr.duyduy1").removeClass("duyduy1");
                                   }                                  
                              }
                         }
                    </script>
					
					<!-- Form thêm dịch vụ -->					
                    <div style="display: none" id="addKm">
                    	<hr>
                    	<form action="{{route('themDv')}}" method="post" id="kmform">
							<input type="hidden" name="_token" value="{{ csrf_token() }}"> 
                    		<div class="row">
                    			<div class="col-md-6">
                    				<div class="form-group">
                    					<label for="tenkm">Tên dịch vụ</label>
                    					<input name="tenkm" id="tenkm" type="text" class="form-control">
                    				</div>
                    			</div>
                    			<div class="col-md-3">
                    				<div class="form-group">
                    					<label for="batdau">Ngày bắt đầu</label><br>
                    					<input type="date" name="batdau" id="batdau" class="form-control">

                    				</div>
                    			</div>
                    			<div class="col-md-3">
                    				<div class="form-group">
                    					<label for="ketthuc">Ngày kết thúc</label>
                    					<input name="ketthuc" id="ketthuc" type="date" class="form-control">
                    				</div>
                    			</div>                                                       
                    		</div>
                    		<div class="row">
                    			<div class="col-md-6">
                    				<div class="form-group">
                    					<label for="mota">Mô tả</label><br>
                    					<textarea rows=3 cols=47 name="mota" form="kmform" id="mota" placeholder="Nhập mô tả chi tiết..."></textarea>                                      
                    				</div>
                    			</div>
                    			<div class="col-md-6">
                    				<div class="form-group">
                    					<label for="hinhanh">Hình ảnh minh họa</label><br>
                    					<input type="url" name="hinhanh" id"hinhanh"><br>
                    				</div>
                    			</div>
                    		</div>

                    		<div class="col-md-12 text-center">
                    			<button type="submit" class="btn btn-template-outlined"><i class="fa fa-save"></i> Lưu thay đổi</button>
                    			<input type="button" class="btn btn-template-outlined" name="cancel" onclick="cancalAdd()" value="Hủy bỏ">
                    		</div>

                    	</form>
                    </div>

                    <!-- Form chỉnh sửa dịch vụ -->                    
                    <div style="display: none" id="modifyKm">
                    	<hr>
                    	<form action="{{route('suaDv')}}" method="post" id="kmformsua">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="mmakm"> 
                    		<div class="row">
                    			<div class="col-md-6">
                    				<div class="form-group">
                    					<label for="mtenkm">Tên dịch vụ</label>
                    					<input name="tenkm" id="mtenkm" type="text" class="form-control">
                    				</div>
                    			</div>
                    			<div class="col-md-3">
                    				<div class="form-group">
                    					<label for="mbatdau">Ngày bắt đầu</label><br>
                    					<input type="date" name="mbatdau" id="batdau" class="form-control">

                    				</div>
                    			</div>
                    			<div class="col-md-3">
                    				<div class="form-group">
                    					<label for="mketthuc">Ngày kết thúc</label>
                    					<input name="ketthuc" id="mketthuc" type="date" class="form-control">
                    				</div>
                    			</div>                                                       
                    		</div>
                    		<div class="row">
                    			<div class="col-md-6">
                    				<div class="form-group">
                    					<label for="mmota">Mô tả</label><br>
                    					<textarea rows="3" cols="47" name="mota" form="kmform" id="mmota" placeholder="Nhập mô tả chi tiết..."></textarea>                                      
                    				</div>
                    			</div>
                    			<div class="col-md-6">
                    				<div class="form-group">
                    					<label for="mhinhanh">Hình ảnh minh họa</label><br>
                    					<input type="url" name="hinhanh" id="mhinhanh"><br>
                    				</div>
                    			</div>
                    		</div>

                    		<div class="col-md-12 text-center">
                    			<button type="submit" class="btn btn-template-outlined"><i class="fa fa-save"></i> Lưu thay đổi</button>
                    			<input type="button" class="btn btn-template-outlined" name="cancel" onclick="cancelModify()" value="Hủy bỏ">
                    		</div>

                    	</form>
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
								<a class="nav-link active"><i class="fa fa-list"></i>  Điều chỉnh dịch vụ</a>
							</li>

							<li class="nav-item">
								<a href="{{route('dieuchinhgiave')}}" class="nav-link"><i class="fa fa-list"></i> Điều chỉnh giá vé</a>
							</li>
							<li class="nav-item">
								<a href="{{route('phim-da-xem')}}" class="nav-link"><i class="fa fa-list"></i> Điều chỉnh giá dịch vụ</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection