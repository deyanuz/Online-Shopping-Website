@extends('layouts.app')
@section('title', 'Edit Product')

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
                    <span></span> Edit Product
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
                                        <h4>Edit Product</h4>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ route('admin.products') }}" class='btn btn-success float-end'>All
                                            Products</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @if (Session::has('success'))
                                    <div class="alert alert-success" role="alert">
                                        {{ Session::get('success') }}
                                    </div>
                                @endif
                                <form action="{{ route('admin.updateProduct', ['id' => $id]) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3 mt-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" name='name'
                                            placeholder="Enter cetegory name" value="{{ $product->name }}" required />
                                    </div>

                                    <div class="mb-3 mt-3">
                                        <label for="slug" class="form-label">Slug</label>
                                        <input type="text" name="slug" class="form-control"
                                            placeholder="Enter cetegory slug" value="{{ $product->slug }}" required />
                                    </div>

                                    <div class="mb-3 mt-3">
                                        <label for="short_description" class="form-label">Short Description</label>
                                        <textarea name="short_description" class="form-control" placeholder="Enter Short Description" required>{{ $product->short_description }}</textarea>
                                    </div>

                                    <div class="mb-3 mt-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea name="description" class="form-control" placeholder="Enter Description" required>{{ $product->description }}</textarea>
                                    </div>

                                    <div class="mb-3 mt-3">
                                        <label for="regular_price" class="form-label">Regular Price</label>
                                        <input type="text" name="regular_price" class="form-control"
                                            placeholder="Enter Regular Price" value="{{ $product->regular_price }}"
                                            required />
                                    </div>

                                    <div class="mb-3 mt-3">
                                        <label for="sale_price" class="form-label">Sale Price</label>
                                        <input type="text" name="sale_price" class="form-control"
                                            placeholder="Enter Sale Price" value="{{ $product->sale_price }}" />
                                    </div>

                                    <div class="mb-3 mt-3">
                                        <label for="sku" class="form-label" required>SKU</label>
                                        <input type="text" name="sku" class="form-control" placeholder="Enter SKU"
                                            value="{{ $product->sku }}" />
                                    </div>

                                    <div class="mb-3 mt-3">
                                        <label for="stock_status" class="form-label">Stock Status</label>
                                        <select name="stock_status" class="form-control" required>
                                            <option value="instock" @if ($product->stock_status == 'instock') selected @endif>
                                                Instock</option>
                                            <option value="outofstock" @if ($product->stock_status == 'outofstock') selected @endif>Out
                                                of Stock</option>
                                        </select>
                                    </div>

                                    <div class="mb-3 mt-3">
                                        <label for="featured" class="form-label" required>Featured</label>
                                        <select name="featured" class="form-control" value="{{ $product->featured }}">
                                            <option value="1" @if ($product->featured == '1') selected @endif>Yes
                                            </option>
                                            <option value="0" @if ($product->featured == '0') selected @endif>No
                                            </option>
                                        </select>
                                    </div>

                                    <div class="mb-3 mt-3">
                                        <label for="quantity" class="form-label" required>Quantity</label>
                                        <input type="text" name="quantity" class="form-control"
                                            placeholder="Enter Quantity" value="{{ $product->quantity }}" required />
                                    </div>

                                    <div class="mb-3 mt-3">
                                        <label for="image" class="form-label" required>Image</label>
                                        <input type="file" id="image-input" name="image" class="form-control" />
                                        <img id="image-preview"
                                            src="{{ asset('assets/imgs/products') }}/{{ $product->image }}"
                                            class="mt-20" alt="Preview"
                                            style="display: block; width: 120px; height: 120px;" />
                                    </div>

                                    <div class="mb-3 mt-3">
                                        <label for="category" class="form-label" required>Category</label>
                                        <select name="category" class="form-control">
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    @if ($category->id == $product->category_id) selected @endif>{{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <button class="btn btn-primary float-end" type="submit">Upadate</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>



@endsection

@push('script')
    <script>
        document.getElementById('image-input').addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('image-preview').src = e.target.result;
                    document.getElementById('image-preview').style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endpush
