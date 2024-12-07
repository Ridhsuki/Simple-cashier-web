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


            <!-- Sign Up Start -->
            <div class="container-fluid">
                <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                    <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                        <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <a href="index.html" class="">
                                    <h3 class="text-primary"><i class="fa fa-tree me-2"></i>Cashier App</h3>
                                </a>
                                <h3>Sign Up</h3>
                            </div>
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            <form action="{{ route('register.store') }}" method="POST">
                                @csrf
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" placeholder="jhondoe"
                                        name="name">
                                    <label for="name">Name</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control"
                                        placeholder="name@example.com" name="email">
                                    <label for="email">Email address</label>
                                </div>
                                <div class="form-floating mb-4">
                                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password"
                                        name="password">
                                    <label for="floatingPassword">Password</label>
                                </div>
                                <div class="form-floating mb-4">
                                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password"
                                        name="password_confirmation">
                                    <label for="floatingPassword">Confirm password</label>
                                </div>
                                <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Sign Up</button>
                                <p class="text-center mb-0">Already have an Account? <a href="{{ route('login') }}">Sign
                                        In</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sign Up End -->
        </div>
    @endsection
