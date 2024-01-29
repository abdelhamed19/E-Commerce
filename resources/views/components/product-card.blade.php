<div class="single-product">
    <div class="product-image">
        <img src="{{ $product->image_url }}" alt="#" width="300" height="260">
        @if($product->compare_price_percentage)
        <span class="sale-tag">-{{ $product->compare_price_percentage }}%</span>
        @endif
        <div class="button">
            <a href="{{ route("front.products.show",$product->slug) }}" class="btn"><i class="lni lni-cart"></i> Add to Cart</a>
        </div>
    </div>
    <div class="product-info">
        <span class="category">{{ $product->category->name }}</span>
        <h4 class="title">
            <a href="{{ route("front.products.show",$product->slug) }}">{{ $product->name }}</a>
        </h4>
        <ul class="review">
            <li><i class="lni lni-star-filled"></i></li>
            <li><i class="lni lni-star-filled"></i></li>
            <li><i class="lni lni-star-filled"></i></li>
            <li><i class="lni lni-star-filled"></i></li>
            <li><i class="lni lni-star"></i></li>
            <li><span>4.0 Review(s)</span></li>
        </ul>
        <div class="price">
            {{-- <span>{{ $product->currency_format }}</span> --}}
            <span>{{ Currency::format($product->price) }}</span>
            @if ($product->Compare_Price)
            <span class="discount-price">{{ Currency::format($product->Compare_Price) }}</span>
            @endif
        </div>

        @if ($product->new)
        <div class="container mt-3">
            <h5 class="mb-2 text-blue" >New</h5>
        </div>
        @endif
    </div>
</div>
