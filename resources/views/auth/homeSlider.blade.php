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
                    <span></span> All Slides
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
                                        <h4>All Slides</h4>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ route('admin.addSlide') }}" class='btn btn-success float-end'>Add New
                                            Slide</a>
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
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Top Title</th>
                                            <th class="text-center">Title</th>
                                            <th class="text-center">Sub-Title</th>
                                            <th class="text-center">Offer</th>
                                            <th class="text-center">Link</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 0;
                                        @endphp
                                        @foreach ($slides as $slide)
                                            <tr>
                                                <td class="text-center">{{ ++$i }}</td>
                                                <td class="text-center"><img src="{{asset('assets/imgs/slider')}}/{{ $slide->image }}" width="80"/></td>
                                                <td class="text-center">{{ $slide->top_title }}</td>
                                                <td class="text-center">{{ $slide->title }}</td>
                                                <td class="text-center">{{ $slide->sub_title }}</td>
                                                <td class="text-center">{{ $slide->offer }}</td>
                                                <td class="text-center">{{ $slide->link }}</td>
                                                <td class="text-center">{{ $slide->status == 1? 'Active':'Inacctive' }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('admin.editSlide', ['id' => $slide->id]) }}"
                                                        class="text-info mr-5 pr-5">
                                                        Edit
                                                    </a>
                                                    <a href="#" onclick="deleteConfirmation({{ $slide->id }})"
                                                        class="text-danger ml-5 pl-5">
                                                        Delete
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <div class="modal" id="delete-confirmation">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="col-md-12 text-center text-danger">WARNING!</h3>
                </div>
                <div class="modal-body pb-30">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h4 class="pb-3">Do you want to delete this record?</h4>
                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                                data-bs-target="#delete-confirmation">Cancel</button>
                            <button type="button" id="deleteButton" class="btn btn-danger">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('script')
    <script>
        function deleteConfirmation(id) {
            $('#delete-confirmation').modal('show');
            document.getElementById("deleteButton").addEventListener("click", function() {
                window.location.href = '/admin/delete-slide/' + id;
            });
        }
    </script>
@endpush
