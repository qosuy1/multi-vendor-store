<!-- Shopping Item -->
<div class="shopping-item">
    <div class="dropdown-cart-header">
        <span>{{ $productsCount }} Items</span>
        <a href="{{ route('front.cart.index') }}">View All</a>
    </div>
    <ul class="shopping-list">
        @foreach ($items as $item)
            <li id="{{ $item->id }}">
                <a href="javascript:void(0)" class="remove remove-item" data-id="{{ $item->id }}" title="Remove this item"><i
                        class="lni lni-close"></i></a>
                <div class="cart-img-head">
                    <a class="cart-img" href="{{ route('front.products.show', $item->product->slug) }}">
                        <img src="{{ $item->product->image_url }}" alt="$item->product->slug"></a>
                </div>

                <div class="content">
                    <h4><a href="{{ route('front.products.show', $item->product->slug) }}">
                            {{ $item->product->name }}</a></h4>
                    <p class="quantity">{{ $item->quantity }}x - <span
                            class="amount">{{ Currency::format($item->product->price) }}</span>
                    </p>
                </div>
            </li>
        @endforeach

    </ul>
    @if(count($items) > 0)
    <div class="bottom">
        <div class="total">
            <span>Total</span>
            <span class="total-amount">{{ Currency::format($totalAmount) }}</span>
        </div>
        <div class="button">
            <a href="checkout.html" class="btn animate">Checkout</a>
        </div>
    </div>
    @else
        <div class="bottom">
            <p class=""> No products yet</p>
        </div>
    @endif
</div>
<!--/ End Shopping Item -->
