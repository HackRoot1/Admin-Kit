@include('layouts.header')
<main class="d-flex w-100 h-100">
    <div class="container d-flex flex-column">
        <div class="row vh-100">
            <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
                <div class="d-table-cell align-middle">
                    <div class="text-center mt-4">
                        <h1 class="h2">Get started</h1>
                        <p class="lead">
                            Start creating the best possible user experience for you customers.
                        </p>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="m-sm-3">
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    @method('POST')

                                    <div class="mb-3">
                                        <label class="form-label">First Name</label>
                                        <input
                                            class="form-control form-control-lg @error('first_name') is-user-invalid @enderror"
                                            type="text" name="first_name" placeholder="Enter your first name"
                                            required>
                                        @error('first_name')
                                            <div class="invalid-feedback">
                                                Please enter First Name.
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Last Name</label>
                                        <input
                                            class="form-control form-control-lg @error('last_name') is-invalid @enderror"
                                            type="text" name="last_name" placeholder="Enter your last name" required>
                                        @error('last_name')
                                            <div class="invalid-feedback">
                                                Please enter Last Name.
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input class="form-control form-control-lg @error('email') is-invalid @enderror"
                                            type="email" name="email" placeholder="Enter your email" />
                                        @error('email')
                                            <div class="invalid-feedback">
                                                Please enter Email.
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <input class="form-control form-control-lg @error('password') is-invalid @enderror" type="password" name="password"
                                            placeholder="Enter password" />
                                        @error('password')
                                            <div class="invalid-feedback">
                                                Please enter Password.
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="d-grid gap-2 mt-3">
                                        <button type="submit" class='btn btn-lg btn-primary'>Sign Up</button>
                                    </div>
                                </form>
                                <div class="row">
                                    <div class="col">
                                        <hr>
                                    </div>
                                    <div class="col-auto text-uppercase d-flex align-items-center">Or</div>
                                    <div class="col">
                                        <hr>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center gap-2 mb-3">
                                    <a class='btn btn-google btn-lg' href='#'><i class="fab fa-fw fa-google"></i>
                                    </a>
                                    <a class='btn btn-facebook btn-lg' href='#'><i
                                            class="fab fa-fw fa-facebook-f"></i> </a>
                                    <a class='btn btn-microsoft btn-lg' href='#'><i
                                            class="fab fa-fw fa-microsoft"></i> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mb-3">
                        Already have account? <a href='{{ route('auth.sign-in') }}'>Log In</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@include('layouts.footer')
