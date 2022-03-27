@extends('layouts.main')
@section('title')
    <title>Sản phẩm | ASM Poly</title>
@endsection
@section('style-page')
@endsection
@section('content')
    <div class="major__page">
        <div class="container">
            <div class="major__content__title">
                <div class="content__title__left">
                    <a href="/" class="title__home">Trang chủ</a>
                    <i class="fas fa-chevron-right"></i>
                    <span class="title__item">Sản phẩm</span>
                </div>
                <div class="filter__right">
                    <div class="filter__right___icon">
                        <button class="btn__filter">
                            <i class="fas fa-filter"></i>
                            <span>Filter</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="show__filter__right">
                <div class="filter__right__item">
                    <label for="">Kỳ học </label>
                    <select name="" class="sort_product_select" id="sort_by_semester" data_sort="semester">
                        <option value="">--- Chọn theo kỳ học ---</option>
                        @foreach ($semester as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="filter__right__item">
                    <label for="">Loại sản phẩm </label>
                    <select name="" class="sort_product_select" id="sort_by_product_type" data_sort="type">
                        <option value="">-- Chọn loại sản phẩm ---</option>
                        @foreach ($product_type as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="filter__right__item">
                    <label for="">Sắp xếp </label>
                    <select name="" class="sort_product_select" id="sort_by_any" data_sort="sort">
                        <option value="">--- Sắp xếp ---- </option>
                        <option value="rating">Đánh giá theo tháng </option>
                        <option value="view_desc">Sắp xếp lượt xem nhiều </option>
                        <option value="view_asc">Sắp xếp theo xem thấp </option>
                        <option value="name_asc">Sắp xếp theo tên a-z </option>
                        <option value="name_desc">Sắp xếp theo tên z-a </option>
                    </select>
                </div>
            </div>
            <div id="wrap_content">
                <div class="product_list">
                    @foreach ($products as $item)
                        <div class="product-item">
                            <div class="inner">
                                <a href="{{route('detail.product.view',['token'=> $item->token])}}">
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
                {{ $products->links() }}
                @if (count($products)==0)
                    <img src="{{asset('frontend')}}/images/no-result.png" style="max-width: 400px; display: flex; margin:auto;" alt="">
                @endif
            </div>
        </div>
    </div>
@endsection
@section('page-script')
    <script>
        
        // script UI
        $(window).on('load', function(event) {
            $(".home-page .home-content").fadeIn();
            $(".home-page .slider").fadeIn();
            $(".home-page .content-wrap").fadeIn();
            $('.loader').delay(500).fadeOut('fast');
        });
        const btnFilter = document.querySelector(".btn__filter");
        const showFilter = document.querySelector(".show__filter__right");
        btnFilter.addEventListener("click", (e) => {
            showFilter.classList.toggle("action");
        })

        
        // ajax requests
        activeParamSelect("semester") && $( "#sort_by_semester" ).val(activeParamSelect("semester"));
        function activeParamSelect(keyParam) {
            var params = (new URL(document.location)).searchParams;
            return params.get(keyParam);
        }
        activeParamSelect("type") && $( "#sort_by_product_type" ).val(activeParamSelect("type"));
        activeParamSelect("sort") && $( "#sort_by_any" ).val(activeParamSelect("sort"));
        function ajax_rerender_products(keySort,valSort, appendElement){
            var urlParam = new URL(window.location);
            urlParam.searchParams.set(keySort, valSort);
            window.history.pushState({}, '', urlParam);
            var params = window.location.search;
            let data = {
                param: params,
                pathname: window.location.pathname,
                _token: "{{csrf_token()}}"
            };
            $.ajax({
                url: "{{route('ajax_see_more.product')}}",
                method: "post",
                data: data,
                dataType: "json",
                success: function(resp){
                    if(resp.success){
                        $(appendElement).html(resp.data);
                    }
                },
                error: function(err) {
                    console.log("lỗi", err)
                }
            })
        }
        $(document).ready(function(){
            $('.sort_product_select').on('change', function(e){
                var data_sort = e.target.getAttribute("data_sort");
                ajax_rerender_products(data_sort,$(this).val(), '#wrap_content');
            });
        });
    </script>
@endsection
