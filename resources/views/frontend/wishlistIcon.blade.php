<div class="header-action-icon-2">
    <a href="{{route('frontend.wishlist')}}">
        <img alt="Surfside Media" src="{{ asset('assets/imgs/theme/icons/icon-heart.svg') }}">
        @if (Cart::instance('wishlist')->count() > 0)
            <span class="pro-count blue">{{ Cart::instance('wishlist')->count() }}</span>
        @endif
    </a>
</div>
