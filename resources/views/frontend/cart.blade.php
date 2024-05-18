@extends('layouts.app')
@section('title', 'Cart')

@section('content')

    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href={{ route('frontend.home') }} rel="nofollow">Home</a>
                    <span></span> Shop
                    <span></span> Your Cart
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table shopping-summery text-center clean">
                                <thead>
                                    @if (Session::has('success'))
                                        <div class="alert alert-success">
                                            <strong>Success! {{ Session::get('success') }}</strong>
                                        </div>
                                    @elseif (Session::has('error'))
                                        <div class="alert alert-danger">
                                            <strong>Error! {{ Session::get('error') }}</strong>
                                        </div>
                                    @endif
                                    @if ($cartItems->Count() > 0)
                                        <tr class="main-heading">
                                            <th scope="col">Image</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Subtotal</th>
                                            <th scope="col">Remove</th>
                                        </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cartItems as $item)
                                        <tr>
                                            <td class="image product-thumbnail"><img
                                                    src="{{ asset('assets/imgs/products') }}/{{ \App\Models\Product::where('slug',$item->model->slug)->first()->image }}"
                                                    alt="#"></td>
                                            <td class="product-des product-name">
                                                <h5 class="product-name"><a
                                                        href="{{ route('product.details', ['slug' => $item->model->slug]) }}">{{ $item->model->name }}</a>
                                                </h5>
                                                {{-- <p class="font-xs">Maboriosam in a tonto nesciung eget<br> distingy magndapibus.
                                            </p> --}}
                                            </td>
                                            <td class="price" data-title="Price"><span>${{ $item->model->regular_price }}
                                                </span></td>
                                            <td class="text-center" data-title="Stock">
                                                <div class="detail-qty border radius  m-auto">
                                                    <a href="{{ route('decrease.cart', ['id' => $item->model->id, 'qty' => $item->qty]) }}"
                                                        class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                                    <span class="qty-val">{{ $item->qty }}</span>
                                                    <a href="{{ route('increase.cart', ['id' => $item->model->id, 'qty' => $item->qty]) }}
                                                    "
                                                        class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                                </div>
                                            </td>
                                            <td class="text-right" data-title="Cart">
                                                <span>${{ $item->subtotal }} </span>
                                            </td>
                                            <td class="action" data-title="Remove"><a
                                                    href="{{ route('delete.cart', ['id' => $item->model->id]) }}"
                                                    class="text-muted"><i class="fi-rs-trash"></i></a></td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="6" class="text-end">
                                            <a href="{{ route('clear.cart') }}" class="text-muted"> <i
                                                    class="fi-rs-cross-small"></i> Clear
                                                Cart</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="cart-action text-end">
                            {{-- <a class="btn  mr-10 mb-sm-15"><i class="fi-rs-shuffle mr-10"></i>Update Cart</a> --}}
                            <a class="btn " href="{{ route('frontend.shop') }}"><i
                                    class="fi-rs-shopping-bag mr-10"></i>Continue Shopping</a>
                        </div>
                        <div class="divider center_icon mt-50 mb-50"><i class="fi-rs-fingerprint"></i></div>
                        <div class="row mb-50">
                            <div class="col-lg-6 col-md-12">
                                <div class="border p-md-4 p-30 border-radius cart-totals">
                                    <div class="heading_s1 mb-3">
                                        <h4>Cart Totals</h4>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td class="cart_total_label">Cart Subtotal</td>
                                                    <td class="cart_total_amount"><span
                                                            class="font-lg fw-900 text-brand">${{ Cart::instance('cart')->subtotal() }}</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="cart_total_label">Tax</td>
                                                    <td class="cart_total_amount"><span
                                                            class="font-lg fw-900 text-brand">${{ Cart::instance('cart')->tax() }}</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="cart_total_label">Shipping</td>
                                                    <td class="cart_total_amount"> <i class="ti-gift mr-5"></i> Free
                                                        Shipping</td>
                                                </tr>
                                                <tr>
                                                    <td class="cart_total_label">Total</td>
                                                    <td class="cart_total_amount"><strong><span
                                                                class="font-xl fw-900 text-brand">${{ Cart::instance('cart')->total() }}</span></strong>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <form method="POST" action="{{ route('checkout.payment') }}">
                                        @csrf
                                        <!-- Other form fields can go here if needed -->
                                        <button type="submit" class="btn"><i class="fi-rs-box-alt mr-10"></i> Proceed
                                            To CheckOut</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    @else
                        <div class="row mb-5 pb-5">
                            <div class="col-md-12 text-center">
                                <h2>Your Cart is Empty!</h2>
                                <h5 class='mt-3 mb-5'>Add items to it now!</h5>
                                <a href="{{ route('frontend.shop') }}" class="btn btn-warning mt-5 mb-5 pb-5">Shop
                                    Now</a>
                                <p class="mb-5 mt-5 pb-5"> </p>
                            </div>
                        </div>

                        @endif
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection

@section('script')


@endsection
