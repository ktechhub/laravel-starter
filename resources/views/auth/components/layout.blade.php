<!DOCTYPE html>
<html lang="en">

<head>
    @include('back.components.links')
</head>

<body>

    <main>
        <div class="container">

            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <a href="/" class="logo d-flex align-items-center w-auto">
                                    <img src="/back/img/logo.png" alt="">
                                    <span class="d-none d-lg-block">Kalkulus</span>
                                </a>
                            </div><!-- End Logo -->

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">@yield('page-title')</h5>
                                        <p class="text-center small">@yield('page-desc')</p>
                                    </div>

                                    @yield('content')

                                </div>
                            </div>

                            @include('auth.components.footer')

                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    @include('back.components.scripts')

</body>

</html>
