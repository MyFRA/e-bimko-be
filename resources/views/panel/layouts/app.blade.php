<!doctype html>
<html lang="en">

<head>
    @include('panel.layouts.partials.head')

    @yield('stylesheets')
</head>

<body class="sidebar-main-active right-column-fixed">

    <!-- Wrapper Start -->
    <div class="wrapper">
        <!-- Sidebar  -->
        @include('panel.layouts.partials.sidebar')

        @include('panel.layouts.partials.top-nav')

        <!-- Page Content  -->
        <div id="content-page" class="content-page">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Wrapper END -->

    @include('panel.layouts.partials.scripts')
    @yield('scripts')
</body>

</html>
