<!doctype html>
<html lang="en">

@include('auth.layouts.partials.head')

<body>
    <!-- loader Start -->
    <div id="loading">
        <div id="loading-center">
        </div>
    </div>
    <div>
        @yield('content')
    </div>
    @include('auth.layouts.partials.scripts')
</body>

</html>
