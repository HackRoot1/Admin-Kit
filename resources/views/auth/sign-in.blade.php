@include('layouts.header')
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
                                <div class="d-grid gap-2 mb-3">
                                    <a class='btn btn-google btn-lg' href='{{ route('auth.google') }}'><i
                                            class="fab fa-fw fa-google"></i>
                                        Sign in with Google</a>
                                    <a class='btn btn-facebook btn-lg' href='#'><i
                                            class="fab fa-fw fa-facebook-f"></i> Sign in with Facebook</a>
                                    <a class='btn btn-microsoft btn-lg' href='#'><i
                                            class="fab fa-fw fa-microsoft"></i> Sign in with Microsoft</a>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <hr>
                                    </div>
                                    <div class="col-auto text-uppercase d-flex align-items-center">Or</div>
                                    <div class="col">
                                        <hr>
                                    </div>
                                </div>
                                <form action="{{ route('authenticate') }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input class="form-control form-control-lg @error('email') is-invalid @enderror"
                                            type="email" name="email" value="{{ old('email') }}"
                                            placeholder="Enter your email" />
                                        @error('email')
                                            <div class="invalid-feedback">
                                                Please enter Email.
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <input
                                            class="form-control form-control-lg  @error('password') is-invalid @enderror"
                                            type="password" name="password" placeholder="Enter your password" />
                                        @error('password')
                                            <div class="invalid-feedback">
                                                Please enter Password.
                                            </div>
                                        @enderror
                                        <small>
                                            <a href='{{ route('password.request') }}'>Forgot password?</a>
                                        </small>
                                    </div>
                                    <div>
                                        <div class="form-check align-items-center">
                                            <input id="customControlInline" type="checkbox" class="form-check-input"
                                                name="remember">
                                            <label class="form-check-label text-small"
                                                for="customControlInline">Remember me</label>
                                        </div>
                                    </div>
                                    <div class="d-grid gap-2 mt-3">
                                        <button class='btn btn-lg btn-primary' type="submit">Sign In</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mb-3">
                        Don't have an account? <a href='{{ route('auth.sign-up') }}'>Sign up</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@include('layouts.footer')
