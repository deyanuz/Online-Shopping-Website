<div class="header-action-icon-2">
    <a class="mini-cart-icon" href={{ route('frontend.cart') }}>
        <img alt="cart" src="{{ asset('assets/imgs/theme/icons/icon-cart.svg') }}">
        @if (Cart::count() > 0)
            <span class="pro-count blue">{{ Cart::count() }}</span>
        @endif

    </a>
    <div class="cart-dropdown-wrap cart-dropdown-hm2">
        <ul>
            @foreach (Cart::content() as $item)
                <li>
                    <div class="shopping-cart-img">
                        <a href="{{ route('product.details', ['slug' => $item->model->slug]) }}"><img
                                alt="{{ $item->model->name }}"
                                src="{{ asset('assets/imgs/shop/thumbnail-') }}{{ $item->model->id }}.jpg"></a>
                    </div>
                    <div class="shopping-cart-title">
                        <h4><a
                                href="{{ route('product.details', ['slug' => $item->model->slug]) }}">{{ substr($item->model->name, 0, 15) }}...</a>
                        </h4>
                        <h4><span>{{ $item->qty }} × </span>{{ $item->model->regular_price }}</h4>
                    </div>
                    {{--<div class="shopping-cart-delete">
                    <a href="#"><i class="fi-rs-cross-small"></i></a>
                        </div> --}}
                </li>
            @endforeach
        </ul>
        <div class="shopping-cart-footer">
            <div class="shopping-cart-total">
                <h4>Total <span>${{ Cart::total() }}</span></h4>
            </div>
            <div class="shopping-cart-button">
                <a href={{ route('frontend.cart') }} class="outline">View cart</a>
                <a href={{ route('frontend.checkout') }}>Checkout</a>
            </div>
        </div>
    </div>
</div>
