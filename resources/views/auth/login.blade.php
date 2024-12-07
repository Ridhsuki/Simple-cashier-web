@extends('auth.template.master')
@section('content')

    <body>
        <div class="container-xxl position-relative bg-white d-flex p-0">
            <!-- Spinner Start -->
            <div id="spinner"
                class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
                <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <!-- Spinner End -->


            <!-- Sign In Start -->
            <div class="container-fluid">
                <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                    <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                        <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <a href="index.html" class="">
                                    <h3 class="text-primary"><i class="fa fa-tree me-2"></i>Cashier App</h3>
                                </a>
                                <h3>Sign In</h3>
                            </div>
                            @session('success')
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endsession
                            @session('error')
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endsession
                            <form action="" method="POST">
                                @csrf
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="floatingInput"
                                        placeholder="name@example.com">
                                    <label for="floatingInput">Email address</label>
                                </div>
                                <div class="form-floating mb-4">
                                    <input type="password" class="form-control" id="floatingPassword"
                                        placeholder="Password">
                                    <label for="floatingPassword">Password</label>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                    </div>
                                    <a href="">Forgot Password</a>
                                </div>
                                <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Sign In</button>
                            </form>
                            <p class="text-center mb-0">Don't have an Account? <a href="{{ route('register') }}">Sign Up</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sign In End -->
        </div>
    @endsection
