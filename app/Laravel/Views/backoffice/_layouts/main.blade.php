<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg">
    <head>
        @include('backoffice._components.metas') 
        @include('backoffice._components.styles')
        @yield('page-styles')
    </head>

    <body >
        <!-- loader starts-->
        <div class="loader-wrapper">
        <div class="loader-index"> <span></span></div>
        <svg>
            <defs></defs>
            <filter id="goo">
            <fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>
            <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo"> </fecolormatrix>
            </filter>
        </svg>
        </div>
        <!-- loader ends-->
        <!-- tap on top starts-->
        <div class="tap-top"><i data-feather="chevrons-up"></i></div>
        <!-- tap on tap ends-->
        <!-- Begin page -->
        <div class="page-wrapper compact-wrapper" id="pageWrapper">
            <div class="page-body-wrapper">
                @include('backoffice._components.topbar')

                <div class="page-body-wrapper">
                    @include('backoffice._components.sidebar')

                    {{-- content --}}
                    <div class="page-body">
                        <div class="container-fluid">
                            @yield('breadcrumbs')
                            @yield('content')   
                        </div>
                    </div>
                </div>
                <!-- Page Body End-->

                <!-- Footer-->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12 footer-copyright text-center">
                                <p class="mb-0"> {{now()->format("Y")}} © {{env("APP_NAME")}} </p>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <!-- END layout-wrapper -->

        @yield('page-modals')
        @include('backoffice._components.scripts')
        @yield('page-scripts')
    </body>
</html>
