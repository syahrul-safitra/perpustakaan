<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="{{ asset('img/logo/logo.png') }}" rel="icon">
    <title>RuangAdmin - Login</title>
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/ruang-admin.min.css') }}" rel="stylesheet">

    <style>
    </style>
</head>

<body class="bg-gradient-login bg-image" style="background-image: url('img/logo/background.jpg')">
    <!-- Login Content -->
    <div class="container-login ">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-12 col-md-9">
                <div class="card shadow-sm my-5 ">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form ">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900">Login</h1>
                                        <img src="{{ asset('img/logo/logo_buku.jpg') }}"
                                            style="width: 100px;height:100px">
                                    </div>


                                    <form class="user" action="{{ url('autentikasi') }}" method="POST">
                                        @if (session()->has('loginFailed'))
                                            <div class="alert alert-danger alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                {{ session('loginFailed') }}
                                            </div>
                                        @endif
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" class="form-control" id="exampleInputEmail"
                                                aria-describedby="emailHelp" name="email"
                                                placeholder="Enter Email Address" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" id="exampleInputPassword"
                                                placeholder="Password" name="password" required>
                                        </div>

                                        <div class="mb-3">
                                            <a href="{{ url('kunjungan') }}">Buku Kunjungan</a>
                                        </div>
                                        <div class="form-group">
                                            {{-- <a href="index.html" class="btn btn-primary btn-block">Login</a> --}}
                                            <button class="btn btn-primary">Login</button>
                                        </div>
                                        <hr>
                                    </form>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Login Content -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/ruang-admin.min.js') }}"></script>
</body>

</html>
