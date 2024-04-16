@extends('layouts.app')
@section('title', 'Cart')

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
    </style>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href={{ route('frontend.home') }} rel="nofollow">Home</a>
                    <span></span> All Products
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4>All Products</h4>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ route('admin.addProduct') }}" class='btn btn-success float-end'>Add New
                                            Product</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @if (Session::has('success'))
                                    <div class="alert alert-success" role="alert">
                                        {{ Session::get('success') }}
                                    </div>
                                @endif
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Image</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Stock</th>
                                            <th class="text-center">Price</th>
                                            <th class="text-center">Category</th>
                                            <th class="text-center">Date</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = ($products->currentPage() - 1) * $products->perpage();
                                        @endphp
                                        @foreach ($products as $product)
                                            <tr>
                                                <td class="text-center">{{ ++$i }}</td>
                                                <td class="text-center"><img
                                                        src="{{ asset('assets/imgs/products') }}/{{ $product->image }}"
                                                        alt="{{ $product->name }}" width="60"></td>
                                                <td class="text-center">{{ $product->name }}</td>
                                                <td class="text-center">{{ $product->stock_status }}</td>
                                                <td class="text-center">{{ $product->regular_price }}</td>
                                                <td class="text-center">{{ $product->category->name }}</td>
                                                <td class="text-center">{{ $product->created_at }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('admin.editCategory', ['id' => $product->id]) }}"
                                                        class="text-info mr-5 pr-5">
                                                        Edit
                                                    </a>
                                                    <a href="#" onclick="deleteConfirmation({{ $product->id }})"
                                                        class="text-danger ml-5 pl-5">
                                                        Delete
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $products->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
