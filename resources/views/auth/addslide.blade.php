@extends('layouts.app')
@section('title', 'Home Slider')

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
                    <span></span> Add New Slide
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
                                        <h4>Add New Slide</h4>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ route('admin.homeSlider') }}" class='btn btn-success float-end'>All
                                            Slides</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @if (Session::has('success'))
                                    <div class="alert alert-success" role="alert">
                                        {{ Session::get('success') }}
                                    </div>
                                @endif
                                <form action="{{ route('admin.storeSlide') }}" method="POST"  enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3 mt-3">
                                        <label for="name" class="form-label">Top Title</label>
                                        <input type="text" class="form-control" name='top_title'
                                            placeholder="Enter slide top title" required />
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="slug" class="form-label">Title</label>
                                        <input type="text" name="title" class="form-control"
                                            placeholder="Enter slide title" required />
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="slug" class="form-label">Sub Title</label>
                                        <input type="text" name="sub_title" class="form-control"
                                            placeholder="Enter slide title" required />
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="slug" class="form-label">Offer</label>
                                        <input type="text" name="offer" class="form-control"
                                            placeholder="Enter slide offer" required />
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="slug" class="form-label">Link</label>
                                        <input type="text" name="link" class="form-control"
                                            placeholder="Enter slide link" required />
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="status" class="form-label" required>Status</label>
                                        <select name="status" class="form-select">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="image" class="form-label" required>Image</label>
                                        <input type="file" id="image-input" name="image" class="form-control" />
                                        <img id="image-preview" class="mt-20" src="#" alt="Preview"
                                            style="display: none; width: 120px; height: 120px;" />
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
