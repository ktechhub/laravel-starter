<!DOCTYPE html>
<html lang="en">

<head>
    @include('back.components.links')
</head>

<body>

    <!-- ======= Header ======= -->
    @include('back.components.header')
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    @include('back.components.sidebar')
    <!-- End Sidebar-->

    <main id="main" class="main">

        @yield('crumb')

        @yield('content')

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    @include('back.components.footer')
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    @include('back.components.scripts')

</body>

</html>
