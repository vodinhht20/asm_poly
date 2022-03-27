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
                            @for ($i = 0; $i < floor($item->avgStarTotal($item->id)); $i++)
                                <i class="fas fa-heart" style="font-size: 13px !important; color: #e81224;"></i>
                            @endfor
                            @if (round($item->avgStarTotal($item->id),1)-floor($item->avgStarTotal($item->id))>= 0.5)
                                <i class="fas fa-heart-broken" style="font-size: 13px !important; color: #e81224;"></i>
                            @endif
                            @for ($i = 0; $i < 5-round($item->avgStarTotal($item->id)); $i++)
                                <i class="far fa-heart" style="font-size: 13px !important; color: #e81224;"></i>
                            @endfor
                            <span>{{round($item->avgStarTotal($item->id),1)}}/5</span>
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