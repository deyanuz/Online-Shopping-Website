@extends('layouts.app')
@section('title', 'Cart')

@section('content')

<style>
    nav svg{
        height: 20px;
    }
    nav .hidden{
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
                <span></span> All Categories
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
                                    <h4>All Categories</h4>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{route('admin.addCategory')}}" class='btn btn-success float-end'>Add New Category</a>
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
                                        <th class="text-center">Slug</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i=($categories->currentPage()-1)*$categories->perpage();
                                    @endphp
                                    @foreach ($categories as $category)
                                    <tr>
                                        <td class="text-center">{{++$i}}</td>
                                        <td class="text-center">{{$category->name}}</td>
                                        <td class="text-center">{{$category->slug}}</td>
                                        <td class="text-center">
                                            <a href="{{route('admin.editCategory',['id'=>$category->id])}}" class="text-info mr-5 pr-5">
                                                Edit
                                            </a>
                                            <a href="#" onclick="deleteConfirmation({{$category->id}})" class="text-danger ml-5 pl-5">
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{$categories->links()}}
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
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#delete-confirmation">Cancel</button>
                        <button type="button" id="deleteButton" class="btn btn-danger" >Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@push('script')
<script>
    function deleteConfirmation(id){
        $('#delete-confirmation').modal('show');
        document.getElementById("deleteButton").addEventListener("click", function() {
        window.location.href = '/admin/delete-category/' + id;
    });
    }

</script>

@endpush
