@extends('layouts.app')
@section('title', 'Edit Category')

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
                    <span></span> Edit Category
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
                                        <h4>Edit Category</h4>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ route('admin.categories') }}" class='btn btn-success float-end'>All
                                            Categories</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @if (Session::has('success'))
                                    <div class="alert alert-success" role="alert">
                                        {{ Session::get('success') }}
                                    </div>
                                @endif
                                <form action="{{ route('admin.updateCategory',['id'=>$id]) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3 mt-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" name='name'
                                            placeholder="Enter cetegory name" value="{{ $category->name }}" required />
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="slug" class="form-label">Slug</label>
                                        <input type="text" name="slug" class="form-control"
                                            placeholder="Enter cetegory slug" value="{{ $category->slug }}" required />
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="is_popular" class="form-label" required>Popular</label>
                                        <select name="is_popular" class="form-control">
                                            <option value="1" @if ($category->is_popular == '1') selected @endif>Yes
                                            </option>
                                            <option value="0" @if ($category->is_popular == '0') selected @endif>No
                                            </option>
                                        </select>
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="image" class="form-label" required>Image</label>
                                        <input type="file" id="image-input" name="image" class="form-control" />
                                        <img id="image-preview"
                                            src="{{ asset('assets/imgs/categories') }}/{{ $category->image }}"
                                            class="mt-20" alt="Preview"
                                            style="display: block; width: 120px; height: 120px;" />
                                    </div>
                                    <button class="btn btn-primary float-end" type="submit">Submit</button>
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
