@extends('layouts.app')
@section('title', 'Wishlist')

@section('content')
    <div>
        <style>
            nav svg {
                height: 20px;
            }

            nav .hidden {
                display: block;
            }

            p {
                font-size: 15px !important;
                margin-bottom: 5px !important;
                margin-top: 5px !important;
                padding-left: 3px !important;
            }

            .wishlisted {
                background-color: rgb(151, 79, 203) !important;
                border: 1px solid transparent !important;
            }

            .wishlisted i {
                color: #fff !important;
            }

            .wishlisted::after {
                left: -30% !important;
            }
        </style>

        <main class="main">
            <div class="page-header breadcrumb-wrap">
                <div class="container">
                    <div class="breadcrumb">
                        <a href={{ route('frontend.home') }} rel="nofollow">Home</a>
                        <span></span> Wishlist
                    </div>
                </div>
            </div>
            <section class="mt-50 mb-50">
                <div class="container">
                    <div class="row product-grid-4">
                        @if (Cart::instance('wishlist')->count() > 0)
                            @foreach (Cart::instance('wishlist')->content() as $item)
                                <div class="col-lg-3 col-md-3 col-6 col-sm-6">
                                    <div class="product-cart-wrap mb-30">
                                        <div class="product-img-action-wrap">
                                            <div class="product-img product-img-zoom">
                                                <a href="{{ route('product.details', ['slug' => $item->model->slug]) }}">
                                                    <img class="default-img"
                                                        src="{{ asset('assets/imgs/products') }}/{{ $item->model->image }}"
                                                        alt="{{ $item->model->name }}">
                                                    <img class="hover-img"
                                                        src="{{ asset('assets/imgs/products') }}/{{ $item->model->image }}"
                                                        alt="{{ $item->model->name }}">
                                                </a>
                                            </div>
                                            <div class="product-action-1">
                                                <a aria-label="Quick view" class="action-btn hover-up"
                                                    data-bs-toggle="modal" data-bs-target="#quickViewModal">
                                                    <i class="fi-rs-search"></i></a>
                                                <a aria-label="Add To Wishlist" class="action-btn hover-up"
                                                    href="wishlist.php"><i class="fi-rs-heart"></i></a>
                                                <a aria-label="Compare" class="action-btn hover-up" href="compare.php"><i
                                                        class="fi-rs-shuffle"></i></a>
                                            </div>
                                            <div class="product-badges product-badges-position product-badges-mrg">
                                                <span class="hot">Hot</span>
                                            </div>
                                        </div>
                                        <div class="product-content-wrap">
                                            <div class="product-category">
                                                <a href="#">{{ $item->model->category->name }}</a>
                                            </div>
                                            <h2><a
                                                    href="{{ route('product.details', ['slug' => $item->model->slug]) }}">{{ $item->model->name }}</a>
                                            </h2>
                                            <div class="rating-result" title="90%">
                                                <span>
                                                    <span>90%</span>
                                                </span>
                                            </div>
                                            <div class="product-price">
                                                <span>${{ $item->model->regular_price }} </span>
                                            </div>
                                            <div class="product-action-1 show">

                                                <a aria-label="Remove From Wishlist" class="action-btn hover-up wishlisted"
                                                    href="{{ route('wishlist.removeFromWishlist', ['id' => $item->model->id]) }}"><i
                                                        class="fi-rs-heart"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="row mb-5 pb-5">
                                <div class="col-md-12 text-center">
                                    <h2>Your Wishlist is Empty!</h2>
                                    <h5 class='mt-3 mb-5'>Add items to it now!</h5>
                                    <a href="{{ route('frontend.shop') }}" class="btn btn-warning mt-5 mb-5 pb-5">Shop</a>
                                    <p class="mb-5 mt-5 pb-5"> </p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </section>
    </div>

@endsection
