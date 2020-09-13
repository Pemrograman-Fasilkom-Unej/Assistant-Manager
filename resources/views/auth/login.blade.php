<!DOCTYPE html>
<html lang="en">
<head>
    <title>Assistant Manager - Login</title>
    <!--[if lt IE 11]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- Favicon icon -->
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">

    <!-- vendor css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>
<!-- [ signin-img ] start -->
<div class="auth-wrapper align-items-stretch aut-bg-img">
    <div class="flex-grow-1">
        <div class="h-100 d-md-flex align-items-center auth-side-img">
            <div class="col-sm-10 auth-content w-auto">
                <img src="{{ asset('assets/images/auth/auth-logo.png') }}" alt="Assistant Manager's Logo" class="img-fluid">
                <h1 class="text-white my-4">Hello Assistant</h1>
                <h4 class="text-white font-weight-normal">Assistant Manager can help you to manage your work as an
                    Assistant</h4>
            </div>
        </div>
        <div class="auth-side-form">
            <div class="auth-content">
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <img src="{{ asset('assets/images/auth/auth-logo-dark.png') }}" alt="Assistant Manager's Logo"
                         class="img-fluid mb-4 d-block d-xl-none d-lg-none">
                    <h3 class="mb-4 f-w-400">Sign In</h3>
                    <div class="form-group mb-3">
                        <label class="floating-label" for="username">Username</label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="" name="username"
                               value="{{ old('username') }}" required autocomplete="username">
                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        <label class="floating-label" for="password">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="" autocomplete="password" name="password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="custom-control custom-checkbox text-left mb-4 mt-2">
                        <input type="checkbox" class="custom-control-input" id="customCheck1" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="custom-control-label" for="customCheck1">Save credentials.</label>
                    </div>
                    <button class="btn btn-block btn-primary mb-4">Sign In</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Required Js -->
<script src="{{ asset('assets/js/vendor-all.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/ripple.js') }}"></script>
<script src="{{ asset('assets/js/pcoded.min.js') }}"></script>
<script>$( function() {$(this).after("<!--")});</script>
</body>

</html>
