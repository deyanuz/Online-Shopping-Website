@extends('layouts.app')
@section('title', 'Login')

@section('content')

    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow">Home</a>
                    <span></span> My Account
                </div>
            </div>
        </div>
        <section class="pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 m-auto">
                        <div class="row">
                            @if (Session::has('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ Session::get('success') }}
                                </div>
                            @endif
                            @if (Session::has('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{ Session::get('error') }}
                                </div>
                            @endif
                            <div class="col-md-4">
                                <div class="dashboard-menu">
                                    <ul class="nav flex-column" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="profile-tab" data-bs-toggle="tab" href="#profile"
                                                role="tab" aria-controls="profile" aria-selected="true"><i
                                                    class="fi-rs-user mr-10"></i>My Profile</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="orders-tab" data-bs-toggle="tab" href="#orders"
                                                role="tab" aria-controls="orders" aria-selected="false"><i
                                                    class="fi-rs-shopping-bag mr-10"></i>Orders</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="account-detail-tab" data-bs-toggle="tab"
                                                href="#account-detail" role="tab" aria-controls="account-detail"
                                                aria-selected="true"><i class="fi fi-rs-pencil mr-10"></i>Edit Profile</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('auth.logout')}}"><i
                                                    class="fi-rs-sign-out mr-10"></i>Logout</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="tab-content dashboard-content">

                                    <div class="tab-pane fade  active show" id="profile" role="tabpanel"
                                        aria-labelledby="profile-tab">
                                        <div class="row d-flex justify-content-center">
                                            <div class="col-lg-8">
                                                <div class="card mb-3 mb-lg-0">
                                                    <div class="card-header">
                                                        <h5 class="mb-0 text-center">Account Details</h5>
                                                    </div>
                                                    <div class="card-body text-center">
                                                        <name class='mt-10 '><strong class="mr-10"> Name :
                                                            </strong>{{ Auth::user()->name }}</name><br>
                                                        <name class='mt-10 '><strong class="mr-10"> Email :</strong>
                                                            {{ Auth::user()->email }}</name><br>
                                                        <name class='mt-10 '><strong class="mr-10"> Authentication Type
                                                                :</strong>
                                                            {{ Auth::user()->utype == 'adm' ? 'Admin' : 'Customer' }}</name>
                                                        <br>
                                                        @php
                                                            $unixTimestamp = strtotime(Auth::user()->created_at);
                                                            [$date, $time] = explode(' ', Auth::user()->created_at);
                                                            $formattedDate = date('d F Y', $unixTimestamp);
                                                        @endphp
                                                        <name class='mt-10 '><strong class="mr-10"> Registration Date :
                                                            </strong>{{ $formattedDate }}
                                                        </name><br>
                                                        <name class='mt-10 '><strong class="mr-10"> Registration Time
                                                                :</strong>{{ $time }}
                                                        </name><br>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="mb-0">Your Orders</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>ID</th>
                                                                <th>Date</th>
                                                                <th>Time</th>
                                                                <th>Status</th>
                                                                <th>Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($orders as $order)
                                                                <tr>
                                                                    <td>{{ $order->id }}</td>
                                                                    @php
                                                                        $unixOrderTimestamp = strtotime(
                                                                            $order->created_at,
                                                                        );
                                                                        [$orderDate, $orderTime] = explode(
                                                                            ' ',
                                                                            $order->created_at,
                                                                        );
                                                                        $formattedOrderDate = date(
                                                                            'd F Y',
                                                                            $unixOrderTimestamp,
                                                                        );
                                                                    @endphp
                                                                    <td>{{ $formattedOrderDate }}</td>
                                                                    <td>{{ $orderTime }}</td>
                                                                    <td>{{ $order->status }}</td>
                                                                    <td>{{ $order->total_price }}</td>

                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="account-detail" role="tabpanel"
                                        aria-labelledby="account-detail-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Account Details</h5>
                                            </div>
                                            <div class="card-body">
                                                <form method="post" name="enq"
                                                    action="{{ route('user.updateUser') }}">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                            <label>Name <span class="required">*</span></label>
                                                            <input required="" class="form-control square" name="name"
                                                                type="text">
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label>Email Address <span class="required">*</span></label>
                                                            <input required="" class="form-control square"
                                                                name="email" type="email">
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label>Current Password <span class="required">*</span></label>
                                                            <input required="" class="form-control square"
                                                                name="password" type="password">
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label>New Password <span
                                                                    class="required">(Optional)</span></label>
                                                            <input class="form-control square" name="npassword"
                                                                type="password">
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label>Confirm Password <span
                                                                    class="required">(Optional)</span></label>
                                                            <input class="form-control square" name="cpassword"
                                                                type="password">
                                                        </div>
                                                        <div class="col-md-12">
                                                            <button type="submit" class="btn btn-fill-out submit"
                                                                name="submit" value="Submit">Update</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
