@extends('layouts.main')
@section('title')
    <title>welcome Poly App | Nơi trưng bài dự án sinh viên</title>
@endsection
@section('style-page')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
@endsection
@section('content')
    <main class="home-page">
        <div class="loader ">
            <img class="center" src="{{ asset('frontend') }}/images/loading_001.gif" alt="">
            <p class="vertical-center">Vui lòng chờ . . .</p>
        </div>
            <div class="slider">
                <!-- fade css -->
                <div class="myslide fade">
                    <img src="{{asset('frontend')}}/images/banner/banner001_13-12-21.jpg">
                </div>
                <div class="myslide fade">
                    <img src="{{asset('frontend')}}/images/banner/banner002_13-12-21.jpg">
                </div>
                <div class="myslide fade">
                    <img src="{{asset('frontend')}}/images/banner/banner003_13-12-21.jpg">
                </div>
                <div class="myslide fade">
                    <img src="{{asset('frontend')}}/images/banner/banner004_13-12-21.jpg">
                </div>
                <div class="myslide fade">
                    <img src="{{asset('frontend')}}/images/banner/banner005_13-12-21.jpg">
                </div>
            </div>
        </div>
        <div class="content-wrap">
            <section class="section-filter">
                <div class="nav-sub" id="category">
                    <a href="javascript:;" class="category-item active"  data-id="all">All</a>
                    @foreach ($product_type as $item )
                    <a  href="javascript:;" class="category-item " data-id="{{$item->id}}">{{ $item->name }}</a>
                    @endforeach
                </div>
                <div class="select-category">
                    <select name="" id="view" class="border-bnt">
                        <option value="">Lọc theo lựa chọn </option>
                        <option value="0">Lượt xem nhiều </option>
                        <option value="1">Lượt đánh giá </option>
                    </select>
                </div>
            </section>
        </div>
        <div class="home-content">
            <div class="easy-waiting" style="display: none;">
                <img src="{{asset('frontend/images/loading_001.gif')}}" >
                <p class="vertical-center">Vui lòng chờ . . .</p>
            </div>
            <div id="wrap_content">
                <div class="product_list">
                    @foreach ($products as $item)
                        <div class="product-item">
                            <div class="inner">
                                <a href="/san-pham/{{$item->token}}/view">
                                    @if (!isset($item->product_gallery[0]->url_image_small) == null)
                                        <img src="{{ $item->product_gallery[0]->url_image_small }}" style="max-height: 400px; min-height: 200px;"/>
                                    @else
                                        <img src="{{ asset('image-hold.png') }}" style="max-height: 400px; min-height: 200px;"/>
                                    @endif
                                    <p>{{ $item->name }}.</p>
                                    <div class="custom-1">
                                        <div class="user">
                                            @if (!isset($item->user_product->avatar) == null)
                                                <img src="{{ $item->user_product->avatar }}" alt="">
                                            @endif
                                            @if (!isset($item->user_product->avatar) == null)
                                            <p>{{ $item->user_product->name }}</p> 
                                            @endif
                                        </div>
                                    </div>
                                    <div class="custom-2">
                                        <div class="star">
                                            @for ($i = 0; $i < floor($item->avgStar()); $i++)
                                                <i class="fas fa-heart" style="font-size: 13px !important; color: #e81224;"></i>
                                            @endfor
                                            @if (round($item->avgStar(),1)-floor($item->avgStar())>= 0.5)
                                                <i class="fas fa-heart-broken" style="font-size: 13px !important; color: #e81224;"></i>
                                            @endif
                                            @for ($i = 0; $i < 5-round($item->avgStar()); $i++)
                                                <i class="far fa-heart" style="font-size: 13px !important; color: #e81224;"></i>
                                            @endfor
                                            <span>{{round($item->avgStar(),1)}}/5</span>
                                        </div>
                                        <i class="far fa-eye"> {{$item->view}}</i>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                @if (count($products)==0)
                    <img src="{{asset('frontend')}}/images/no-result.png" style="max-width: 400px; display: flex; margin:auto;" alt="">
                @endif
                @if ($result > 16)
                <div class="see-more">
                    <a href="{{ route("seeMore.product") }}" class="more-see" >
                        Xem Thêm ...
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
    <input type="hidden" id="product_type_selected" value="all">
</main>
@endsection
@section('page-script')
<script type="text/javascript" src="{{asset('frontend/js/slick.min.js')}}"></script>
<script>
    // script UI
    $(window).on('load', function(event) {
        $(".home-page .home-content").fadeIn();
        $(".home-page .slider").fadeIn();
        $(".home-page .content-wrap").fadeIn();
        $('.loader').delay(500).fadeOut('fast');
    });
    $('.slider').slick({
        dots: true,
        slidesToShow: 1,
        infinite: true,
        autoplay: true,
        autoplaySpeed: 5000,
        draggable: false,
        prevArrow:"<button type='button' class='slick-prev pull-left'><i class='fa fa-angle-left' aria-hidden='true'></i></button>",
        nextArrow:"<button type='button' class='slick-next pull-right'><i class='fa fa-angle-right' aria-hidden='true'></i></button>"
    });

    // script ajax requests
    function ajax_rerender_products(type_id, order_by, appendElement){
        let data = {
            type: type_id,
            order_by: order_by,
            _token: "{{csrf_token()}}"
        };
        $.ajax({
            url: "{{route('home.ajax-order-product-type')}}",
            method: "post",
            data: data,
            dataType: "json",
            beforeSend:function(){
                $('.easy-waiting').css('display', 'flex');
            },
            success: function(resp){
                if(resp.success){
                    $(appendElement).html(resp.data);
                }
            },
            complete: function(){
                $('.easy-waiting').css('display', 'none');
            }
        })

    }
    $(document).ready(function(){
        $('#view').on('change', function(){
            ajax_rerender_products($('#product_type_selected').val(), $(this).val(), '#wrap_content')
        });
        $('.category-item').on('click', function(){
            $("#product_type_selected").val($(this).data('id'));
            ajax_rerender_products($(this).data('id'), $('#view').val(), '#wrap_content');
            $('.category-item').removeClass('active');
            $(`.category-item[data-id="${$(this).data('id')}"]`).addClass('active');
            $('.more-see').attr('data-id' , $(this).data('id'));  
            $('.more-see').show();
        })
    });
</script>
@endsection
