@extends('layouts.app')
@section('title', 'Home')

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
                                        <h4>All Messages</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @if (Session::has('success'))
                                    <div class="alert alert-success" role="alert">
                                        {{ Session::get('success') }}
                                    </div>
                                @endif
                                @if ($messages->count()==0)
                                    No Messages
                                @else
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">Name</th>
                                                <th class="text-center">Email</th>
                                                <th class="text-center">Phone</th>
                                                <th class="text-center">Subject</th>
                                                <th class="text-center">Message</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @php
                                                $i = ($messages->currentPage() - 1) * $messages->perpage();
                                            @endphp
                                            @foreach ($messages as $msg)
                                                <tr>
                                                    <td class="text-center">{{ ++$i }}</td>
                                                    <td class="text-center">{{ $msg->name }}</td>
                                                    <td class="text-center">{{ $msg->email }}</td>
                                                    <td class="text-center">{{ $msg->phone }}</td>
                                                    <td class="text-center">{{ $msg->subject }}</td>
                                                    <td class="text-center">{{ $msg->message }}</td>
                                                </tr>
                                            @endforeach
                                @endif
                                </tbody>
                                </table>
                                {{ $messages->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection
