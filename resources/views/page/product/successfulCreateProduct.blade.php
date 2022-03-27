@extends('layouts.main')
@section('title')
    <title>Xác nhận tạo sản phẩm</title>
@endsection
@section('content')
<div class="main-successful">
    <div class="main-successful-grid">
        <div class="aside-left">
            <img src="{{asset('frontend')}}/images/img-aside-left-01.jpg" alt="">
            <h3>Chào mừng bạn đến với Poly App !</h3>
        </div>
        <div class="main-successful-content">
            <div class="main-successful-content-box">
                <div class="icon-success">
                    <img src="{{asset('frontend')}}/images/success001.gif" alt="">
                </div>
                <div class="notify-success">
                    <h2>Bạn đã đăng ký thành công lưu trữ dự án trên Poly App</h2>
                    <p>Hệ thống sẽ xử lý và gửi thông tin cho giáo viên bộ môn phê duyệt trong vòng 5 -7 ngày tới.
                         Chúng tôi sẽ gửi kết quả cho bạn sớm nhất.
                         Trong thời gian này bạn có thể chỉnh sửa và thay đổi nếu có sai sót. <a href="">Thông tin dịch vụ</a></p>
                </div>
                <div class="bnt-direction">
                    <a href="/san-pham/{{$token}}/edit" class="bnt-direction-edit">Chỉnh sửa</a>
                    <a href="/" class="bnt-direction-home">Trang chủ</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
