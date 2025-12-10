<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg">

    <head>
        
        <meta charset="utf-8" />
        <title>Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Barangay Old Cabalan Feeding Program (BOCFP)" name="description" />
        <meta content="PLG" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('images/favicon.png')}}">

        <!-- Layout config Js -->
        <script src="{{asset('assets/js/layout.js')}}"></script>
        <!-- Font Awesome-->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/web/css/fontawesome.css')}}">
        <!-- ico-font-->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/web/css/vendors/icofont.css')}}">
        <!-- Themify icon-->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/web/css/vendors/themify.css')}}">
        <!-- Flag icon-->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/web/css/vendors/flag-icon.css')}}">
        <!-- Feather icon-->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/web/css/vendors/feather-icon.css')}}">
        <!-- Plugins css start-->
        <!-- Bootstrap css-->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/web/css/vendors/bootstrap.css')}}">
        <!-- App css-->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/web/css/style.css')}}">
        <link id="color" rel="stylesheet" href="{{asset('assets/web/css/color-1.css')}}" media="screen">
        <!-- Responsive css-->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/web/css/responsive.css')}}">

        <style>
            .btn-secondary{
                background-color: #5e3f00!important;
                border-color: #5e3f00!important;
                color: white!important;
            }

            .bg-secondary{
                background-color: #5e3f00!important;
                border-color: #5e3f00!important;
                color: white!important;
            }
        </style>
    </head>

    <body>
        <!-- auth-page wrapper -->
        <div class="container-fluid p-0">
            <div class="row m-0">
                <div class="col-12 p-0">
                    <div class="login-card login-dark">
                        <div>
                            <div>
                                <a class="logo" href="{{--index.html--}}">
                                    <img class="img-fluid for-light" src="{{ asset('images/logo.png') }}" width="200" alt="">
                                    <img class="img-fluid for-dark" src="{{ asset('images/logo.png') }}" width="200" alt="">
                                </a>
                            </div>
                            <div class="login-main">
                                @include('web._components.notifications')

                                <form class="theme-form" method="POST">
                                    <div class="text-center">
                                        <h4>Magandang Araw!</h4>
                                        <p class="mb-3">Enter your email & password to login</p>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-form-label">Email Address</label>
                                        <input class="form-control" type="text" name="email" placeholder="e.g. juan123@gmail.com">
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">Password</label>
                                        <div class="form-input position-relative">
                                            <input class="form-control" type="password" name="login_password" placeholder="*********">
                                            <div class="show-hide">
                                                <span class="show"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0">
                                        <div class="form-check">
                                            <input class="checkbox-primary form-check-input" id="checkbox1" type="checkbox">
                                            <label class="text-muted form-check-label" for="checkbox1">Remember password</label>
                                        </div>
                                        <a class="link" href="{{---route('backoffice.auth.forgot_password') --}}">Forgot password?</a>
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-secondary btn-block w-100 mt-3">Sign in</button>
                                        </div>
                                    </div>
  
                                    {{-- <p class="mt-4 mb-0 text-center">Don't have account? <a class="ms-2" href="#">Create Account</a>
                                    </p> --}}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- latest jquery-->
            <script src="{{asset('assets/web/js/jquery.min.js')}}"></script>
            <!-- Bootstrap js-->
            <script src="{{asset('assets/web/js/bootstrap/bootstrap.bundle.min.js')}}"></script>
            <!-- feather icon js-->
            <script src="{{asset('assets/web/js/icons/feather-icon/feather.min.js')}}"></script>
            <script src="{{asset('assets/web/js/icons/feather-icon/feather-icon.js')}}"></script>
            <!-- scrollbar js-->
            <script src="{{asset('assets/web/js/scrollbar/simplebar.min.js')}}"></script>
            <script src="{{asset('assets/web/js/scrollbar/custom.js')}}"></script>
            <!-- Sidebar jquery-->
            <script src="{{asset('assets/web/js/config.js')}}"></script>
            <!-- Theme js-->
            <script src="{{asset('assets/web/js/script.js')}}"></script>
            <script src="{{asset('assets/web/js/script1.js')}}"></script>
        </div>
        <!-- end auth-page-wrapper -->
    </body>

</html>