@props(['product' => null, 'sale' => false])

<!-- Start Single Product -->
<div class="single-product">
    <div class="product-image">
        <img src="{{ $product->image_url }}" alt="#">
        @if ($product->sale_percent)
            <span class="sale-tag">-{{ $product->sale_percent }}%</span>
        @endif
        @if ($product->new)
            <span class="new-tag">New</span>
        @endif
        <form action="{{ route('front.cart.store') }}" method="post">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <div class="button">
                <button type="submit" class="btn"><i class="lni lni-cart"></i> Add to
                    Cart</button>
            </div>
        </form>
    </div>
    <div class="product-info">
        <span class="category">{{ $product->category->name }}</span>
        <h4 class="title">
            <a href="{{ route('front.products.show', $product->slug) }}">{{ $product->name }}</a>
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
            <span>{{ Currency::format($product->price) }}</span>
            @if ($product->compare_price)
                <span class="discount-price">{{ Currency::format($product->compare_price) }}</span>
            @endif
        </div>
    </div>
</div>
<!-- End Single Product -->
