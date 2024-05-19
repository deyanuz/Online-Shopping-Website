@extends('layouts.app')
@section('title', 'Edit Slider')

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
                    <span></span> Edit Slide
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
                                        <h4>Edit Slide</h4>
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
                                <form action="{{ route('admin.updateSlide', ['id' => $id]) }}" method="POST"  enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3 mt-3">
                                        <label for="name" class="form-label">Top Title</label>
                                        <input type="text" class="form-control" name='top_title'
                                            placeholder="Enter slide top title" value="{{$slide->top_title}}" required />
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="slug" class="form-label">Title</label>
                                        <input type="text" name="title" class="form-control"
                                            placeholder="Enter slide title" value="{{$slide->title}}" required />
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="slug" class="form-label">Sub Title</label>
                                        <input type="text" name="sub_title" class="form-control"
                                            placeholder="Enter slide title" value="{{$slide->sub_title}}" required />
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="slug" class="form-label">Offer</label>
                                        <input type="text" name="offer" class="form-control"
                                            placeholder="Enter slide offer" value="{{$slide->offer}}" required />
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="slug" class="form-label">Link</label>
                                        <input type="text" name="link" class="form-control"
                                            placeholder="Enter slide link" value="{{$slide->link}}" required />
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="status" class="form-label" required>Status</label>
                                        <select name="status" class="form-select">
                                            <option value="1" @if ($slide->status == 1) selected @endif>Active</option>
                                            <option value="0" @if ($slide->status == 0) selected @endif>Inactive</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="image" class="form-label" required>Image</label>
                                        <input type="file" id="image-input" name="image" class="form-control" />
                                        <img id="image-preview"
                                            src="{{ asset('assets/imgs/slider') }}/{{ $slide->image }}"
                                            class="mt-20" alt="Preview"
                                            style="display: block; width: 120px; height: 120px;" />
                                    </div>
                                    <button class="btn btn-primary float-end" type="submit">Update</button>
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
