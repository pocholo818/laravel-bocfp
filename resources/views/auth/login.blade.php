<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg">

    <head>
        
        <meta charset="utf-8" />
        <title>Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Layout config Js -->
        {{-- <script src="{{asset('assets/js/layout.js')}}"></script> --}}
        <!-- Bootstrap css-->
        {{-- <link rel="stylesheet" type="text/css" href="{{asset('assets/backoffice/css/vendors/bootstrap.css')}}"> --}}
        <!-- App css-->
        {{-- <link rel="stylesheet" type="text/css" href="{{asset('assets/backoffice/css/style.css')}}"> --}}

        {{-- stuff here --}}
        <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.css')}}">

        <style>
            /* .bd-placeholder-img {
                font-size: 1.125rem;
                text-anchor: middle;
                -webkit-user-select: none;
                -moz-user-select: none;
                user-select: none;
            }

            @media (min-width: 768px) {
                .bd-placeholder-img-lg {
                font-size: 3.5rem;
                }
            } */

            html,
            body {
            height: 100%;
            }

            body {
            display: flex;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
            }

            .form-signin {
            width: 100%;
            max-width: 330px;
            padding: 15px;
            margin: auto;
            }

            .form-signin .checkbox {
            font-weight: 400;
            }

            .form-signin .form-floating:focus-within {
            z-index: 2;
            }

            .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
            }

            .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
            }

            .btn-secondary {
            --bs-btn-bg: #5e3f00 !important;
            --bs-btn-border-color: #5e3f00 !important;
            }
        </style>

    </head>

    <body class="text-center">
        <!-- content -->
        <main class="form-signin">
            <form>
                <img class="mb-4" src="{{ asset('images/logo.png') }}" alt="" height="200">
                <h1 class="h3 mb-3 fw-normal">Sign in to account</h1>

                <div class="form-floating">
                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Email address</label>
                </div>
                <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
                </div>

                <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
                </div>
                <button class="w-100 btn btn-lg btn-secondary" type="submit">Sign in</button>
                {{-- <p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p> --}}
            </form>
        </main>

        <!-- scripts -->
        <script src="{{asset('js/jquery.min.js')}}"></script>
    </body>

</html>