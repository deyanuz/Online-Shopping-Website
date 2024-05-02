@extends('layouts.app')
@section('title', 'Reset Password')

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
                    <span></span> All Users
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
                                        <h4>All Users</h4>
                                    </div>
                                    {{-- <div class="col-md-6">
                                    <a href="{{ route('admin.adduser') }}" class='btn btn-success float-end'>Add New
                                        user</a>
                                </div> --}}
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
                                            <th class="text-center">Email</th>
                                            <th class="text-center">User type</th>
                                            <th class="text-center">Registered at</th>
                                            <th class="text-center">Admin Privilege</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = ($users->currentPage() - 1) * $users->perpage();
                                        @endphp
                                        @foreach ($users as $user)
                                            <tr>
                                                <td class="text-center">{{ ++$i }}</td>
                                                <td class="text-center">{{ $user->name }}</td>
                                                <td class="text-center">{{ $user->email }}</td>
                                                <td class="text-center">{{ $user->utype == 'adm' ? 'Admin' : 'Customer' }}
                                                </td>
                                                <td class="text-center">{{ $user->created_at }}</td>

                                                <td class="text-center">
                                                    @if ($admins->contains($user->id))
                                                        <div class="text-success">
                                                            <strong>Already an Admin</strong>
                                                        </div>
                                                    @elseif ($admins->count() < 3)
                                                        <a href="{{route('admin.grantPrivilege',['id'=>$user->id])}}" class="text-info">
                                                            <strong>Grant Privileges</strong>
                                                        </a>
                                                    @else
                                                        <div class="text-muted">
                                                            <em>Admin Role Filled</em>
                                                        </div>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $users->links() }}
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
