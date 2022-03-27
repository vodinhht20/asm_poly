<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{asset('frontend')}}/images/favicon.ico" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arvo">
    <link rel="stylesheet" href="{{asset('frontend')}}/css/app.css">
    <title>Lỗi 404 | Poly App</title>
    <style>
        .page_404{ 
            padding:40px 0; background:#fff; font-family: 'Arvo', serif;
        }
        .page_404  img{
            width:100%;
            }
        .four_zero_four_bg{
            background-image: url("{{asset('frontend')}}/images/error404.gif");
            height: 400px;
            background-position: center;
        }
        .four_zero_four_bg h1{
        font-size:80px;
        }
        .four_zero_four_bg h3{
            font-size:80px;
        }
        .link_404{			 
            color: #fff!important;
            padding: 10px 20px;
            background: #13426d;
            margin: 20px 0;
            display: inline-block;
            text-decoration: none;
            transition: 0.2s;
        }
        .link_404:hover {
            opacity: 0.9;
        }
        .contant_box_404{ 
            margin-top:-50px;
        }
        .contant_box_404 a {
            text-decoration: none;
        }
    </style>
</head>
<body>
    <section class="page_404">
        <div class="container">
            <div class="row">	
            <div class="col-sm-12 ">
            <div class="col-sm-10 col-sm-offset-1  text-center">
            <div class="four_zero_four_bg">
                <h1 class="text-center ">404</h1>
            </div>
            <div class="contant_box_404">
            <h3 class="h2">
            Có vẻ như bạn đã bị sai đường dẫn
            </h3>
            <p>Trang bạn cố gắng truy cập không có săn ! </p>
            <a href="/" class="link_404">Trở về trang chủ</a>
        </div>
            </div>
            </div>
            </div>
        </div>
    </section>
    @include('layouts.footer')
</body>
</html>
