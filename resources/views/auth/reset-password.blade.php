@include('layouts.header')
<main class="d-flex w-100 h-100">
    <div class="container d-flex flex-column">
        <div class="row vh-100">
            <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
                <div class="d-table-cell align-middle">

                    <div class="text-center mt-4">
                        <h1 class="h2">Reset password</h1>
                        <p class="lead">
                            Enter your email to reset your password.
                        </p>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="m-sm-3">
                                <h2>Reset Password</h2>

                                <form method="POST" action="{{ route('password.update') }}">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $token }}">

                                    <div class="mb-3">
                                        <label class="form-label">Email:</label>
                                        <input class="form-control form-control-lg" type="email" name="email"  placeholder="Enter your email"
                                            required>
                                        @error('email')
                                            <p style="color:red">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">New Password:</label>
                                        <input class="form-control form-control-lg" type="password" name="password"  placeholder="Enter your password"
                                            required>
                                        @error('password')
                                            <p style="color:red">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Confirm Password:</label>
                                        <input class="form-control form-control-lg" type="password"
                                            name="password_confirmation" placeholder="Confirm your email" required>
                                    </div>
                                    <div class="d-grid gap-2 mt-3">
                                        <button class='btn btn-lg btn-primary' type="submit">Reset Password</button>
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
