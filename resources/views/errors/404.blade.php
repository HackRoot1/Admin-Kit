@include('layouts.header')
<main class="d-flex w-100 h-100">
    <div class="container d-flex flex-column">
        <div class="row vh-100">
            <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
                <div class="d-table-cell align-middle">

                    <div class="text-center">
                        <h1 class="display-1 fw-bold">404</h1>
                        <p class="h2">Page Not Found.</p>
                        <p class="lead fw-normal mt-3 mb-4">Sorry, the page you are looking for might have been removed or is temporarily unavailable.</p>
                        <a class='btn btn-primary btn-lg' href='{{ route('index') }}'>Return to website</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>
@include('layouts.footer')
