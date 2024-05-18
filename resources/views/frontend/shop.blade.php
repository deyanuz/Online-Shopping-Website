@extends('layouts.app')
@section('title', 'Shop')

@section('content')

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
    </style>

    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href={{ route('frontend.home') }} rel="nofollow">Home</a>
                    <span></span> Shop
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        @if (Session::has('success'))
                            <div class="alert alert-success">
                                <strong>Success! {{ Session::get('success') }}</strong>
                            </div>
                        @endif
                        <div class="shop-product-fillter">
                            <div class="totall-product">
                                <p> We found <strong class="text-brand">{{ $products->total() }}</strong> items for you!</p>
                            </div>
                            <div class="sort-by-product-area">
                                <div class="sort-by-cover mr-10">
                                    <div class="sort-by-product-wrap">
                                        <div class="sort-by">
                                            <span><i class="fi-rs-apps"></i>Show:</span>
                                        </div>
                                        <div class="sort-by-dropdown-wrap">
                                            <span> {{ $size }} <i class="fi-rs-angle-small-down"></i></span>
                                        </div>
                                    </div>
                                    <div class="sort-by-dropdown">
                                        <ul>
                                            <li><a @if ($size == 12) class="active" @endif
                                                    href="{{ route('shop.changePageSize', ['size' => 12]) }}">12</a></li>
                                            <li><a @if ($size == 15) class="active" @endif
                                                    href="{{ route('shop.changePageSize', ['size' => 15]) }}">15</a></li>
                                            <li><a @if ($size == 24) class="active" @endif
                                                    href="{{ route('shop.changePageSize', ['size' => 24]) }}">24</a></li>
                                            <li><a @if ($size == 30) class="active" @endif
                                                    href="{{ route('shop.changePageSize', ['size' => 30]) }}">30</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="sort-by-cover">
                                    <div class="sort-by-product-wrap">
                                        <div class="sort-by">
                                            <span><i class="fi-rs-apps-sort"></i>Sort by:</span>
                                        </div>
                                        <div class="sort-by-dropdown-wrap">
                                            <span>{{ $orderBy }}<i class="fi-rs-angle-small-down"></i></span>
                                        </div>
                                    </div>
                                    <div class="sort-by-dropdown">
                                        <ul>
                                            <li><a @if ($orderBy == 'Default Sorting') class="active" @endif
                                                    href="{{ route('shop.changeOrderBy', ['orderBy' => 'Default Sorting']) }}">Default
                                                    Sorting</a></li>
                                            <li><a @if ($orderBy == 'Price: Low to High') class="active" @endif
                                                    href="{{ route('shop.changeOrderBy', ['orderBy' => 'Price: Low to High']) }}">Price:
                                                    Low to High</a></li>
                                            <li><a @if ($orderBy == 'Price: High to Low') class="active" @endif
                                                    href="{{ route('shop.changeOrderBy', ['orderBy' => 'Price: High to Low']) }}">Price:
                                                    High to Low</a></li>
                                            <li><a @if ($orderBy == 'Newest Arrivals') class="active" @endif
                                                    href="{{ route('shop.changeOrderBy', ['orderBy' => 'Newest Arrivals']) }}">Newest
                                                    Arrivals</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row product-grid-3">
                            @php
                                $witems = Cart::instance('wishlist')->content()->pluck('id');
                            @endphp
                            @foreach ($products as $product)
                                <div class="col-lg-4 col-md-4 col-6 col-sm-6">
                                    <div class="product-cart-wrap mb-30">
                                        <div class="product-img-action-wrap">
                                            <div class="product-img product-img-zoom">
                                                <a href="{{ route('product.details', ['slug' => $product->slug]) }}">
                                                    <img class="default-img"
                                                        src="{{ asset('assets/imgs/products') }}/{{ $product->image }}"
                                                        alt="{{ $product->name }}">
                                                    <img class="hover-img"
                                                        src="{{ asset('assets/imgs/products') }}/{{ $product->image }}"
                                                        alt="{{ $product->name }}">
                                                </a>
                                            </div>
                                            <div class="product-action-1">
                                            </div>
                                            <div class="product-badges product-badges-position product-badges-mrg">
                                                <span class="hot">Hot</span>
                                            </div>
                                        </div>
                                        <div class="product-content-wrap">
                                            <div class="product-category">
                                                <a href={{ route('frontend.shop') }}>{{ $product->category->name }}</a>
                                            </div>
                                            <h2><a
                                                    href="{{ route('product.details', ['slug' => $product->slug]) }}">{{ $product->name }}</a>
                                            </h2>
                                            <div class="rating-result" title="90%">
                                                <span>
                                                    <span>90%</span>
                                                </span>
                                            </div>
                                            <div class="product-price">
                                                <span>${{ $product->regular_price }} </span>
                                            </div>
                                            <div class="product-action-1 show">
                                                @if ($witems->contains($product->id))
                                                    <a aria-label="Remove From Wishlist"
                                                        class="action-btn hover-up wishlisted"
                                                        href="{{ route('removeFromWishlist', ['id' => $product->id]) }}"><i
                                                            class="fi-rs-heart"></i></a>
                                                @else
                                                    <a aria-label="Add To Wishlist" class="action-btn hover-up"
                                                        href="{{ route('addToWishlist', ['id' => $product->id]) }}"><i
                                                            class="fi-rs-heart"></i></a>
                                                @endif
                                                <a aria-label="Add To Cart" class="action-btn hover-up"
                                                    href="{{ route('addToCart', ['id' => $product->id]) }}">
                                                    <i class="fi-rs-shopping-bag-add"></i>
                                                </a>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!--pagination-->
                        <div class="pagination-area mt-15 mb-sm-5 mb-lg-0">
                            {{ $products->links() }}

                        </div>
                    </div>
                    <div class="col-lg-3 primary-sidebar sticky-sidebar">
                        <div class="row">
                            <div class="col-lg-12 col-mg-6"></div>
                            <div class="col-lg-12 col-mg-6"></div>
                        </div>
                        <div class="widget-category mb-30">
                            <h5 class="section-title style-1 mb-30 wow fadeIn animated">Category</h5>
                            <ul class="categories">
                                @foreach ($categories as $category)
                                    <li><a
                                            href={{ route('shop.productByCategory', ['slug' => $category->slug]) }}>{{ $category->name }}</a>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                        <!-- Fillter By Price -->
                        <div class="sidebar-widget price_range range mb-30">
                            <div class="widget-header position-relative mb-20 pb-10">
                                <h5 class="widget-title mb-10">Filter by price</h5>
                                <div class="bt-1 border-color-1"></div>
                            </div>
                            <div class="price-filter">
                                <div class="price-filter-inner">
                                    <div class="label-input">
                                        <span>Range:</span>
                                        <form id="pform" method="get" method="{{ route('frontend.shop') }}">
                                            <input type="text" class="form-control border-bottom mt-5" id="amount"
                                                name="price1" placeholder="Enter minimum price">
                                            <input type="text" class="form-control border-bottom mt-5" id="amount"
                                                name="price2" placeholder="Enter maximum price">
                                            <button type="submit" class="btn btn-sm btn-default mt-10"><i
                                                    class="fi-rs-filter mr-5"></i>Filter</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Product sidebar Widget -->
                        <div class="sidebar-widget product-sidebar  mb-30 p-30 bg-grey border-radius-10">
                            <div class="widget-header position-relative mb-20 pb-10">
                                <h5 class="widget-title mb-10">New products</h5>
                                <div class="bt-1 border-color-1"></div>
                            </div>
                            @foreach ($nproducts as $nproduct)
                                <div class="single-post clearfix">
                                    <div class="image">
                                        <img src="{{ asset('assets/imgs/products') }}/{{ $nproduct->image }}"
                                            alt="{{ $nproduct->name }}">
                                    </div>
                                    <div class="content pt-10">
                                        <h5><a
                                                href="{{ route('product.details', ['slug' => $nproduct->slug]) }}">{{ $nproduct->name }}</a>
                                        </h5>
                                        <p class="price mb-0 mt-5">${{ $nproduct->regular_price }}</p>
                                        <div class="product-rate">
                                            <div class="product-rating" style="width:90%"></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection
@push('script')
@endpush
