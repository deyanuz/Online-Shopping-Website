@extends('layouts.app')
@section('title', 'Add Category')

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
                    <span></span> Add New Category
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
                                        <h4>Add New Category</h4>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{route('admin.categories')}}" class='btn btn-success float-end'>All Categories</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="">
                                    <div class="mb-3 mt-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" name='name' placeholder="Enter cetegory name"/>
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="slug" class="form-label">Slug</label>
                                        <input type="text" name="slug" class="form-control" placeholder="Enter cetegory slug"/>
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

@section('script')


@endsection
