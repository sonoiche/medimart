<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5" />
    <meta name="author" content="AdminKit" />
    <meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web" />

    <link rel="preconnect" href="https://fonts.gstatic.com/" />
    <link rel="shortcut icon" href="img/icons/icon-48x48.png" />

    <title>Sign In | AdminKit Demo</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&amp;display=swap" rel="stylesheet" />

    <!-- Choose your prefered color scheme -->
    <!-- <link href="{{ url('assets/css/light.css') }}" rel="stylesheet"> -->
    <!-- <link href="{{ url('assets/css/dark.css') }}" rel="stylesheet"> -->

    <!-- BEGIN SETTINGS -->
    <!-- Remove this after purchasing -->
    <link class="js-stylesheet" href="{{ url('assets/css/light.css') }}" rel="stylesheet" />
    <style>
        body {
            opacity: 0;
        }
    </style>
    <!-- END SETTINGS -->
</head>
<!--
HOW TO USE: 
data-theme: default (default), dark, light, colored
data-layout: fluid (default), boxed
data-sidebar-position: left (default), right
data-sidebar-layout: default (default), compact
-->

<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
    <main class="d-flex w-100 h-100">
        <div class="container d-flex flex-column">
            <div class="row vh-100">
                <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">
                        <div class="text-center mt-4">
                            <h1 class="h2">Welcome back!</h1>
                            <p class="lead">
                                Sign in to your account to continue
                            </p>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="m-sm-3">
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input class="form-control form-control-lg @error('email') is-invalid @enderror" type="email" name="email" placeholder="Enter your email" />
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <input class="form-control form-control-lg @error('password') is-invalid @enderror" type="password" name="password" placeholder="Enter your password" />
                                            <small>
                                                <a href="{{ route('password.request') }}">Forgot password?</a>
                                            </small>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div>
                                            <div class="form-check align-items-center">
                                                <input id="customControlInline" type="checkbox" class="form-check-input" value="1" name="remember_me" checked />
                                                <label class="form-check-label text-small" for="customControlInline">Remember me</label>
                                            </div>
                                        </div>
                                        <div class="d-grid gap-2 mt-3">
                                            <button type="submit" class="btn btn-lg btn-primary">Sign in</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mb-3">Don't have an account? <a href="{{ url('register') }}">Sign up</a></div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="{{ url('assets/js/app.js') }}"></script>
</body>
</html>