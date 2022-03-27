@extends('layouts.main')
@section('title')
    <title>403 | App Poly</title>
@endsection
@section('content')
<div class="main-successful">
    <div class="main-successful-grid">
        <div class="aside-left">
            <h3>Chào mừng bạn đến với Poly App !</h3>
            <img src="{{asset('frontend')}}/images/img-aside-left-01.jpg" alt="">
        </div>
        <div class="main-successful-content">
            <div class="main-successful-content-box">
                <div class="icon-success">
                    <img src="{{asset('frontend')}}/images/permissionDeny.gif" alt="">
                </div>
                <div class="notify-success">
                    <h2>Bạn không có quyền truy cập vào trang này !</h2>
                    <p>Trang bạn đang cố gắng truy cập không còn hoặc đã bị chặn.</p>
                </div>
                <div class="bnt-direction">
                    <a href="/" class="bnt-direction-home">Trang chủ</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
