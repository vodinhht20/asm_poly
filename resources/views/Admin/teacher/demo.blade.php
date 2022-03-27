<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link href="{{asset('admin_assets')}}/app/css/demo.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="detail">
        <div class="container">
            <div class="detail__product">
                <div class="detail__product__view">
                    <div class="detail__product_img">
                        <div class="slideshow_gallery">
                            <div class="slider">
                                <div class="mySlides video">
                                    <iframe
                                        src="{{$contents}}"
                                        width="100%" allow="autoplay"></iframe>
                                </div>
                                @foreach ($product->product_gallery as $pg)
                                <div class="mySlides">
                                    <img src="{{$pg->url_image}}" style="width:100%">
                                </div>
                                @endforeach
                               
                               
                            </div>
                            <div class="img-small">
                                <div class="column">
                                    <img class="demo cursor" src="{{asset('frontend')}}/images/play-g50fbfd935_640.png"
                                        style="width: 100%;  object-fit: cover; " alt="imgage">
                                </div>
                                @foreach ($product->product_gallery as $pg)
                                <div class="column">
                                    <img class="demo cursor" src="{{$pg->url_image}}" style="width:100%"
                                         alt="The Woods">
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="detail__product__infor">
                        <div class="detail__product__name">
                            <h4>{{$product->name}}</h4>
                        </div>
                        
                        <div class="detail__product__scores">
                           
                        </div>
                        <div class="detail__product__member">
                            <p>Thành viên:</p><br>
                            @foreach ($product->member_obj as $member)
                            <span>{{$member->full_name}} - <span>{{$member->student_code}}</span></span><br>
                            @endforeach
                        </div>

                        <div class="detail__product__specialized">
                            <p>Chuyên ngành:</p>
                            @foreach ($major as $mj)
                                @if ($mj->id==$product->subject_obj->major_id)
                                <span>{{$mj->major_name}}</span>
                                @endif
                            @endforeach
                        </div>
                        <div class="detail__product__subject-code">
                            <p>Mã môn:</p>
                            <span>{{$product->code_subject}}</span>
                        </div>
                        <div class="detail__product__semester">
                            <p>Kỳ học:</p>
                            <span>{{$product->semester_obj->name}}</span>
                        </div>
                        <div class="detail__product__teacher">
                            <p>Giảng viên hướng dẫn:</p>
                            <span>{{$product->teacher}}</span>
                        </div>
                        <div class="detail__product__document">
                            <p>Nguồn tài liệu:</p>
                            <span><a href="{{$product->document_url}}">Tài Liệu</a></span>
                        </div>
                    </div>
                </div>
                <div class="detail__product__custom">
                    <div class="btn-slide">
                        <h4>Mô tả</h4>
                    </div>
                    <div class="detail__product__slides description">
                       {!!$product->descript_detail!!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script>
        $('.slider').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            asNavFor: '.img-small'
        });
        $('.img-small').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: '.slider',
            centerMode: true,
            focusOnSelect: true,
            arrows: false,
            
            
        });
       
    </script>
</body>

</html>