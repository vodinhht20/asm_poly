<div class="product_list">
    @foreach ($products as $itemProduct)
        <div class="product-item">
            <div class="inner">
                <a href="{{route('detail.product.view',['token'=> $itemProduct->token])}}">
                    @if (!isset($itemProduct->product_gallery[0]->url_image_small) == null)
                        <img src="{{ $itemProduct->product_gallery[0]->url_image_small }}" style="max-height: 400px; min-height: 200px;"/>
                    @else
                        <img src="{{ asset('image-hold.png') }}" style="max-height: 400px; min-height: 200px;"/>
                    @endif
                    <p>{{ $itemProduct->name }}.</p>
                    <div class="custom-1">
                        <div class="user">
                            @if (!isset($itemProduct->user_product->avatar) == null)
                                <img src="{{ $itemProduct->user_product->avatar }}" alt="">
                            @endif
                            @if (!isset($itemProduct->user_product->avatar) == null)
                            <p>{{ $itemProduct->user_product->name }}</p> 
                            @endif
                        </div>
                    </div>
                    <div class="custom-2">
                        <div class="star">
                            @for ($i = 0; $i < floor($itemProduct->avgStar()); $i++)
                                <i class="fas fa-heart" style="font-size: 13px !important; color: #e81224;"></i>
                            @endfor
                            @if (round($itemProduct->avgStar(),1)-floor($itemProduct->avgStar())>= 0.5)
                                <i class="fas fa-heart-broken" style="font-size: 13px !important; color: #e81224;"></i>
                            @endif
                            @for ($i = 0; $i < 5-round($itemProduct->avgStar()); $i++)
                                <i class="far fa-heart" style="font-size: 13px !important; color: #e81224;"></i>
                            @endfor
                            <span>{{round($itemProduct->avgStar(),1)}}/5</span>
                        </div>
                        <i class="far fa-eye"> {{$itemProduct->view}}</i>
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