<x-front-layout title="Cart" cartCount=4>

    <x-slot name="breadcrumbs">
        <x-frontend.breadcrumbs page_title="Cart">
            <x-frontend.breadcrumb-item href="{{ route('front.cart.index') }}">Cart</x-frontend.breadcrumb-item>
        </x-frontend.breadcrumbs>
    </x-slot>



    <!-- Shopping Cart -->
    <div class="shopping-cart section">
        <div class="container">
            <div class="cart-list-head">
                <!-- Cart List Title -->
                <div class="cart-list-title">
                    <div class="row">
                        <div class="col-lg-1 col-md-1 col-12">

                        </div>
                        <div class="col-lg-4 col-md-3 col-12">
                            <p>Product Name</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Quantity</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Subtotal</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Discount</p>
                        </div>
                        <div class="col-lg-1 col-md-2 col-12">
                            <p>Remove</p>
                        </div>
                    </div>
                </div>
                <!-- End Cart List Title -->
                <!-- Cart Single List list -->
                @foreach ($cart->get() as $cartItem)
                    <div class="cart-single-list" id="{{ $cartItem->id }}">
                        <div class="row align-items-center">
                            <div class="col-lg-1 col-md-1 col-12">
                                <a href="{{ route('front.products.show', $cartItem->product->slug) }}"><img
                                        src="{{ $cartItem->product->image_url }}" alt="#"></a>
                            </div>
                            <div class="col-lg-4 col-md-3 col-12">
                                <h5 class="product-name"><a
                                        href="{{ route('front.products.show', $cartItem->product->slug) }}">
                                        {{ $cartItem->product->name }}</a></h5>
                                <p class="product-des">
                                    <span><em>Type:</em> {{ $cartItem->product->type }}</span>
                                    <span><em>Color:</em> {{ $cartItem->product->color }}</span>
                                </p>
                            </div>
                            <div class="col-lg-2 col-md-2 col-12">
                                <div class="count-input">
                                    <input class="form-control item-quantity" data-id="{{ $cartItem->id }}"
                                        value="{{ $cartItem->quantity }}">
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-12">
                                <p>{{ Currency::format($cartItem->product->price) }}</p>
                            </div>
                            <div class="col-lg-2 col-md-2 col-12">
                                <p>{{ Currency::format(0) }}</p>
                            </div>
                            <div class="col-lg-1 col-md-2 col-12">
                                <a class="remove-item" data-id="{{ $cartItem->id }}" href="javascript:void(0)"><i
                                        class="lni lni-close"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
                <!-- End Single List list -->

            </div>
            <div class="row">
                <div class="col-12">
                    <!-- Total Amount -->
                    <div class="total-amount">
                        <div class="row">
                            <div class="col-lg-8 col-md-6 col-12">
                                <div class="left">
                                    <div class="coupon">
                                        <form action="#" target="_blank">
                                            <input name="Coupon" placeholder="Enter Your Coupon">
                                            <div class="button">
                                                <button class="btn">Apply Coupon</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="right">
                                    <ul>
                                        <li>Cart Subtotal<span>{{ Currency::format($cart->getTotalPrice()) }}</span>
                                        </li>
                                        <li>Shipping<span>Free</span></li>
                                        <li>You Save<span>{{ Currency::format(0) }}</span></li>
                                        <li class="last">You
                                            Pay<span>{{ Currency::format($cart->getTotalPrice()) }}</span></li>
                                    </ul>
                                    <div class="button">
                                        <a href="{{ route('front.checkout.show') }}" class="btn">Checkout</a>
                                        <a href="{{ route('front.home') }}" class="btn btn-alt">Continue shopping</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ End Total Amount -->
                </div>
            </div>
        </div>
    </div>
    <!--/ End Shopping Cart -->

    @push('scripts')
        <script>
            const csrf_token = "{{ csrf_token() }}";
        </script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    @endpush
    @vite(['resources/js/cart.js'])
</x-front-layout>
