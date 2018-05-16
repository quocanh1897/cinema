@extends('master') 
@section('content')

<div id="content">
    <div class="container">
        <div id="error-page" class="col-md-8 mx-auto text-center">
            <div class="box">
                <p class="text-center">
                    <a href="index">
                        <img src="sources/img/logo.png" alt="Obaju template">
                    </a>
                </p>
                <h3>Trang này không tồn tại. Có thể đang được xây dựng hoặc bảo trì.</h3>
                <h4 class="text-muted">Error 404 - Trang không tồn tại</h4>
                <p class="buttons">
                    <a href="index" class="btn btn-template-outlined">
                        <i class="fa fa-home"></i> Về trang chủ</a>
                </p>
            </div>
        </div>
    </div>
</div>

@endsection