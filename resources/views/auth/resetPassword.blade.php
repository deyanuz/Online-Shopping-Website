@extends('layouts.app')
@section('title', 'Forgot Password')

@section('content')

    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href={{route('frontend.home')}} rel="nofollow">Home</a>
                    <span></span> Update Password
                </div>
            </div>
        </div>
        <section class="pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 m-auto">
                        <div class="row">
                            <div class="col-lg-5">
                                <div
                                    class="login_wrap widget-taber-content p-30 background-white border-radius-10 mb-md-5 mb-lg-0 mb-sm-5">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                            <h3 class="mb-30">Update Password</h3>
                                        </div>
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
                                        <form method="post" action="{{route('auth.updatePassword')}}">
                                            @csrf
                                            <input type="text" hidden name="token" value="{{$token}}">
                                            <div class="form-group">
                                                <input type="password" required="" name="npassword"
                                                    placeholder="Enter new password" required>
                                            </div>
                                            <div class="form-group">
                                                <input type="password" required="" name="cpassword"
                                                    placeholder="Enter new password" required>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-sm btn-fill-out btn-block hover-up"
                                                    name="update">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1"></div>
                            <div class="col-lg-6">
                                <img src="{{asset('assets/imgs/login.png')}}">
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
